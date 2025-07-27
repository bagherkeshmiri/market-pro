<?php

namespace App\Models;

use App\Enums\IsActive;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class Gate extends Authenticatable
{
    use SoftDeletes;

    public const string TABLE_NAME = 'gates';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'name',
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


    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active->label();
    }

    public function getIsActiveBadgeClassAttribute(): string
    {
        return $this->is_active->badgeClass();
    }

    /*------------ Relations ------------*/

    public function org(): HasMany
    {
        return $this->hasMany(GateOrg::class, GateOrg::COLUMN_GATE_ID, self::COLUMN_ID);
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
