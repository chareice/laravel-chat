<?php

namespace Chareice\LaravelChat\Traits;

use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Chareice\LaravelChat\Contracts\MessageContact;
use Chareice\LaravelChat\Models\ChatMessage;
use Chareice\LaravelChat\Models\ChatParticipant;
use Chareice\LaravelChat\Models\ChatSession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait ChatAble
{
    public function sendMessage(string $content, string $type, ChatAbleContract $receiver): MessageContact
    {
        /** @var ChatAbleContract $sender */
        $sender = $this;

        DB::beginTransaction();

        try {
            // find or create chat session
            $existSession = ChatSession::query()->whereHas('participants', function (Builder $query) use ($sender) {
                $query->where('chatable_id', $sender->getId())->where('chatable_type', get_class($sender));
            })->whereHas('participants', function (Builder $query) use ($receiver) {
                $query->where('chatable_id', $receiver->getId())->where('chatable_type', get_class($receiver));
            })->first();


            if (!$existSession) {
                $session = new ChatSession();
                $session->save();

                $existSession = $session;

                $session->participants()->saveMany(collect([$sender, $receiver])->map(function ($item) {
                    $participant = new ChatParticipant();
                    $participant->chatable()->associate($item);
                    return $participant;
                }));

            }

            /** @var ChatMessage $message */
            $message = app(config('chat.message_model'));
            $message->content = $content;
            $message->type = $type;
            $message->receiverable()->associate($receiver);
            $message->senderable()->associate($sender);

            $existSession->messages()->save($message);
            DB::commit();

            return $message;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}