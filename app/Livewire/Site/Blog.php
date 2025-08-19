<?php

namespace App\Livewire\Site;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Blog extends SiteComponent
{

    public int|string|null $category = null;

    public function mount(Request $request): void
    {
        $this->category = $request->input('category');
    }

    public function render(): View
    {
        $pageTitle = 'وبلاگ';
        $posts = Post::whereStatus(IsActive::Yes)
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->with([
                'image:id,imageable_id,imageable_type,url',
            ])
            ->paginate(6);

        return $this->renderView(
            'livewire.site.blog',
            $pageTitle,
            compact('posts')
        );
    }
}
