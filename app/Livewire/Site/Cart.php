<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Cart extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'سبد خرید';
        return $this->renderView(
            'livewire.site.cart',
            $pageTitle
        );
    }
}
