<?php

namespace Chareice\LaravelChat\Models;

use Carbon\Carbon;
use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Chareice\LaravelChat\Contracts\ChatSessionContract;
use Chareice\LaravelChat\Contracts\MessageContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatSession extends Model implements ChatSessionContract
{
    protected $guarded = false;

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'session_id');
    }

    public function lastMessage(): MessageContact
    {
        return $this->hasOne(ChatMessage::class)->latestOfMany();
    }

    public function participants(): HasMany
    {
        return $this->hasMany(ChatParticipant::class, 'session_id');
    }

    public function id(): string
    {
        return $this->id;
    }
}