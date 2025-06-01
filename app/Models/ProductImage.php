<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $product_id
 * @property string $image_url
 * @property bool $is_main
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Product|null $product
 * @method static Builder<static>|ProductImage newModelQuery()
 * @method static Builder<static>|ProductImage newQuery()
 * @method static Builder<static>|ProductImage query()
 * @method static Builder<static>|ProductImage whereCreatedAt($value)
 * @method static Builder<static>|ProductImage whereDeletedAt($value)
 * @method static Builder<static>|ProductImage whereId($value)
 * @method static Builder<static>|ProductImage whereImageUrl($value)
 * @method static Builder<static>|ProductImage whereIsMain($value)
 * @method static Builder<static>|ProductImage whereProductId($value)
 * @method static Builder<static>|ProductImage whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ProductImage extends Authenticatable
{
    use SoftDeletes;

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
