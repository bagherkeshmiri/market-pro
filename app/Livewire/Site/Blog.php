<?php

namespace App\Livewire\Site;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Post;
use Illuminate\View\View;

class Blog extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'وبلاگ';
        $posts = Post::whereStatus(IsActive::Yes)
            ->paginate($this->perPage);
        return $this->renderView(
            'livewire.site.blog',
            $pageTitle,
            compact('posts')
        );
    }
}
