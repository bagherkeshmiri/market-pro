<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Product;
use App\Traits\HandlesCart;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class Cart extends SiteComponent
{
    use HandlesCart;

    public $cart = [];
    public $cartTotal = 0;
    public $tax = 0;
    public $shipping = 20000;
    public $discount = 150000;

    public function mount(): void
    {
        $this->cart = Session::get('cart', []);
        $this->calculateCartTotal();
    }

    public function removeProductFromCart(Product $product): void
    {
        $this->removeFromCart($product->id);
    }

    public function updatedCart($value, $key): void
    {
        $parts = explode('.', $key);
        $productId = $parts[0];
        $property = $parts[1];

        if ($property === 'qty') {
            $this->updateCartQty($productId, $value);
            $this->cart = Session::get('cart', []);
        }
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
