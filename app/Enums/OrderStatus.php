<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Shipped = 'shipped';
    case Cancelled = 'cancelled';

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
