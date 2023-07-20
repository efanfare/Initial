<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Background extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'backgrounds';

    protected $appends = [
        'background_image',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'service_type',
        'price',
        'tags'
    ];

    protected $casts = [
        'tags' => 'array' // Cast the 'tags' column as an array
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 150, 150)->keepOriginalImageFormat()->nonQueued();
        $this->addMediaConversion('preview')->fit('crop', 750, 650)->keepOriginalImageFormat()->nonQueued();
    }


    public function backgroundImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                $file = $this->getMedia('background_image')->last();

                if ($file) {
                    $file->url = $file->getUrl();
                    $file->thumb = $file->getUrl('thumb');
                    $file->preview = $file->getUrl('preview');
                }

                return $file;
            }
        );
    }

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
