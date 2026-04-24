<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = [
        'chat_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'user_role',
        'session_version',
        'last_message',
        'context_reset_at',
    ];

    protected $casts = [
        'context_reset_at' => 'datetime'
    ];
    public function chat_messages(){
        return $this->hasMany(ChatMessage::class, 'chat_sessions_id');
    }
}
