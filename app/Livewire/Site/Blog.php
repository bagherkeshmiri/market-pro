<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Blog extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'وبلاگ';
        return $this->renderView(
            'livewire.site.blog',
            $pageTitle
        );
    }
}
