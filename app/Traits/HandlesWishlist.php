<?php

namespace App\Traits;

use App\Models\Product;
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

    public function addToWishlist(int $productId): void
    {
        $wishlist = Session::get('wishlist', []);

        $product = Product::find($productId);

        if (!is_null($product)) {
            if (!isset($wishlist[$productId])) {
                $wishlist[$productId] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->mainImage?->url ?? ($this->getSampleImageUrl() ?? null),
                    'unit_price' => $product->price,
                    'status' => $product->status,
                    'category' => $product->category?->name ?? '',
                ];

                $this->storeWishlist($wishlist);
            }
        }
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
