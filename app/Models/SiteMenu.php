<?php

namespace App\Models;

use App\Enums\IsActive;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property IsActive $is_active
 * @property-read mixed $created_at
 * @method static Builder<static>|SiteMenu newModelQuery()
 * @method static Builder<static>|SiteMenu newQuery()
 * @method static Builder<static>|SiteMenu query()
 * @mixin Eloquent
 */
class SiteMenu extends Model
{
    public const string TABLE_NAME = 'site_menus';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'key',
        'value',
        'is_active',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_active' => IsActive::class,
    ];

    /*------------ Relations ------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
