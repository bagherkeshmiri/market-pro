<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;

class Contact extends SiteComponent
{
    public function render()
    {
        $pageTitle = 'ارتباط با ما';
        return $this->renderView(
            'livewire.site.contact',
            $pageTitle
        );
    }
}
