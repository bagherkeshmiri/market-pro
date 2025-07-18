<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Collection;
use Illuminate\View\View;

class Index extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'فروشگاه اینترنتی رویسر';
        $sampleProductImageUrl = $this->sampleProductImageUrl;

        $collections = Collection::whereIsActive(true)
            ->orderBy('sort')
            ->with([
                'productCollection',
                'categoryCollection:id,collection_id,category_id',
                'categoryCollection.category:id,name',
                'categoryCollection.category.image:id,imageable_id,imageable_type,url',
            ])
            ->get();

        return $this->renderView(
            'livewire.site.index',
            $pageTitle,
            compact('sampleProductImageUrl', 'collections')
        );
    }
}
