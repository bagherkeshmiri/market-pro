<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Category;
use App\Models\Product;
use App\Traits\HandlesCart;
use App\Traits\HandlesWishlist;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class Products extends SiteComponent
{
    use HandlesCart;
    use HandlesWishlist;

    public Category $category;
    public $id;
    public array $cart = [];
    public array $wishlist = [];

    public function mount(): void
    {
        $this->id = $this->category->id;
        $this->cart = Session::get('cart', []);
        $this->wishlist = Session::get('wishlist', []);
    }

    public function addProductToCart(Product $product): void
    {
        $exists = collect($this->cart)->contains('id', $product->id);

        if ($exists) {
            $this->js("window.dispatchEvent(new CustomEvent('product-already-in-cart', { detail: { name: '{$product->name}' } }))");
            return;
        }

        $this->addToCart($product->id);

        $this->js("window.dispatchEvent(new CustomEvent('product-added-to-cart', { detail: { name: '{$product->name}' } }))");
    }

    public function addProductToWishlist(Product $product): void
    {
        $exists = collect($this->wishlist)->contains('id', $product->id);

        if ($exists) {
            $this->js("window.dispatchEvent(new CustomEvent('product-already-in-wishlist', { detail: { name: '{$product->name}' } }))");
            return;
        }

        $this->addToWishlist([
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->mainImage->url,
            'unit_price' => $product->final_price,
            'status' => $product->status,
            'category' => $product->category->name,
        ]);

        $this->js("window.dispatchEvent(new CustomEvent('product-added-to-wishlist', { detail: { name: '{$product->name}' } }))");
    }

    public function render(): View
    {
        $pageTitle = 'محصولات دسته ' . $this->category->name;
        $category = $this->category;
        $products = Product::whereCategoryId($this->category->id)
//            ->paginate($this->perPage);
            ->paginate(2);
        return $this->renderView(
            'livewire.site.products',
            $pageTitle,
            compact('category', 'products')
        );
    }
}
