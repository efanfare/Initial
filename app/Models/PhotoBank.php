<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoBank extends Model
{
    use HasFactory;

    protected $table = 'photo_banks';

    protected $fillable = [
        'item_id',
        'scene_id'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }

    public function scene()
    {
        return $this->belongsTo(Scene::class);
    }
}
