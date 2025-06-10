<?php

namespace App\Enums;

enum ProductStatus: int
{
    case NotExist = 1;
    case Exist = 2;

    public function label(): string
    {
        return match ($this) {
            self::NotExist => __('global.not_exist'),
            self::Exist => __('global.exist'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Exist => 'badge-success',
            self::NotExist => 'badge-danger',
            default => 'badge-secondary',
        };
    }
}
