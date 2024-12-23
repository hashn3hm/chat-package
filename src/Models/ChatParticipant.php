<?php

namespace Hasicode\Chats\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChatParticipant extends Pivot
{
    protected $table = 'chat_participants';

    protected $fillable = [
        'chat_id',
        'user_id',
        'role',
    ];

    /**
     * Timestamps for the pivot table.
     */
    public $timestamps = true;

    /**
     * Relationships.
     */

    // User relationship
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    // Chat relationship
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
