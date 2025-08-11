<?php

namespace App\Traits;

use Morilog\Jalali\Jalalian;

trait HasJalaliTimestamps
{
    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }

    public function getJalaliUpdatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i:s');
    }
}
