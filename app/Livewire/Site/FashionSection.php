<?php

namespace App\Livewire\Site;

use App\Models\Product;
use App\Traits\HandlesCart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;

class FashionSection extends Component
{
    use HandlesCart;

    public string $title;
    public $items;
    public string $sampleProductImageUrl;
    public array $cart = [];

    public function mount(string $title, Collection|array $items, string $sampleProductImageUrl): void
    {
        $this->title = $title;
        $this->items = $items;
        $this->sampleProductImageUrl = $sampleProductImageUrl;
        $this->cart = Session::get('cart', []);
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

    public function render(): View
    {
        return view('livewire.site.fashion-section');
    }
}
