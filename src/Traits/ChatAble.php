<?php

namespace Chareice\LaravelChat\Traits;

use Chareice\LaravelChat\ChatMessage;
use Chareice\LaravelChat\ChatSession;
use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;

trait ChatAble
{
    public function sendMessage(string $content, string $type, ChatAbleContract $receiver)
    {
        DB::transaction(function () use ($content, $type, $receiver) {
            /** @var ChatMessage $message */
            $message = app(config('chat.message_model'));
            $message->content = $content;
            $message->type = $type;
            $message->receiverable()->associate($receiver);
            $message->senderable()->associate($this);
            $message->save();

            /** @var ChatSession $senderSession */
            $senderSession = ChatSession::query()->updateOrCreate([
                'ownerable_type' => $this::class,
                'ownerable_id' => $this->id,
                'targetable_type' => $receiver::class,
                'targetable_id' => $receiver->id
            ], [
                'message_preview' => $message->preview(),
                'last_message_at' => $message->createdAt()
            ]);

            $senderSession->messages()->attach($message);

            // 接收方Session

            /** @var ChatSession $receiverSession */
            $receiverSession = ChatSession::query()->firstOrCreate([
                'ownerable_type' => $receiver::class,
                'ownerable_id' => $receiver->id,
                'targetable_type' => $this::class,
                'targetable_id' => $this->id
            ], [
                'message_preview' => $message->preview(),
                'last_message_at' => $message->createdAt(),
            ]);


            $receiverSession->messages()->attach($message);
            $receiverSession->unread_count = $receiverSession->unreadMessageCount() + 1;
            $receiverSession->save();
        });

    }

    public function chatSessions(): MorphMany
    {
        return $this->morphMany(ChatSession::class, 'ownerable');
    }
}