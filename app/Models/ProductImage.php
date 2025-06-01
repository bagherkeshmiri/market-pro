<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProductImage extends Authenticatable
{
    public const string TABLE_NAME = 'product_images';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_PRODUCT_ID = 'product_id';

    protected $fillable = [
        'product_id',
        'image_url',
        'is_main',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    /*------------ Relations ------------*/

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, self::COLUMN_PRODUCT_ID, Product::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
