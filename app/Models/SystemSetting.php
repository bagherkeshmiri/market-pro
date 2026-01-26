<?php

namespace App\Models;

use App\Enums\SystemSettingType;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

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

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
