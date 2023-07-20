<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SceneInvitation extends Model
{
    use HasFactory;

    protected $table = 'scene_invitations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'scene_id',
        'email',
        'token',
        'invitation_message',
        'is_accepted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scene()
    {
        return $this->belongsTo(Scene::class);
    }
    
    // public function scene()
    // {
    //     return $this->belongsToMany(Scene::class);
    // }
}
