<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait HandlesCart
{
    public function addToCart($productData): void
    {
        $cart = Session::get('cart', []);

        $productId = $productData['id'];

        if (!isset($cart[$productId])) {
            $cart[$productId] = [
                'id' => $productData['id'],
                'name' => $productData['name'],
                'image' => $productData['image'] ?? ($this->sampleProductImageUrl ?? null),
                'unit_price' => $productData['unit_price'],
                'final_price' => $productData['qty'] * $productData['unit_price'],
                'qty' => $productData['qty'],
            ];
        }

        Session::put('cart', $cart);

        if (property_exists($this, 'cart')) {
            $this->cart = $cart;
        }
    }

    public function removeFromCart($productId): void
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);

            if (property_exists($this, 'cart')) {
                $this->cart = $cart;
            }
        }
    }

    public function updateCartQty($productId, $newQty): void
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] = $newQty;
            $cart[$productId]['final_price'] = $cart[$productId]['unit_price'] * $newQty;

            Session::put('cart', $cart);

            if (property_exists($this, 'cart')) {
                $this->cart = $cart;
            }
        }
    }

}
