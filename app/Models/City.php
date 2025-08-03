<?php

namespace App\Models;

use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;


/**
 *
 *
 * @property int $id
 * @property int $province_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read Province|null $province
 * @method static Builder<static>|City newModelQuery()
 * @method static Builder<static>|City newQuery()
 * @method static Builder<static>|City query()
 * @method static Builder<static>|City whereCreatedAt($value)
 * @method static Builder<static>|City whereId($value)
 * @method static Builder<static>|City whereName($value)
 * @method static Builder<static>|City whereProvinceId($value)
 * @method static Builder<static>|City whereUpdatedAt($value)
 * @mixin Eloquent
 */
class City extends Authenticatable
{

    use HasJalaliTimestamps;

    public const string TABLE_NAME = 'cities';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_PROVINCE_ID = 'province_id';

    protected $fillable = [
        'province_id',
        'name',
    ];

    protected $hidden = [];

    protected $casts = [];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

    /*------------ Relations ------------*/

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, self::COLUMN_PROVINCE_ID, Province::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
