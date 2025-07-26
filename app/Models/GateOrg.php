<?php


namespace App\Models;

use App\Enums\IsActive;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Morilog\Jalali\Jalalian;


class GateOrg extends Authenticatable
{
    use SoftDeletes;

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

    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }

    /*------------ Relations ------------*/

    public function gate(): BelongsTo
    {
        return $this->belongsTo(Gate::class, self::COLUMN_GATE_ID, Gate::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
