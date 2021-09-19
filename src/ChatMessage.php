<?php


namespace Chareice\LaravelChat;


use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Chareice\LaravelChat\Contracts\MessageContact;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model implements MessageContact
{
    public function id(): string
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

    public function sender(): ChatAbleContract
    {
        return $this->senderable;
    }

    public function receiver(): ChatAbleContract
    {
        return $this->receiverable;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function createdAt()
    {
        return $this->created_at;
    }

    public function readAt()
    {
        return $this->read_at;
    }


}