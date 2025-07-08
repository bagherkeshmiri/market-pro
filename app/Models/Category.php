<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read string $jalali_created_at
 * @property-read Image|null $image
 * @property-read Category|null $parent
 * @property-read Collection<int, Product> $products
 * @property-read int|null $products_count
 * @method static Builder<static>|Category newModelQuery()
 * @method static Builder<static>|Category newQuery()
 * @method static Builder<static>|Category onlyTrashed()
 * @method static Builder<static>|Category query()
 * @method static Builder<static>|Category whereCreatedAt($value)
 * @method static Builder<static>|Category whereDeletedAt($value)
 * @method static Builder<static>|Category whereId($value)
 * @method static Builder<static>|Category whereName($value)
 * @method static Builder<static>|Category whereParentId($value)
 * @method static Builder<static>|Category whereUpdatedAt($value)
 * @method static Builder<static>|Category withTrashed()
 * @method static Builder<static>|Category withoutTrashed()
 * @mixin Eloquent
 */
class Category extends Eloquent
{
    use SoftDeletes;

    public const string TABLE_NAME = 'categories';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_PARENT_ID = 'parent_id';

    protected $fillable = [
        'name',
        'parent_id',
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, self::COLUMN_PARENT_ID, self::COLUMN_ID);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, self::COLUMN_PARENT_ID, self::COLUMN_ID);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, Product::COLUMN_CATEGORY_ID, self::COLUMN_ID);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
