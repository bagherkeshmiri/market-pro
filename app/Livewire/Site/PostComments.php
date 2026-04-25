<?php

namespace App\Livewire\Site;

use App\Enums\CommentStatus;
use App\Models\Post;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;

    public $postId;

    public function mount($postId): void
    {
        $this->postId = $postId;
    }

    public function render(): View
    {
        $post = Post::findOrFail($this->postId);
        $comments = $post->comments()->where('status', CommentStatus::Approved)->latest()->paginate(3);
        return view(
            'livewire.site.post-comments',
            compact('comments')
        );
    }
}
