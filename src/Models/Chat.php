<?php

namespace Hasicode\Chats\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'name',
        'group_description',
        'is_group',
    ];

    /**
     * Relationships.
     */

    // Relationship to participants
    public function participants()
    {
        return $this->belongsToMany(
            config('auth.providers.users.model'),
            'chat_participants',
            'chat_id',
            'user_id'
        )
            ->using(ChatParticipant::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    // Relationship to messages
    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }

    /**
     * Scope: Retrieve only group chats.
     */
    public function scopeGroups($query)
    {
        return $query->where('is_group', true);
    }

    /**
     * Scope: Retrieve only private (one-on-one) chats.
     */
    public function scopePrivate($query)
    {
        return $query->where('is_group', false);
    }
}
