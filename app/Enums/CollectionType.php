<?php

namespace App\Enums;

enum CollectionType: int
{
    case Product = 1;
    case Banner = 2;
    case Slider = 3;
    case Box = 4;

    public function label(): string
    {
        return match ($this) {
            self::Product => __('global.product'),
            self::Banner => __('global.banner'),
            self::Slider => __('global.slider'),
            self::Box => __('global.box'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Banner => 'badge-danger',
            self::Slider => 'badge-success',
            self::Box => 'badge-warning',
            default => 'badge-secondary',
        };
    }
}
