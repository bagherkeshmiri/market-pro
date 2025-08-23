<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Product;
use App\Traits\DiscountValidator;
use App\Traits\HandlesCart;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class Cart extends SiteComponent
{
    use HandlesCart;
    use DiscountValidator;

    public $cart = [];
    public $cartTotal = 0;
    public $tax = 0;
    public $shipping = 20000;
    public $discount = 0;
    public $freeShipping = 2000000;
    public $remainingFreeShipping = 0;
    public float $usedFreeShippingLineProgress = 0;
    public $discountCode;

    public function mount(): void
    {
        $this->cart = Session::get('cart', []);
        if (empty($this->cart)) {
            $this->discount = 0;
            $this->shipping = 0;
        }
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

        if (empty($this->cart)) {
            $this->discount = 0;
            $this->shipping = 0;
        }
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

        if (empty($this->cart)) {
            $this->discount = 0;
            $this->shipping = 0;
        }
    }

    public function calculateCartTotal(): void
    {
        $this->cartTotal = collect($this->cart)->sum('final_price');

        if ($this->getTotalPayableProperty() < $this->freeShipping) {
            $this->remainingFreeShipping = $this->freeShipping - $this->cartTotal;
        }

        $this->storeCartSummaryToSession();
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

    protected function storeCartSummaryToSession(): void
    {
        $count = collect($this->cart)->sum('qty');
        $total = collect($this->cart)->sum('final_price');

        Session::put('cart_summary.count', $count);
        Session::put('cart_summary.total', $total);
    }

    public function checkDiscountCode(): void
    {
        $result = $this->checkCode($this->discountCode, $this->cartTotal);

        if ($result['status']) {
            session()->flash('success', 'کد تخفیف با موفقیت در سبد خرید اعمال شد');
            $this->discount = $result['amount'];

            Session::put('cart_discount_details', [
                'discount' => $result['discount'],
                'discount_amount' => $result['amount'],
            ]);
        } else {
            session()->flash('warning', $result['error']);
        }
    }

    public function render(): View
    {
        return $this->renderView(
            'livewire.site.cart',
            'سبد خرید'
        );
    }
}
