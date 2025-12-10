<?php

namespace App\Enums;

enum CommentStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

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
