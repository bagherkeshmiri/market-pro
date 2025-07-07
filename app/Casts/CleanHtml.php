<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Mews\Purifier\Facades\Purifier;

class CleanHtml implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return Purifier::clean($value, 'ckeditor');
    }
}
