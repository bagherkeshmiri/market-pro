<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;

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
