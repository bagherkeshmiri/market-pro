<?php

namespace App\Models;

use App\Casts\CleanText;
use App\Enums\OrderStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;
use Str;


/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $user_address_id
 * @property string $order_number
 * @property OrderStatus $status  1:pending , 2:paid , 3:shipped , 4: cancelled
 * @property string $subtotal
 * @property string $discount
 * @property string $tax
 * @property string $shipping_fee
 * @property string $total
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $jalali_created_at
 * @property-read string $status_badge_class
 * @property-read string $status_label
 * @property-read Collection<int, OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read Collection<int, Payment> $payments
 * @property-read int|null $payments_count
 * @property-read User|null $user
 * @property-read UserAddress|null $userAddresses
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @method static Builder<static>|Order whereCreatedAt($value)
 * @method static Builder<static>|Order whereDescription($value)
 * @method static Builder<static>|Order whereDiscount($value)
 * @method static Builder<static>|Order whereId($value)
 * @method static Builder<static>|Order whereOrderNumber($value)
 * @method static Builder<static>|Order whereShippingFee($value)
 * @method static Builder<static>|Order whereStatus($value)
 * @method static Builder<static>|Order whereSubtotal($value)
 * @method static Builder<static>|Order whereTax($value)
 * @method static Builder<static>|Order whereTotal($value)
 * @method static Builder<static>|Order whereUpdatedAt($value)
 * @method static Builder<static>|Order whereUserAddressId($value)
 * @method static Builder<static>|Order whereUserId($value)
 * @mixin Eloquent
 */
class Order extends Eloquent
{
    public const string TABLE_NAME = 'orders';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_USER_ID = 'user_id';
    public const string COLUMN_USER_ADDRESS_ID = 'user_address_id';

    protected $fillable = [
        'user_id',
        'user_address_id',
        'status',
        'subtotal',
        'discount',
        'tax',
        'shipping_fee',
        'total',
        'description',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => OrderStatus::class,
        'description' => CleanText::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });


        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
        });
    }

    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->status->label();
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return $this->status->badgeClass();
    }

    /*------------ Relations ------------*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::COLUMN_USER_ID, User::COLUMN_ID);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, OrderItem::COLUMN_ORDER_ID, self::COLUMN_ID);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, Payment::COLUMN_ORDER_ID, self::COLUMN_ID);
    }

    public function userAddresses(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class, self::COLUMN_USER_ADDRESS_ID, UserAddress::COLUMN_ID);
    }


    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

    public static function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . strtoupper(Str::random(10));
        } while (self::where('order_number', $number)->exists());

        return $number;
    }
}
