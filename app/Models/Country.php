<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property string $short_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Campus[] $countryCampuses
 * @property-read int|null $country_campuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $countryReviews
 * @property-read int|null $country_reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\School[] $countrySchools
 * @property-read int|null $country_schools_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $countryStudents
 * @property-read int|null $country_students_count
 * @method static \Database\Factories\CountryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Query\Builder|Country onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Country withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Country withoutTrashed()
 * @mixin \Eloquent
 */
class Country extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'countries';

    protected static function booted()
    {
        static::addGlobalScope('orderByName', function ($builder) {
            $builder->orderBy('name');
        });
    }

    protected $fillable = [
        'name',
        'short_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function countryUsers()
    {
        return $this->hasMany(Country::class, 'country_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
