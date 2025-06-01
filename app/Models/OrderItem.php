<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OrderItem extends Authenticatable
{
    public const string TABLE_NAME = 'order_items';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_ORDER_ID = 'order_id';
    public const string COLUMN_PRODUCT_ID = 'product_id';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    /*------------ Relations ------------*/

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, self::COLUMN_ORDER_ID, Order::COLUMN_ID);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, self::COLUMN_PRODUCT_ID, Product::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
