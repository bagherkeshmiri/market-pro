<?php

namespace App\Models;

use App\Enums\DiscountType;
use App\Enums\IsActive;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

/**
 * @property int $id
 * @property string $code
 * @property DiscountType $type  1:percentage , 2:amount
 * @property IsActive $is_active  0:no , 1:yes
 * @property int $amount
 * @property int $usage_limit
 * @property int $used_count
 * @property int $min_order_amount
 * @property int $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $is_active_badge_class
 * @property-read string $is_active_label
 * @property-read string $jalali_created_at
 * @property-read string|null $jalali_expire_at
 * @property-read string $jalali_updated_at
 * @property-read string $type_badge_class
 * @property-read string $type_label
 * @method static Builder<static>|DiscountCode isActive()
 * @method static Builder<static>|DiscountCode isAmount()
 * @method static Builder<static>|DiscountCode isNotActive()
 * @method static Builder<static>|DiscountCode isPercentage()
 * @method static Builder<static>|DiscountCode newModelQuery()
 * @method static Builder<static>|DiscountCode newQuery()
 * @method static Builder<static>|DiscountCode query()
 * @method static Builder<static>|DiscountCode whereAmount($value)
 * @method static Builder<static>|DiscountCode whereCode($value)
 * @method static Builder<static>|DiscountCode whereCreatedAt($value)
 * @method static Builder<static>|DiscountCode whereExpiresAt($value)
 * @method static Builder<static>|DiscountCode whereId($value)
 * @method static Builder<static>|DiscountCode whereIsActive($value)
 * @method static Builder<static>|DiscountCode whereMinOrderAmount($value)
 * @method static Builder<static>|DiscountCode whereType($value)
 * @method static Builder<static>|DiscountCode whereUpdatedAt($value)
 * @method static Builder<static>|DiscountCode whereUsageLimit($value)
 * @method static Builder<static>|DiscountCode whereUsedCount($value)
 * @mixin Eloquent
 */
class DiscountCode extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'discount_codes';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'code',
        'type',
        'is_active',
        'amount',
        'usage_limit',
        'used_count',
        'min_order_amount',
        'expires_at',
    ];

    protected $hidden = [];

    protected $casts = [
        'type' => DiscountType::class,
        'is_active' => IsActive::class,
        'expires_at' => 'datetime',
    ];

    /*------------ Relations ------------*/

    public function usages(): HasMany
    {
        return $this->hasMany(DiscountCodeUser::class, DiscountCodeUser::COLUMN_DISCOUNT_CODE_ID, self::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    public function getTypeLabelAttribute(): string
    {
        return $this->type->label();
    }

    public function getTypeBadgeClassAttribute(): string
    {
        return $this->type->badgeClass();
    }

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active->label();
    }

    public function getIsActiveBadgeClassAttribute(): string
    {
        return $this->is_active->badgeClass();
    }

    public function getJalaliExpireAtAttribute(): ?string
    {
        return $this->expires_at
            ? Jalalian::fromCarbon($this->expires_at->setTimezone('Asia/Tehran'))->format('Y/m/d H:i:s')
            : null;
    }

    /*-------------- Scopes -------------*/

    public function scopeIsActive($query)
    {
        return $query->where('is_active', IsActive::Yes);
    }

    public function scopeIsNotActive($query)
    {
        return $query->where('is_active', IsActive::No);
    }

    public function scopeIsPercentage($query)
    {
        return $query->where('type', DiscountType::Percent);
    }

    public function scopeIsAmount($query)
    {
        return $query->where('type', DiscountType::Amount);
    }


    /*---------- Other Functions --------*/

    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }

    public function calculateDiscount(float|int $orderAmount): float
    {
        if ($this->type == DiscountType::Percent) {
            return ($orderAmount * $this->amount) / 100;
        }

        return $this->amount;
    }
}
