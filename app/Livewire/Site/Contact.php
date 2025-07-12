<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Contact extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'ارتباط با ما';
        return $this->renderView(
            'livewire.site.contact',
            $pageTitle
        );
    }
}
