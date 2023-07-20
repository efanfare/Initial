<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Package extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public $table = 'packages';

    public const STATUS_RADIO = [
        '1' => 'Enable',
        '0' => 'Disable',
    ];

    public const BASIC = 1; //Package id 1
    public const SCENE_LIMIT = 3; //Basic scene limit
    public const UPLOAD_CUSTOM_ITEM = 6; //Add Photo bank limit

    public const MONTHLY = 'monthly';
    public const YEARLY = 'yearly';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'package_name',
        'price_monthly',
        'stripe_plan_monthly',
        'price_yearly',
        'stripe_plan_yearly',
        'options',
        'status',
        'yearly_discount',
        'stripe_plan',
        'scene_limit',
        'item_limit',
        'google_ads_free',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public static function getPackageNameByPriceId($priceId)
    {
        $packageMonthly = Package::where('stripe_plan_monthly', $priceId)->first();
        $packageYearly = Package::where('stripe_plan_yearly', $priceId)->first();

        if ($packageMonthly) {
            return $packageMonthly->package_name . '   ' . 'Monthly';
        } else {
            return $packageYearly->package_name . '   ' . 'Yearly';
        }
    }


    public static function getUserCurrentPackageInterval($priceId): array
    {

        $packageMonthly = Package::where('stripe_plan_monthly', $priceId)->first();
        $packageYearly = Package::where('stripe_plan_yearly', $priceId)->first();

        if ($packageMonthly) {
            $name =  $packageMonthly->package_name;
            $interval =  'Monthly';
        } else {
            $name =  $packageYearly->package_name;
            $interval = 'Yearly';
        }

        return [$name, $interval];
    }

    public static function userCurrentPackage($packageId)
    {
        return Package::where('id', $packageId)->first();
    }
}
