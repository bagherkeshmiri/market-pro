<?php


namespace App\Models;

use App\Enums\IsActive;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $gate_id
 * @property string $label
 * @property string|null $app_key
 * @property IsActive $is_active  0:no 1:yes
 * @property IsActive $is_default  0:no 1:yes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Gate|null $gate
 * @property-read string $is_active_badge_class
 * @property-read string $is_active_label
 * @property-read string $is_default_badge_class
 * @property-read string $is_default_label
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @method static Builder<static>|GateOrg isActive()
 * @method static Builder<static>|GateOrg isDefault()
 * @method static Builder<static>|GateOrg isNotActive()
 * @method static Builder<static>|GateOrg isNotDefault()
 * @method static Builder<static>|GateOrg newModelQuery()
 * @method static Builder<static>|GateOrg newQuery()
 * @method static Builder<static>|GateOrg onlyTrashed()
 * @method static Builder<static>|GateOrg query()
 * @method static Builder<static>|GateOrg whereAppKey($value)
 * @method static Builder<static>|GateOrg whereCreatedAt($value)
 * @method static Builder<static>|GateOrg whereDeletedAt($value)
 * @method static Builder<static>|GateOrg whereGateId($value)
 * @method static Builder<static>|GateOrg whereId($value)
 * @method static Builder<static>|GateOrg whereIsActive($value)
 * @method static Builder<static>|GateOrg whereIsDefault($value)
 * @method static Builder<static>|GateOrg whereLabel($value)
 * @method static Builder<static>|GateOrg whereUpdatedAt($value)
 * @method static Builder<static>|GateOrg withTrashed()
 * @method static Builder<static>|GateOrg withoutTrashed()
 * @mixin Eloquent
 */
class GateOrg extends Authenticatable
{
    use SoftDeletes;
    use HasJalaliTimestamps;

    public const string TABLE_NAME = 'gates_org';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_GATE_ID = 'gate_id';

    protected $fillable = [
        'gate_id',
        'label',
        'app_key',
        'is_active',
        'is_default',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_active' => IsActive::class,
        'is_default' => IsActive::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

    /*------------ Relations ------------*/

    public function gate(): BelongsTo
    {
        return $this->belongsTo(Gate::class, self::COLUMN_GATE_ID, Gate::COLUMN_ID);
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


    public function getIsDefaultLabelAttribute(): string
    {
        return $this->is_default->label();
    }

    public function getIsDefaultBadgeClassAttribute(): string
    {
        return $this->is_default->badgeClass();
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

    public function scopeIsDefault($query)
    {
        return $query->where('is_default', IsActive::Yes);
    }

    public function scopeIsNotDefault($query)
    {
        return $query->where('is_default', IsActive::No);
    }

    /*---------- Other Functions --------*/

}
