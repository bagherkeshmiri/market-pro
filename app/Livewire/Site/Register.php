<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Register extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'عضویت';
        return $this->renderView(
            'livewire.site.register',
            $pageTitle
        );
    }
}
