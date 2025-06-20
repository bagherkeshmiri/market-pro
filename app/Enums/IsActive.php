<?php

namespace App\Enums;

enum IsActive: int
{
    case No = 0;
    case Yes = 1;

    public function label(): string
    {
        return match ($this) {
            self::No => __('global.in_active'),
            self::Yes => __('global.active'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::No => 'bg-rgba-danger text-danger',
            default => 'bg-rgba-success text-success',
        };
    }
}
