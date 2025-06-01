<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Authenticatable
{
    public const string TABLE_NAME = 'products';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_CATEGORY_ID = 'category_id';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
    ];

    protected $hidden = [];

    protected $casts = [];

    /*------------ Relations ------------*/

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, self::COLUMN_CATEGORY_ID, Category::COLUMN_ID);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, ProductImage::COLUMN_PRODUCT_ID, self::COLUMN_ID);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, OrderItem::COLUMN_PRODUCT_ID, self::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
