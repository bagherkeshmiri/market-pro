<?php

namespace App\Enums;

enum UserType: int
{
    case User = 1;
    case Admin = 2;


    public function label(): string
    {
        return match($this) {
            self::User => 'کاربر',
            self::Admin => 'ادمین',
        };
    }
}
