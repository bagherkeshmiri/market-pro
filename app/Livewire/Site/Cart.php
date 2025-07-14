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
    public $discount = 50000;
    public $freeShipping = 2000000;
    public $remainingFreeShipping = 0;
    public float $usedFreeShippingLineProgress = 0;

    public function mount(): void
    {
        $this->cart = Session::get('cart', []);
        $this->calculateCartTotal();
        $this->calculateTax($this->cartTotal);
        $this->calculateUsedFreeShippingProgressLine();

    }

    public function removeProductFromCart(Product $product): void
    {
        $this->removeFromCart($product->id);
        $this->calculateCartTotal();
        $this->calculateTax($this->cartTotal);
        $this->calculateUsedFreeShippingProgressLine();
    }

    public function updatedCart($value, $key): void
    {
        $parts = explode('.', $key);
        $productId = $parts[0];
        $property = $parts[1];

        if ($property === 'qty') {
            $this->updateCartQty($productId, $value);
            $this->cart = Session::get('cart', []);
            $this->calculateCartTotal();
            $this->calculateTax($this->cartTotal);
            $this->calculateUsedFreeShippingProgressLine();
        }
    }

    public function calculateCartTotal(): void
    {
        $this->cartTotal = collect($this->cart)->sum('final_price');

        if ($this->getTotalPayableProperty() < $this->freeShipping) {
            $this->remainingFreeShipping = $this->freeShipping - $this->cartTotal;
        }
    }

    protected function calculateTax(int $amount): int
    {
        $this->tax = round($amount * 0.09);
        return $this->tax;
    }

    public function getTotalPayableProperty(): int
    {
        return $this->cartTotal + $this->tax + $this->shipping - $this->discount;
    }

    protected function calculateUsedFreeShippingProgressLine(): void
    {
        $total = collect($this->cart)->sum(function ($item) {
            return $item['qty'] * $item['unit_price'];
        });

        $this->usedFreeShippingLineProgress = min(100, ($total / $this->freeShipping) * 100);

        $this->remainingFreeShipping = max(0, $this->freeShipping - $total);
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
