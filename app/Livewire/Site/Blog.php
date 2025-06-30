<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;

class Blog extends SiteComponent
{
    public function render()
    {
        $pageTitle = 'وبلاگ';
        return $this->renderView(
            'livewire.site.blog',
            $pageTitle
        );
    }
}
