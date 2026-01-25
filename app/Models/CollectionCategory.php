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
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category $category
 * @property-read Collection $collection
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @method static Builder<static>|CollectionCategory newModelQuery()
 * @method static Builder<static>|CollectionCategory newQuery()
 * @method static Builder<static>|CollectionCategory query()
 * @mixin Eloquent
 */
class CollectionCategory extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'collection_categories';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_COLLECTION_ID = 'collection_id';
    public const string COLUMN_CATEGORY_ID = 'category_id';

    protected $fillable = [
        'collection_id',
        'category_id',
    ];

    protected $hidden = [];

    protected $casts = [];

    /*------------ Relations ------------*/

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, self::COLUMN_COLLECTION_ID, Collection::COLUMN_ID);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, self::COLUMN_CATEGORY_ID, Product::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
