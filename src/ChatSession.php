<?php
namespace Chareice\LaravelChat;

use Carbon\Carbon;
use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Chareice\LaravelChat\Contracts\ChatSessionContract;
use Chareice\LaravelChat\Contracts\MessageContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ChatSession extends Model implements ChatSessionContract
{
    protected $guarded = false;

    public function targetable()
    {
        return $this->morphTo();
    }

    public function ownerable()
    {
        return $this->morphTo();
    }

    public function messages(): BelongsToMany
    {
        return $this->belongsToMany(ChatMessage::class, 'chat_sessions_messages', 'session_id', 'message_id');
    }

    public function target(): ChatAbleContract
    {
        return $this->targetable;
    }

    public function lastMessage(): MessageContact
    {
        return $this->messages()->orderByDesc('id')->first();
    }

    public function unreadMessageCount(): int
    {
        return $this->unread_count ?? 0;
    }

    public function lastMessageAt(): Carbon
    {
        return $this->last_message_at;
    }

    public function lastMessagePreview(): string
    {
        return $this->message_preview;
    }
}