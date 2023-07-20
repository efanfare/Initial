<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Scene extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'scenes';

    protected $appends = [
        'scene_canvas_image',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
        'user_id',
        'backgorund_id',
        'is_hosted',
        'canvas_json',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sceneInvitations()
    {
        return $this->hasMany(SceneInvitation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function background()
    {
        return $this->belongsTo(Background::class, 'backgorund_id');
    }

    public function galleries()
    {
        return $this->belongsToMany(Gallery::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 150, 150)->keepOriginalImageFormat()->nonQueued();
        $this->addMediaConversion('preview')->fit('crop', 500, 500)->keepOriginalImageFormat()->nonQueued();
    }

    public function sceneCanvasImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                $file = $this->getMedia('scene_canvas_image')->last();

                if ($file) {
                    $file->url = $file->getUrl();
                    $file->thumb = $file->getUrl('thumb');
                    $file->preview = $file->getUrl('preview');
                }

                return $file;
            }
        );
    }


    // public function invitations()
    // {
    //     return $this->belongsToMany(SceneInvitation::class);
    // }
}
