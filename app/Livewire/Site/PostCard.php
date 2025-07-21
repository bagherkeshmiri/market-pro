<?php

namespace App\Livewire\Site;

use App\Models\Post;
use Illuminate\View\View;
use Livewire\Component;

class PostCard extends Component
{
    public Post $post;
    public $image;
    public $commentsCount;
    public $categoryName;
    public $slug;
    public $title;
    public $excerpt;

    public function getImageUrl(): string
    {
        return $this->post->image
            ? $this->post->image->url
            : config('defaults.sample-image');
    }

    public function mount(): void
    {
        $this->image = $this->getImageUrl();
        $this->commentsCount = $this->post->comments?->count() ?? 0;
        $this->categoryName = $this->post->category?->name ?? '';
        $this->slug = $this->post->slug;
        $this->title = $this->post->title;
        $this->excerpt = $this->post->excerpt;
    }

    public function render(): View
    {
        return view('livewire.site.post-card');
    }
}
