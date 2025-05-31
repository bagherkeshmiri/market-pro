<?php

use Illuminate\Support\Collection;
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


if (!function_exists('user_type_labels')) {
    function showEnumLabels(string|int $enum): Collection
    {
        return collect($enum::cases())->mapWithKeys(fn($status) => [
            $status->label() => $status->value
        ]);
    }
}
