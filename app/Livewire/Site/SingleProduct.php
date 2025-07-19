<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Product;
use App\Traits\HandlesCart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;

class SingleProduct extends SiteComponent
{
    use HandlesCart;

    public object $product;
    public $id;
    public array $cart = [];

    public function mount(Product $product): void
    {
        $this->id = $product->id;
        $this->cart = Session::get('cart', []);
    }

    public function addProductToCart(Product $product, bool $redirect = false): RedirectResponse|Redirector|null
    {
        $inCart = collect($this->cart)->contains('id', $product->id);

        if (!$inCart) {
            $this->addToCart([
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->mainImage->url,
                'unit_price' => $product->final_price,
                'qty' => 1,
            ]);
        } elseif (!$redirect) {
            $this->js("window.dispatchEvent(new CustomEvent('product-already-in-cart', { detail: { name: '{$product->name}' } }))");
            return null;
        }

        if ($redirect) {
            return redirect()->route('site.cart');
        } else {
            $this->js("window.dispatchEvent(new CustomEvent('product-added-to-cart', { detail: { name: '{$product->name}' } }))");
        }
    }

    public function render(): View
    {
        $pageTitle = $this->product->name;
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $product = $this->product;
        $products = Product::limit(8)
            ->with([
                'mainImage:id,url',
                'galleryImages:id,url',
            ])
            ->where('category_id', $product->category_id)
            ->get();

        $comments = $this->product->comments;
        return $this->renderView(
            'livewire.site.single-product',
            $pageTitle,
            compact('sampleProductImageUrl', 'product', 'products', 'comments')
        );
    }
}
