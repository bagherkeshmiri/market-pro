<?php

namespace App\Models;

use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $code
 * @property string $type
 * @property string $amount
 * @property int|null $usage_limit
 * @property int $used_count
 * @property string $min_order_amount
 * @property int|null $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @method static Builder<static>|DiscountCode newModelQuery()
 * @method static Builder<static>|DiscountCode newQuery()
 * @method static Builder<static>|DiscountCode query()
 * @method static Builder<static>|DiscountCode whereAmount($value)
 * @method static Builder<static>|DiscountCode whereCode($value)
 * @method static Builder<static>|DiscountCode whereCreatedAt($value)
 * @method static Builder<static>|DiscountCode whereExpiresAt($value)
 * @method static Builder<static>|DiscountCode whereId($value)
 * @method static Builder<static>|DiscountCode whereMinOrderAmount($value)
 * @method static Builder<static>|DiscountCode whereType($value)
 * @method static Builder<static>|DiscountCode whereUpdatedAt($value)
 * @method static Builder<static>|DiscountCode whereUsageLimit($value)
 * @method static Builder<static>|DiscountCode whereUsedCount($value)
 * @mixin Eloquent
 */
class DiscountCode extends Authenticatable
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'discount_codes';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'code',
        'type',
        'amount',
        'usage_limit',
        'used_count',
        'min_order_amount',
        'expires_at',
    ];

    protected $hidden = [];

    protected $casts = [
        'expires_at' => 'timestamp',
    ];

    /*------------ Relations ------------*/

    /*-------------- Accessors & Mutators -------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

    public function isValid($cartTotal): true|string
    {
        if ($cartTotal < $this->min_order_amount) {
            return "حداقل مبلغ سبد خرید برای این کد رعایت نشده است.";
        }

        if ($this->expires_at && Carbon::now()->gt($this->expires_at)) {
            return "این کد منقضی شده است.";
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return "این کد به حد نصاب استفاده رسیده است.";
        }

        return true;
    }

    public function applyDiscount($cartTotal)
    {
        if ($this->type === 'percentage') {
            return $cartTotal - ($cartTotal * ($this->value / 100));
        }

        return max(0, $cartTotal - $this->value);
    }


    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }

}
