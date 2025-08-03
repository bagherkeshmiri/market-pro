<?php

namespace App\Models;

use App\Casts\CleanText;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use LaravelIdea\Helper\App\Models\_IH_Permission_QB;
use Morilog\Jalali\Jalalian;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $province_id
 * @property int $city_id
 * @property $address
 * @property string|null $postal_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read City|null $city
 * @property-read string $full_address
 * @property-read string $jalali_created_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Order> $orders
 * @property-read int|null $orders_count
 * @property-read Province|null $province
 * @property-write mixed $password
 * @property-read User|null $user
 * @method static Builder<static>|UserAddress newModelQuery()
 * @method static Builder<static>|UserAddress newQuery()
 * @method static Builder<static>|UserAddress query()
 * @method static Builder<static>|UserAddress whereAddress($value)
 * @method static Builder<static>|UserAddress whereCityId($value)
 * @method static Builder<static>|UserAddress whereCreatedAt($value)
 * @method static Builder<static>|UserAddress whereId($value)
 * @method static Builder<static>|UserAddress wherePostalCode($value)
 * @method static Builder<static>|UserAddress whereProvinceId($value)
 * @method static Builder<static>|UserAddress whereUpdatedAt($value)
 * @method static Builder<static>|UserAddress whereUserId($value)
 * @mixin Eloquent
 */
class UserAddress extends Authenticatable
{
    use HasJalaliTimestamps;

    public const string TABLE_NAME = 'user_addresses';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_USER_ID = 'user_id';
    public const string COLUMN_PROVINCE_ID = 'province_id';
    public const string COLUMN_CITY_ID = 'city_id';

    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'address',
        'postal_code',
    ];

    protected $hidden = [];

    protected $casts = [
        'address' => CleanText::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

    /*------------ Relations ------------*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::COLUMN_USER_ID, User::COLUMN_ID);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, Order::COLUMN_USER_ADDRESS_ID, self::COLUMN_ID);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, self::COLUMN_CITY_ID, City::COLUMN_ID);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, self::COLUMN_PROVINCE_ID, Province::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getFullAddressAttribute(): string
    {
        $provinceName = $this->province ? $this->province->name : '';
        $cityName = $this->city ? $this->city->name : '';
        $address = $this->address ?? '';

        $parts = array_filter([$provinceName, $cityName, $address]);

        return implode(' - ', $parts);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/


}
