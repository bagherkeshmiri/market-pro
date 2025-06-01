<?php

namespace App\Enums;

enum OrderStatus: int
{
    case Pending = 1;
    case Paid = 2;
    case Shipped = 3;
    case Cancelled = 4;
}
