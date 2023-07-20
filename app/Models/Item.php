<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\Image\Manipulations;

class Item extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    protected $table = 'items';

    protected $appends = [
        'item_image',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'service_type',
        'description',
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
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CONTAIN, 150, 150)->keepOriginalImageFormat()->nonQueued();
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CONTAIN, 500, 500)->keepOriginalImageFormat()->nonQueued();
    }

    public function optimizeMedia()
    {
        $this->getMedia()->each(function (Media $media) {
            OptimizerChainFactory::create()->optimize($media->getPath());
        });
    }

    public function itemImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                $file = $this->getMedia('item_image')->last();

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

    public function photoBank()
    {
        return $this->hasOne(PhotoBank::class);
    }
}
