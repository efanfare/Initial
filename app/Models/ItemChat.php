<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ItemChat extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'item_chats';

    protected $appends = [
        'chat_image',
    ];

    public const TYPETEXT = 'Text';
    public const TYPEPIC = 'Image';

    protected $fillable = [
        'scene_id',
        'item_id',
        'uuid',
        'title',
        'type',
        'user_id',
    ];


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('avatar')->fit('crop', 80, 100)->nonQueued();
        $this->addMediaConversion('thumb')->fit('crop', 1280, 720)->nonQueued();
    }

    public function chatImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                $file = $this->getMedia('chat_image')->last();

                if ($file) {
                    $file->url = $file->getUrl();
                    $file->thumbnail = $file->getUrl('thumb');
                    $file->avatar = $file->getUrl('avatar');
                }

                return $file;
            }
        );
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scene()
    {
        return $this->belongsTo(Scene::class);
    }

    public function itemThreadChats()
    {
        return $this->hasMany(ItemChatThread::class, 'item_chat_id');
    }

    // Other model logic...
}
