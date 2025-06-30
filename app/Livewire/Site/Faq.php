<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;

class Faq extends SiteComponent
{
    public function render()
    {
        $pageTitle = 'سوالات متداول';
        return $this->renderView(
            'livewire.site.faq',
            $pageTitle
        );
    }
}
