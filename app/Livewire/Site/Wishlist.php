<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Product;
use App\Traits\HandlesCart;
use App\Traits\HandlesWishlist;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class Wishlist extends SiteComponent
{
    use HandlesWishlist;
    use HandlesCart;

    public array $wishlist = [];
    public array $cart = [];

    public function mount(): void
    {
        $this->wishlist = Session::get('wishlist', []);
        $this->cart = Session::get('cart', []);
    }

    public function removeProductFromWishlist(Product $product): void
    {
        $this->removeFromWishlist($product->id);
    }

    public function addProductToCart(Product $product): void
    {
        $exists = collect($this->cart)->contains('id', $product->id);

        if ($exists) {
            $this->js("window.dispatchEvent(new CustomEvent('product-already-in-cart', { detail: { name: '{$product->name}' } }))");
            return;
        }

        $this->addToCart($product->id);


        $this->js("window.dispatchEvent(new CustomEvent('product-added-to-cart', { detail: { name: '{$product->name}' } }))");
    }

    public function render(): View
    {
        return $this->renderView(
            'livewire.site.wishlist',
            'لیست علاقه مندی ها'
        );
    }
}
