<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemChatThread extends Model
{
    protected $table = 'item_chat_threads';

    protected $fillable = [
        'item_chat_id',
        'user_id',
        'message',
    ];

    // Define relationships
    public function itemChat()
    {
        return $this->belongsTo(ItemChat::class, 'item_chat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Other model logic...
}
