<?php

namespace App\Traits;

trait SampleImages
{
    public function getSampleImageUrl(): string
    {
        return config('defaults.sample-image');
    }
}
