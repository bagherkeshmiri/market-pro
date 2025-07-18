<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class SinglePost extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'پست تست';
        return $this->renderView(
            'livewire.site.single-post',
            $pageTitle
        );
    }
}
