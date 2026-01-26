<?php

namespace App\Models;

use App\Enums\SystemSettingType;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $label
 * @property string $key
 * @property string|null $value
 * @property SystemSettingType $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $casted_value
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read string $type_badge_class
 * @property-read string $type_label
 * @method static Builder<static>|SystemSetting newModelQuery()
 * @method static Builder<static>|SystemSetting newQuery()
 * @method static Builder<static>|SystemSetting query()
 * @mixin Eloquent
 */
class SystemSetting extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'system_settings';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'label',
        'key',
        'value',
        'type',
    ];

    protected $hidden = [];

    protected $casts = [
        'type' => SystemSettingType::class,
    ];

    protected static function booted(): void
    {
        static::updating(function ($setting) {
            if ($setting->isDirty('key')) {
                cache()->forget('setting_' . $setting->getOriginal('key'));
            }
        });

        static::saved(function ($setting) {
            cache()->forget('setting_' . $setting->key);
        });

        static::deleted(function ($setting) {
            cache()->forget('setting_' . $setting->key);
        });
    }

    /*------------ Relations ------------*/

    /*-------------- Accessors & Mutators -------------*/

    public function getTypeLabelAttribute(): string
    {
        return $this->type->label();
    }

    public function getTypeBadgeClassAttribute(): string
    {
        return $this->type->badgeClass();
    }

    public function getCastedValueAttribute()
    {
        return match ($this->type) {
            SystemSettingType::Boolean => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            SystemSettingType::Integer => (int) $this->value,
            SystemSettingType::Json    => json_decode($this->value, true),
            default                    => $this->value,
        };
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
