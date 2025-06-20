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
            self::Banner => 'bg-rgba-danger text-danger',
            self::Slider => 'bg-rgba-success text-success',
            self::Box => 'bg-rgba-warning text-warning',
            default => 'bg-rgba-primary text-primary',
        };
    }
}
