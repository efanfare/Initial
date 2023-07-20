<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'galleries';

    public function registerMediaConversions(Media $media = null): void
    {

        $this->addMediaConversion('preview')->fit('crop', 500, 500)->keepOriginalImageFormat()->nonQueued();
    }


    public function scenes()
    {
        return $this->belongsToMany(Scene::class);
    }
}
