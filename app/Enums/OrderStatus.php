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
            self::Pending => 'badge-warning',
            self::Paid => 'badge-success',
            self::Shipped => 'badge-info',
            default => 'badge-danger',
        };
    }
}
