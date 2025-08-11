<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasDefaultOrdering
{
    public static function bootHasDefaultOrdering(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }
}
