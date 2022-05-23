<?php


namespace Chareice\LaravelChat\Models;


use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Chareice\LaravelChat\Contracts\ChatSessionContract;
use Chareice\LaravelChat\Contracts\MessageContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model implements MessageContact
{
    public function getId(): string
    {
        return $this->id;
    }

    public function senderable()
    {
        return $this->morphTo();
    }

    public function receiverable()
    {
        return $this->morphTo();
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(ChatSession::class, 'session_id');
    }

    public function getSender(): ChatAbleContract
    {
        return $this->senderable;
    }

    public function getReceiver(): ChatAbleContract
    {
        return $this->receiverable;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getReadAt()
    {
        return $this->read_at;
    }

    public function getPreview(): string
    {
        return $this->content();
    }

}