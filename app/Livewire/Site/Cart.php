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
    public $freeShipping = 2000000;
    public $remainingFreeShipping = 0;

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

    public function calculateCartTotal(): void
    {
        $this->cartTotal = collect($this->cart)->sum('final_price');
        $this->tax = round($this->cartTotal * 0.09);

        if ($this->getTotalPayableProperty() < $this->freeShipping) {
            $this->remainingFreeShipping = $this->freeShipping - $this->getTotalPayableProperty();
        }
    }

    public function getTotalPayableProperty(): int
    {
        return $this->cartTotal + $this->tax + $this->shipping - $this->discount;
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
