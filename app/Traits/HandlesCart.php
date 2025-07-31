<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

trait HandlesCart
{
    use SampleImages;

    protected function storeCart(array $cart): void
    {
        Session::put('cart', $cart);
        if (property_exists($this, 'cart')) {
            $this->cart = $cart;
        }
    }

    public function addToCart(int $productId, int $qty = 1): void
    {
        $cart = Session::get('cart', []);

        $product = Product::find($productId);

        if (!is_null($product)) {

            $qty = max(1, min($qty, $product->stock));

            if (!isset($cart[$productId])) {

                $cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->mainImage?->url ?? ($this->getSampleImageUrl() ?? null),
                    'unit_price' => $product->price,
                    'final_price' => $qty * $product->price,
                    'qty' => $qty,
                ];

                $this->storeCart($cart);

                $this->recalculateCartSummary();
            }
        }
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
