<?php

namespace App\Enums;

enum DiscountType: int
{
    case Percent = 1;
    case Amount = 2;

    public function label(): string
    {
        return match ($this) {
            self::Percent => __('global.percent'),
            self::Amount => __('global.amount'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Percent => 'badge-success',
            default => 'badge-warning',
        };
    }
}
