<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class SinglePost extends SiteComponent
{
    public Post $post;

    public function render(): View
    {
        $pageTitle = $this->post->title;
        $categories = Category::withoutTrashed()
            ->isPostCategory()
            ->select([
                'id',
                'name',
            ])
            ->pluck('id', 'name')
            ->toArray();
        $lastPosts = Post::iSActive()->limit(4)->get();
        return $this->renderView(
            'livewire.site.single-post',
            $pageTitle,
            compact('categories','lastPosts')
        );
    }
}
