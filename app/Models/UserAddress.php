<?php

namespace App\Models;

use App\Casts\CleanText;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $province_id
 * @property int|null $city_id
 * @property $address
 * @property string|null $postal_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read City|null $city
 * @property-read string $full_address
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Order> $orders
 * @property-read Province|null $province
 * @property-write mixed $password
 * @property-read User $user
 * @method static Builder<static>|UserAddress newModelQuery()
 * @method static Builder<static>|UserAddress newQuery()
 * @method static Builder<static>|UserAddress query()
 * @mixin Eloquent
 */
class UserAddress extends Authenticatable
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

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
