<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Collection;

class Index extends SiteComponent
{
    public function render()
    {
        $pageTitle = 'فروشگاه اینترنتی رویسر';
        $sampleProductImageUrl = $this->sampleProductImageUrl;

        $collections = Collection::whereIsActive(true)
            ->orderBy('sort')
            ->with([
                'productCollection',
                'categoryCollection:id,collection_id,category_id',
                'categoryCollection.category:id,name',
            ])
            ->get();

        return $this->renderView(
            'livewire.site.index',
            $pageTitle,
            compact('sampleProductImageUrl', 'collections')
        );
    }
}
