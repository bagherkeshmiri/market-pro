<?php

namespace App\Models;

use App\Casts\CleanText;
use App\Enums\OrderStatus;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Str;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $user_address_id
 * @property string $order_number
 * @property OrderStatus $status
 * @property numeric $subtotal
 * @property numeric $discount
 * @property numeric $tax
 * @property numeric $shipping_fee
 * @property numeric $total
 * @property $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read UserAddress|null $address
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read string $status_badge_class
 * @property-read string $status_label
 * @property-read Collection<int, OrderItem> $orderItems
 * @property-read Collection<int, Payment> $payments
 * @property-read User $user
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @mixin Eloquent
 */
class Order extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

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
        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
        });
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

    public function address(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class, self::COLUMN_USER_ADDRESS_ID, UserAddress::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    public function getStatusLabelAttribute(): string
    {
        return $this->status->label();
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return $this->status->badgeClass();
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
