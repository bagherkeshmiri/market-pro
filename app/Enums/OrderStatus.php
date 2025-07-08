<?php

namespace App\Enums;

enum OrderStatus: int
{
    case Pending = 1;
    case Paid = 2;
    case Shipped = 3;
    case Cancelled = 4;

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('global.pending'),
            self::Paid => __('global.paid'),
            self::Shipped => __('global.shipped'),
            self::Cancelled => __('global.cancelled'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Pending => 'bg-rgba-warning text-warning',
            self::Paid => 'bg-rgba-success text-success',
            self::Shipped => 'bg-rgba-info text-info',
            default => 'bg-rgba-danger text-danger',
        };
    }
}
