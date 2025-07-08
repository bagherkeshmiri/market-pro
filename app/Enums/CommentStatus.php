<?php

namespace App\Enums;

enum CommentStatus: int
{
    case Pending = 1;
    case Approved = 2;
    case Rejected = 3;

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('global.pending'),
            self::Approved => __('global.approved'),
            self::Rejected => __('global.rejected'),
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Pending => 'bg-rgba-warning text-warning',
            self::Approved => 'bg-rgba-success text-success',
            self::Rejected => 'bg-rgba-danger text-danger',
        };
    }
}
