<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

/**
 *
 *
 * @property int $id
 * @property int $collection_id
 * @property int $product_id
 * @property int|null $sort
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|null $collection
 * @property-read string $jalali_created_at
 * @property-read Product|null $product
 * @method static Builder<static>|CollectionProduct newModelQuery()
 * @method static Builder<static>|CollectionProduct newQuery()
 * @method static Builder<static>|CollectionProduct query()
 * @method static Builder<static>|CollectionProduct whereCollectionId($value)
 * @method static Builder<static>|CollectionProduct whereCreatedAt($value)
 * @method static Builder<static>|CollectionProduct whereId($value)
 * @method static Builder<static>|CollectionProduct whereProductId($value)
 * @method static Builder<static>|CollectionProduct whereSort($value)
 * @method static Builder<static>|CollectionProduct whereUpdatedAt($value)
 * @mixin Eloquent
 */
class CollectionProduct extends Eloquent
{
    public const string TABLE_NAME = 'collection_products';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_COLLECTION_ID = 'collection_id';
    public const string COLUMN_PRODUCT_ID = 'product_id';

    protected $fillable = [
        'collection_id',
        'product_id',
    ];

    protected $hidden = [];

    protected $casts = [];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }

    /*------------ Relations ------------*/

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, self::COLUMN_COLLECTION_ID, Collection::COLUMN_ID);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, self::COLUMN_PRODUCT_ID, Product::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
