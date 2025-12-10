<?php

namespace App\Enums;

enum ProductStatus: string
{
    case NotExist = 'not_exist';
    case Exist = 'exist';

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
            self::Exist => 'bg-rgba-success text-success',
            self::NotExist => 'bg-rgba-danger text-danger',
            default => 'bg-rgba-primary text-primary',
        };
    }
}
