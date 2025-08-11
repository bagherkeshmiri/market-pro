<?php

namespace App\Models;

use App\Enums\IsActive;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $label
 * @property string $name
 * @property IsActive $is_active  0:no 1:yes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read string $is_active_badge_class
 * @property-read string $is_active_label
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, GateOrg> $org
 * @property-read int|null $org_count
 * @method static Builder<static>|Gate isActive()
 * @method static Builder<static>|Gate isNotActive()
 * @method static Builder<static>|Gate newModelQuery()
 * @method static Builder<static>|Gate newQuery()
 * @method static Builder<static>|Gate onlyTrashed()
 * @method static Builder<static>|Gate query()
 * @method static Builder<static>|Gate whereCreatedAt($value)
 * @method static Builder<static>|Gate whereDeletedAt($value)
 * @method static Builder<static>|Gate whereId($value)
 * @method static Builder<static>|Gate whereIsActive($value)
 * @method static Builder<static>|Gate whereLabel($value)
 * @method static Builder<static>|Gate whereName($value)
 * @method static Builder<static>|Gate whereUpdatedAt($value)
 * @method static Builder<static>|Gate withTrashed()
 * @method static Builder<static>|Gate withoutTrashed()
 * @mixin Eloquent
 */
class Gate extends Authenticatable
{
    use SoftDeletes;
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'gates';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'name',
        'label',
        'is_active',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_active' => IsActive::class,
    ];

    /*------------ Relations ------------*/

    public function org(): HasMany
    {
        return $this->hasMany(GateOrg::class, GateOrg::COLUMN_GATE_ID, self::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active->label();
    }

    public function getIsActiveBadgeClassAttribute(): string
    {
        return $this->is_active->badgeClass();
    }

    /*-------------- Scopes -------------*/

    public function scopeIsActive($query)
    {
        return $query->where('is_active', IsActive::Yes);
    }

    public function scopeIsNotActive($query)
    {
        return $query->where('is_active', IsActive::No);
    }

    /*---------- Other Functions --------*/

}
