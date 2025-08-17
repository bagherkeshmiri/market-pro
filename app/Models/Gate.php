<?php

namespace App\Models;

use App\Enums\IsActive;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string|null $token
 * @property IsActive $is_active
 * @property IsActive $is_default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read string $is_active_badge_class
 * @property-read string $is_active_label
 * @property-read string $is_default_badge_class
 * @property-read string $is_default_label
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @method static Builder<static>|Gate isActive()
 * @method static Builder<static>|Gate isDefault()
 * @method static Builder<static>|Gate isNotActive()
 * @method static Builder<static>|Gate isNotDefault()
 * @method static Builder<static>|Gate newModelQuery()
 * @method static Builder<static>|Gate newQuery()
 * @method static Builder<static>|Gate onlyTrashed()
 * @method static Builder<static>|Gate query()
 * @method static Builder<static>|Gate whereCreatedAt($value)
 * @method static Builder<static>|Gate whereDeletedAt($value)
 * @method static Builder<static>|Gate whereId($value)
 * @method static Builder<static>|Gate whereIsActive($value)
 * @method static Builder<static>|Gate whereIsDefault($value)
 * @method static Builder<static>|Gate whereLabel($value)
 * @method static Builder<static>|Gate whereName($value)
 * @method static Builder<static>|Gate whereToken($value)
 * @method static Builder<static>|Gate whereUpdatedAt($value)
 * @method static Builder<static>|Gate withTrashed(bool $withTrashed = true)
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
        'token',
        'is_active',
        'is_default',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_active' => IsActive::class,
        'is_default' => IsActive::class,
        'token' => 'encrypted',
    ];

    /*------------ Relations ------------*/

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

    public function getMaskedTokenAttribute(): string
    {
        if ($this->token) {
            return '**********' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        }
        return '';
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
