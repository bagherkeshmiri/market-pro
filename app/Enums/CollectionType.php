<?php

namespace App\Enums;

enum CollectionType: string
{
    case Product = 'product';
    case Category = 'category';

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
