<?php

use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

if (!function_exists('jalali')) {
    function jalali($date = null, string $format = 'Y/m/d H:i:s'): ?string
    {
        if (!$date) {
            return null;
        }

        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        return Jalalian::fromCarbon($date)->format($format);
    }
}
