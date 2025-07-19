<?php

namespace App\Enums;

enum PostIsPublish: int
{
    case No = 0;
    case Yes = 1;

    public function label(): string
    {
        return match ($this) {
            self::No => __('global.not_published'),
            self::Yes => __('global.published'),
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
