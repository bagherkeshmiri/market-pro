<?php

namespace App\Livewire\Site;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;

    public $comments;

    public function mount($comments): void
    {
        $this->comments = $comments;
    }

    public function render(): View
    {
        return view(
            'livewire.site.post-comments',
            [
                'comments' => $this->comments,
            ]
        );
    }
}
