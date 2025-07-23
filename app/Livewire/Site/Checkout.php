<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;

class Checkout extends SiteComponent
{
    public $cart = [];
    public $cartTotal = 0;
    public $tax = 0;
    public $shipping = 20000;
    public $discount = 50000;
    public $freeShipping = 2000000;

    public function mount(): RedirectResponse|Redirector|null
    {
        $this->cart = Session::get('cart', []);
        if (empty($this->cart)) {
            $this->discount = 0;
            $this->shipping = 0;
            return redirect()->route('site.cart');
        }
        $this->calculateCartTotal();
        $this->calculateTax($this->cartTotal);
        return null;
    }

    public function calculateCartTotal(): void
    {
        $this->cartTotal = collect($this->cart)->sum('final_price');
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

    public function render(): View
    {
        $pageTitle = 'تسویه حساب';
        return $this->renderView(
            'livewire.site.checkout',
            $pageTitle
        );
    }
}
