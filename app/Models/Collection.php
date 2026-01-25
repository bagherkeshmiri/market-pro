<?php

namespace App\Models;

use App\Enums\CollectionType;
use App\Enums\IsActive;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $title
 * @property CollectionType $type
 * @property int|null $limitation
 * @property int|null $sort
 * @property IsActive $is_active  0:active , 1:not_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CollectionCategory> $categoryCollection
 * @property-read string $is_active_badge_class
 * @property-read string $is_active_label
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read string $type_badge_class
 * @property-read string $type_label
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CollectionProduct> $productCollection
 * @method static Builder<static>|Collection newModelQuery()
 * @method static Builder<static>|Collection newQuery()
 * @method static Builder<static>|Collection query()
 * @mixin Eloquent
 */
class Collection extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'collections';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'title',
        'type',
        'limitation',
        'sort',
        'is_active',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_active' => IsActive::class,
        'type' => CollectionType::class,
    ];

    /*------------ Relations ------------*/

    public function productCollection(): HasMany
    {
        return $this->hasMany(CollectionProduct::class, CollectionProduct::COLUMN_COLLECTION_ID, self::COLUMN_ID);
    }

    public function categoryCollection(): HasMany
    {
        return $this->hasMany(CollectionCategory::class, CollectionCategory::COLUMN_COLLECTION_ID, self::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    public function getTypeLabelAttribute(): string
    {
        return $this->type->label();
    }

    public function getTypeBadgeClassAttribute(): string
    {
        return $this->type->badgeClass();
    }

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active->label();
    }

    public function getIsActiveBadgeClassAttribute(): string
    {
        return $this->is_active->badgeClass();
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
