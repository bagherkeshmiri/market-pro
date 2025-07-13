<?php

namespace App\Livewire\Site;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;

class ProductSliderItem extends Component
{
    public Product $product;
    public $cart = [];
    protected $sampleProductImageUrl = 'images/frest/sample-product.png';

    public function addToCart(): void
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$this->product->id])) {
            $cart[$this->product->id]['qty']++;
        } else {
            $cart[$this->product->id] = [
                'name' => $this->product->name,
                'image' => $this->product->mainImage ? $this->product->mainImage->url : $this->sampleProductImageUrl,
                'qty' => 1,
            ];
        }

        session()->put('cart', $cart);
    }

    public function render(): View
    {
        return view('livewire.site.product-slider-item');
    }
}
