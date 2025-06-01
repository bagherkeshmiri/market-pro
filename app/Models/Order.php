<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Authenticatable
{
    public const string TABLE_NAME = 'orders';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_USER_ID = 'user_id';

    protected $fillable = [
        'user_id',
        'status',
        'total_price',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    /*------------ Relations ------------*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::COLUMN_USER_ID, User::COLUMN_ID);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, OrderItem::COLUMN_ORDER_ID, self::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
