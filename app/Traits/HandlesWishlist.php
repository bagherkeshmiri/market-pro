<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait HandlesWishlist
{
    protected function storeWishlist(array $wishlist): void
    {
        Session::put('wishlist', $wishlist);
        if (property_exists($this, 'wishlist')) {
            $this->wishlist = $wishlist;
        }
    }

    public function addToWishlist($productData): void
    {
        $wishlist = Session::get('wishlist', []);

        $productId = $productData['id'];

        if (!isset($wishlist[$productId])) {
            $wishlist[$productId] = [
                'id' => $productData['id'],
                'name' => $productData['name'],
                'image' => $productData['image'] ?? ($this->getSampleImageUrl() ?? null),
                'unit_price' => $productData['unit_price'],
                'status' => $productData['status'],
                'category' => $productData['category'],
            ];
        }

        $this->storeWishlist($wishlist);
    }

    public function removeFromWishlist($productId): void
    {
        $wishlist = Session::get('wishlist', []);

        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);

            $this->storeWishlist($wishlist);
        }
    }
}
