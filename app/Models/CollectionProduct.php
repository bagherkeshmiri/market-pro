<?php

namespace App\Models;

use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $collection_id
 * @property int $product_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection $collection
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read Product $product
 * @method static Builder<static>|CollectionProduct newModelQuery()
 * @method static Builder<static>|CollectionProduct newQuery()
 * @method static Builder<static>|CollectionProduct query()
 * @mixin Eloquent
 */
class CollectionProduct extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

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

    /*------------ Relations ------------*/

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, self::COLUMN_COLLECTION_ID, Collection::COLUMN_ID);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, self::COLUMN_PRODUCT_ID, Product::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
