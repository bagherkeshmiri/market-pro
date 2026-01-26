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

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
