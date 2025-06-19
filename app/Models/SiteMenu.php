<?php

namespace App\Models;

use App\Enums\IsActive;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;


/**
 *
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $key
 * @property string $value
 * @property IsActive $is_active  0 => no , 1 => yes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|SiteMenu newModelQuery()
 * @method static Builder<static>|SiteMenu newQuery()
 * @method static Builder<static>|SiteMenu query()
 * @method static Builder<static>|SiteMenu whereCreatedAt($value)
 * @method static Builder<static>|SiteMenu whereId($value)
 * @method static Builder<static>|SiteMenu whereIsActive($value)
 * @method static Builder<static>|SiteMenu whereKey($value)
 * @method static Builder<static>|SiteMenu whereParentId($value)
 * @method static Builder<static>|SiteMenu whereUpdatedAt($value)
 * @method static Builder<static>|SiteMenu whereValue($value)
 * @mixin Eloquent
 */
class SiteMenu extends Eloquent
{
    public const string TABLE_NAME = 'site_menus';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'key',
        'value',
        'is_active',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_active' => IsActive::class,
    ];

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

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
