<?php

namespace App\Livewire\Site;

use App\Enums\CommentStatus;
use App\Enums\IsActive;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;

class SinglePost extends SiteComponent
{
    public Post $post;

    public function mount(): RedirectResponse|Redirector|null
    {
        if ($this->post->status == IsActive::No) {
            return redirect()->route('site.blog');
        }
        return null;
    }

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
        $comments = $this->post->comments()->where('status', CommentStatus::Approved)->get();
        return $this->renderView(
            'livewire.site.single-post',
            $pageTitle,
            compact('categories', 'lastPosts', 'comments')
        );
    }
}
