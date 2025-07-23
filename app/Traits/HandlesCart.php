<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait HandlesCart
{
    protected function storeCart(array $cart): void
    {
        Session::put('cart', $cart);
        if (property_exists($this, 'cart')) {
            $this->cart = $cart;
        }
    }

    public function addToCart($productData): void
    {
        $cart = Session::get('cart', []);

        $productId = $productData['id'];

        if (!isset($cart[$productId])) {
            $cart[$productId] = [
                'id' => $productData['id'],
                'name' => $productData['name'],
                'image' => $productData['image'] ?? ($this->getSampleImageUrl() ?? null),
                'unit_price' => $productData['unit_price'],
                'final_price' => $productData['qty'] * $productData['unit_price'],
                'qty' => $productData['qty'],
            ];
        }

        $this->storeCart($cart);

        $this->recalculateCartSummary();
    }

    public function removeFromCart($productId): void
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);

            $this->storeCart($cart);
        }

        $this->recalculateCartSummary();
    }

    public function updateCartQty($productId, $newQty): void
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] = $newQty;
            $cart[$productId]['final_price'] = $cart[$productId]['unit_price'] * $newQty;

            $this->storeCart($cart);
        }

        $this->recalculateCartSummary();

    }

    protected function recalculateCartSummary(): void
    {
        $cart = Session::get('cart', []);

        $count = 0;
        $total = 0;

        foreach ($cart as $item) {
            $count += $item['qty'];
            $total += $item['final_price'];
        }

        Session::put('cart_summary', [
            'count' => $count,
            'total' => $total,
        ]);

        if (property_exists($this, 'cartCount')) {
            $this->cartCount = $count;
        }
        if (property_exists($this, 'cartTotal')) {
            $this->cartTotal = $total;
        }
    }

}
