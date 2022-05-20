<?php

namespace Chareice\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatParticipant extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    public function participant()
    {
        return $this->morphTo('chatable');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(ChatSession::class, 'session_id');
    }
}