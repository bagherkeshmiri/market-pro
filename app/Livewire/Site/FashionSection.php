<?php

namespace App\Livewire\Site;

use App\Models\Product;
use App\Traits\HandlesCart;
use App\Traits\HandlesWishlist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;

class FashionSection extends Component
{
    use HandlesCart;
    use HandlesWishlist;

    public string $title;
    public $items;
    public array $cart = [];
    public array $wishlist = [];

    public function mount(string $title, Collection|array $items): void
    {
        $this->title = $title;
        $this->items = $items;
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

        $this->addToCart([
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->mainImage->url,
            'unit_price' => $product->final_price,
            'qty' => 1,
        ]);

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
        return view('livewire.site.fashion-section');
    }
}
