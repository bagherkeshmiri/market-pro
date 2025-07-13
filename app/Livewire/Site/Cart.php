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

    public function addProductToCart($productId): void
    {
        $this->addToCart($productId);
    }

    public function addToCart($productId): void
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty']++;
        } else {
            $cart[$this->product->id] = [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'image' => $this->product->mainImage ? $this->product->mainImage->url : $this->sampleProductImageUrl,
                'qty' => 1,
            ];
        }

        Session::put('cart', $cart);
        $this->cart = $cart;
    }


    public function removeFromCart($productId): void
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
        $this->cart = $cart;
    }

    public function render(): View
    {

        dd(
            $this->cart
        );


        $pageTitle = 'سبد خرید';
        return $this->renderView(
            'livewire.site.cart',
            $pageTitle
        );
    }
}
