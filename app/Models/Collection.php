<?php

namespace App\Models;

use App\Enums\CollectionType;
use App\Enums\IsActive;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;


/**
 *
 *
 * @property int $id
 * @property string|null $title
 * @property CollectionType $type  1 => product , 2 => banner , 3 => slider , 4 => box
 * @property int|null $limitation
 * @property int|null $sort
 * @property IsActive $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Category|null $category
 * @property-read string $jalali_created_at
 * @property-read string $type_badge_class
 * @property-read string $type_label
 * @method static Builder<static>|Collection newModelQuery()
 * @method static Builder<static>|Collection newQuery()
 * @method static Builder<static>|Collection query()
 * @method static Builder<static>|Collection whereCategoryId($value)
 * @method static Builder<static>|Collection whereCreatedAt($value)
 * @method static Builder<static>|Collection whereDeletedAt($value)
 * @method static Builder<static>|Collection whereId($value)
 * @method static Builder<static>|Collection whereIsActive($value)
 * @method static Builder<static>|Collection whereLimitation($value)
 * @method static Builder<static>|Collection whereSort($value)
 * @method static Builder<static>|Collection whereTitle($value)
 * @method static Builder<static>|Collection whereType($value)
 * @method static Builder<static>|Collection whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Collection extends Eloquent
{
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

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

    public function getTypeLabelAttribute(): string
    {
        return $this->type->label();
    }

    public function getTypeBadgeClassAttribute(): string
    {
        return $this->type->badgeClass();
    }

    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }


    /*------------ Relations ------------*/

    public function product(): HasOne
    {
        return $this->hasOne(CollectionProduct::class, CollectionProduct::COLUMN_PRODUCT_ID, self::COLUMN_ID);
    }


    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
