<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class Cart extends SiteComponent
{
    public $cart = [];
    protected $listeners = ['addProductToCart'];


    public function mount(): void
    {
        $this->cart = Session::get('cart', []);
    }

    public function render(): View
    {
        $pageTitle = 'سبد خرید';
        return $this->renderView(
            'livewire.site.cart',
            $pageTitle
        );
    }
}
