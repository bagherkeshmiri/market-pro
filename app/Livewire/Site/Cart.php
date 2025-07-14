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

    public function mount(): void
    {
        $this->cart = Session::get('cart', []);
    }

    public function removeProductFromCart(Product $product): void
    {
        $this->removeFromCart($product->id);
    }

    public function updatedCart($value, $key): void
    {
        $parts = explode('.', $key);
        $productId = $parts[0];

        if ($parts[1] === 'qty') {
            $this->updateCartQty($productId, $value);
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
