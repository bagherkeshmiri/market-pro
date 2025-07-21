<?php

namespace App\Traits;

trait SampleImages
{
    public function getSampleImageUrl(): string
    {
        return config('defaults.default_image');
    }
}
