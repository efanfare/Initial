<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemChatCaption extends Model
{
    use HasFactory;

    protected $table = 'item_chat_captions';

    protected $fillable = [
        'uuid', //same uuid as item chat caption
        'description',
    ];
}
