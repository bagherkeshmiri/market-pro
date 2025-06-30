<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;

class Register extends SiteComponent
{
    public function render()
    {
        $pageTitle = 'عضویت';
        return $this->renderView(
            'livewire.site.register',
            $pageTitle
        );
    }
}
