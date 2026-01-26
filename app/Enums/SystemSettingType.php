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
        return 'bg-rgba-primary text-primary';
    }
}
