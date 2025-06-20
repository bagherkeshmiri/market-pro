<?php

namespace App\Enums;

enum UserType: int
{
    case User = 1;
    case Admin = 2;

    public function label(): string
    {
        return match ($this) {
            self::User => __('global.user'),
            self::Admin => __('global.admin'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::User => 'bg-rgba-info text-info',
            default => 'bg-rgba-primary text-primary',
        };
    }
}
