<?php

namespace App\Livewire\Site;

use App\Models\Comment;
use Illuminate\View\View;
use Livewire\Component;

class CommentItem extends Component
{
    public $comment;
    public $expanded = false;

    public function mount(Comment $comment): void
    {
        $this->comment = $comment;
    }

    public function toggle(): void
    {
        $this->expanded = !$this->expanded;
    }


    public function render(): View
    {
        return view('livewire.site.comment-item');
    }
}
