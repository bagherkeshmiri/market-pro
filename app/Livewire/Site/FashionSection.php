<?php

namespace App\Livewire\Site;

use App\Models\Product;
use App\Traits\HandlesCart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class FashionSection extends Component
{
    use HandlesCart;

    public string $title;
    public $items;
    public string $sampleProductImageUrl;

    public function mount(string $title, Collection|array $items, string $sampleProductImageUrl): void
    {
        $this->title = $title;
        $this->items = $items;
        $this->sampleProductImageUrl = $sampleProductImageUrl;
    }

    public function addProductToCart(Product $product): void
    {
        $this->addToCart([
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->mainImage->url,
            'unit_price' => $product->final_price,
            'qty' => 1,
        ]);
    }

    public function render(): View
    {
        return view('livewire.site.fashion-section');
    }
}
