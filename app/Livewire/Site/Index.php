<?php

namespace App\Livewire\Site;

use App\Enums\IsActive;
use App\Helpers\SeoHelper;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Collection;
use App\Models\Post;
use App\Models\SystemSetting;
use Cache;
use Illuminate\View\View;

class Index extends SiteComponent
{
    public function render(): View
    {
        $collections = Collection::where('is_active', IsActive::Yes)
            ->orderBy('sort')
            ->with([
                'productCollection',
                'categoryCollection:id,collection_id,category_id',
                'categoryCollection.category:id,name',
                'categoryCollection.category.image:id,imageable_id,imageable_type,url',
            ])
            ->get();

        $posts = Post::where('status', IsActive::Yes)
            ->with([
                'image:id,imageable_id,imageable_type,url',
            ])
            ->limit(3)
            ->get();

        SeoHelper::forHome();

        $siteTitle = Cache::get(SystemSetting::CACHE_PREFIX . 'site_title') ?? 'فروشگاه من';

        return $this->renderView(
            'livewire.site.index',
            $siteTitle,
            compact('collections', 'posts')
        );
    }
}
