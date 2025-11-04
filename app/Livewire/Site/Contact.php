<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Contact extends SiteComponent
{
    public function render(): View
    {
        return $this->renderView(
            'livewire.site.contact',
            'ارتباط با ما'
        );
    }
}
