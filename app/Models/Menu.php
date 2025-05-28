<?php

namespace App\Models;

use App\Enums\IsActive;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

/**
 *
 *
 * @property IsActive $is_active
 * @property-read mixed $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu query()
 * @mixin \Eloquent
 */
class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'key',
        'value',
        'is_active',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_active' => IsActive::class,
    ];

}
