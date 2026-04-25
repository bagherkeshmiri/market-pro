<?php

namespace App\Enums;

enum SystemSettingType: string
{
    case String = 'string';
    case Integer = 'integer';
    case Json = 'json';
    case Boolean = 'boolean';
    case Array = 'array';

    public function label(): string
    {
        return match ($this) {
            self::String => __('global.string'),
            self::Integer => __('global.integer'),
            self::Json => __('global.json'),
            self::Boolean => __('global.boolean'),
            self::Array => __('global.array'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Integer => 'bg-rgba-info text-info',
            self::Json => 'bg-rgba-warning text-warning',
            self::Boolean => 'bg-rgba-danger text-danger',
            self::Array => 'bg-rgba-success text-success',
            default => 'bg-rgba-primary text-primary',
        };
    }
}
