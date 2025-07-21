<?php

namespace App\Livewire\Site;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Collection;
use App\Models\Post;
use Illuminate\View\View;

class Index extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'فروشگاه اینترنتی رویسر';
        $sampleImageUrl = $this->sampleImageUrl;

        $collections = Collection::whereIsActive(true)
            ->orderBy('sort')
            ->with([
                'productCollection',
                'categoryCollection:id,collection_id,category_id',
                'categoryCollection.category:id,name',
                'categoryCollection.category.image:id,imageable_id,imageable_type,url',
            ])
            ->get();

        $posts = Post::whereStatus(IsActive::Yes)
            ->with([
                'image:id,imageable_id,imageable_type,url',
            ])
            ->limit(3)
            ->get();

        return $this->renderView(
            'livewire.site.index',
            $pageTitle,
            compact('collections','posts')
        );
    }
}
