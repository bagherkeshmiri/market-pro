<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $qty
 * @property string $unit_price
 * @property string $final_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property OrderStatus $status
 * @property-read Order|null $order
 * @property-read Product|null $product
 * @method static Builder<static>|OrderItem newModelQuery()
 * @method static Builder<static>|OrderItem newQuery()
 * @method static Builder<static>|OrderItem query()
 * @method static Builder<static>|OrderItem whereCreatedAt($value)
 * @method static Builder<static>|OrderItem whereFinalPrice($value)
 * @method static Builder<static>|OrderItem whereId($value)
 * @method static Builder<static>|OrderItem whereOrderId($value)
 * @method static Builder<static>|OrderItem whereProductId($value)
 * @method static Builder<static>|OrderItem whereQty($value)
 * @method static Builder<static>|OrderItem whereUnitPrice($value)
 * @method static Builder<static>|OrderItem whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OrderItem extends Eloquent
{
    public const string TABLE_NAME = 'order_items';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_ORDER_ID = 'order_id';
    public const string COLUMN_PRODUCT_ID = 'product_id';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'unit_price',
        'final_price',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

    /*------------ Relations ------------*/

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, self::COLUMN_ORDER_ID, Order::COLUMN_ID);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, self::COLUMN_PRODUCT_ID, Product::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
