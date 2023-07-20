<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Cashier\Billable;


class User extends Authenticatable implements HasMedia
{
    use Notifiable, InteractsWithMedia, HasFactory, Notifiable, Billable;

    public $table = 'users';

    protected $appends = [
        'profile_image',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'country_id',
        'city',
        'contact_number',
        'remember_token',
        'two_factor',
        'two_factor_code',
        'two_factor_expires_at',
        'package_id',
        'package_interval',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('avatar')->fit('crop', 50, 50)->nonQueued();
        $this->addMediaConversion('thumb')->fit('crop', 112, 112)->nonQueued();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function profileImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                $file = $this->getMedia('profile_image')->last();

                if ($file) {
                    $file->url = $file->getUrl();
                    $file->thumbnail = $file->getUrl('thumb');
                    $file->avatar = $file->getUrl('avatar');
                }

                return $file;
            }
        );
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->roles()->where('title', Role::ADMIN)->exists()
        );
    }

    public function isUser(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->roles()->where('title', Role::USER)->exists()
        );
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public static function getFirstAndLastName($name): array
    {

        $splitName = explode(' ', $name, 2); // Restricts it to only 2 values, for names like Billy Bob Jones

        $firstName = $splitName[0];
        $lastName = !empty($splitName[1]) ? $splitName[1] : '';
        return [$firstName, $lastName];
    }

    /**
     * Generate a 2fa code and save to the database.
     *
     * @return void
     */
    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $randomCode = rand(1000, 9999);
        if ($randomCode !== ($this->two_factor_code ?? '')) {
            $this->two_factor_code = $randomCode;
        }


        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->saveQuietly();
    }

    /**
     * Clear user two factor code.
     *
     * @return void
     */
    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->two_factor = 0;
        $this->saveQuietly();
    }

    public static function getHostUser()
    {
        return User::whereHas('roles', function ($q) {
            $q->where('title', Role::USER);
        })->get();
    }

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }

    public static function getAvatarUrl($firstName, $lastName = null, $size = null, $rounded = false)
    {
        $name = urlencode($firstName . ' ' . $lastName);
        $background = self::generateRandomColor($firstName, $lastName);
        $url = 'https://ui-avatars.com/api/?name=' . $name . '&background=' . $background;

        if ($rounded) {
            $url .= '&rounded=true';
        }

        if ($size) {
            $url .= '&size=' . $size;
        }

        return $url;
    }
    public static function generateRandomColor($firstName, $lastName = null)
    {
        $name = $firstName . ' ' . $lastName;
        $hash = md5($name); // Generate an MD5 hash based on the name

        // Extract the RGB components from the hash
        $red = hexdec(substr($hash, 0, 2));
        $green = hexdec(substr($hash, 2, 2));
        $blue = hexdec(substr($hash, 4, 2));

        return sprintf("%02x%02x%02x", $red, $green, $blue); // Convert RGB to hexadecimal color code
    }
}
