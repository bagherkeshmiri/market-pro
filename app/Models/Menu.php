<?php

namespace App\Models;

use App\Enums\IsActive;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

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

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Jalalian::forge($value)->format('Y/m/d H:i:s'),
        );
    }
}
