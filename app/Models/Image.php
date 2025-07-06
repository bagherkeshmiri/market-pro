<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;


/**
 *
 *
 * @property int $id
 * @property int $imageable_id
 * @property string $imageable_type
 * @property bool $is_main
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $jalali_created_at
 * @property-read Model|\Eloquent $imageable
 * @method static Builder<static>|Image newModelQuery()
 * @method static Builder<static>|Image newQuery()
 * @method static Builder<static>|Image query()
 * @method static Builder<static>|Image whereCreatedAt($value)
 * @method static Builder<static>|Image whereId($value)
 * @method static Builder<static>|Image whereImageableId($value)
 * @method static Builder<static>|Image whereImageableType($value)
 * @method static Builder<static>|Image whereIsMain($value)
 * @method static Builder<static>|Image whereUpdatedAt($value)
 * @method static Builder<static>|Image whereUrl($value)
 * @mixin Eloquent
 */
class Image extends Eloquent
{
    public const string TABLE_NAME = 'images';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'url',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_main' => 'boolean',
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

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }


    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
