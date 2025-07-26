<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case UnSuccess = 1;
    case Success = 2;

    public function label(): string
    {
        return match ($this) {
            self::UnSuccess => __('global.unSuccess'),
            self::Success => __('global.success'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Success => 'bg-rgba-success text-success',
            default => 'bg-rgba-danger text-danger',
        };
    }
}
