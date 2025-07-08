<?php

namespace App\Enums;

enum CollectionType: int
{
    case Product = 1;
    case Category = 2;

    public function label(): string
    {
        return match ($this) {
            self::Category => __('global.category'),
            default => __('global.product')
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Category => 'bg-rgba-success text-success',
            default => 'bg-rgba-primary text-primary',
        };
    }
}
