<?php

namespace App\Enums;

enum DiscountType: string
{
    case Percent = 'percent';
    case Amount = 'amount';

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
            self::Percent => 'bg-rgba-info text-info',
            default => 'bg-rgba-primary text-primary',
        };
    }
}
