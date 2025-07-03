<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Category;
use App\Models\Product;

class Index extends SiteComponent
{
    public function render()
    {
        $pageTitle = 'فروشگاه اینترنتی رویسر';
        $sampleProductImageUrl = $this->sampleProductImageUrl;

        return $this->renderView(
            'livewire.site.index',
            $pageTitle,
            compact('sampleProductImageUrl')
        );
    }
}
