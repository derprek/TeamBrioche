<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = ['receiver_email', 'sender_email', 'title', 'content', 'conv_id', 'status'];

    public function scopeGetConversationSender($query, $prac_email)
    {
        $query->where('sender_email', '=', $prac_email);
    }

    public function scopeGetConversationReceiver($query, $prac_email)
    {
        $query->where('receiver_email', '=', $prac_email);
    }

    public function scopeGetMessageById($query, $conversation_id)
    {
        $query->where('conv_id', '=', $conversation_id);
    }

    public function scopeGetUnreadMessages($query)
    {
        $query->where('status', '=', 'unread');
    }
}
