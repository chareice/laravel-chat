<?php

namespace Chareice\LaravelChat\Traits;

use Chareice\LaravelChat\ChatMessage;
use Chareice\LaravelChat\ChatSession;
use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Chareice\LaravelChat\Contracts\MessageContact;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ChatAble
{
    public function sendMessage(string $content, string $type, ChatAbleContract $receiver){
        /** @var ChatMessage $message */
        $message = app(config('chat.message_model'));
        $message->content = $content;
        $message->type = $type;
        $message->receiverable()->associate($receiver);
        $message->senderable()->associate($this);
        $message->save();

        /** @var ChatSession $senderSession */
        $senderSession = ChatSession::query()->firstOrCreate([
            'ownerable_type' => $this::class,
            'ownerable_id' => $this->id,
            'targetable_type' => $receiver::class,
            'targetable_id' => $receiver->id
        ]);

        $senderSession->messages()->attach($message);

        // 接收方Session

        /** @var ChatSession $receiverSession */
        $receiverSession = ChatSession::query()->firstOrCreate([
            'ownerable_type' => $receiver::class,
            'ownerable_id' => $receiver->id,
            'targetable_type' => $this::class,
            'targetable_id' => $this->id
        ]);

        $receiverSession->messages()->attach($message);
    }

    public function chatSessions() : MorphMany
    {
        return $this->morphMany(ChatSession::class, 'ownerable');
    }
}