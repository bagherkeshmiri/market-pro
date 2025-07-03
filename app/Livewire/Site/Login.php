<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;

class Login extends SiteComponent
{
    public function render()
    {
        $pageTitle = 'ورود';
        return $this->renderView(
            'livewire.site.login',
            $pageTitle
        );
    }
}
