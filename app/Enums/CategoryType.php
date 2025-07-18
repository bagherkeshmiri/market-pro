<?php

namespace App\Enums;

enum CategoryType: int
{
    case Product = 1;
    case Post = 2;

    public function label(): string
    {
        return match ($this) {
            self::Post => __('global.post'),
            default => __('global.product')
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Post => 'bg-rgba-success text-success',
            default => 'bg-rgba-primary text-primary',
        };
    }
}
