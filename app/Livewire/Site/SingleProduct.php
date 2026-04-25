<?php

namespace App\Livewire\Site;

use App\Enums\CommentStatus;
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

    public Product $product;
    public $id;
    public array $cart = [];

    public function mount(): void
    {
        $this->id = $this->product->id;
        $this->cart = Session::get('cart', []);
    }

    public function addProductToCart(Product $product, bool $redirect = false): RedirectResponse|Redirector|null
    {
        $inCart = collect($this->cart)->contains('id', $product->id);

        if (!$inCart) {
            $this->addToCart($product->id);
        } elseif (!$redirect) {
            $this->js("window.dispatchEvent(new CustomEvent('product-already-in-cart', { detail: { name: '{$product->name}' } }))");
            return null;
        }

        if ($redirect) {
            return redirect()->route('site.cart');
        } else {
            $this->js("window.dispatchEvent(new CustomEvent('product-added-to-cart', { detail: { name: '{$product->name}' } }))");
        }

        return null;
    }

    public function render(): View
    {
        $product = $this->product;
        $comments = $this->product->comments()->where('status', CommentStatus::Approved)->get();

        return $this->renderView(
            'livewire.site.single-product',
            $this->product->name,
            [
                'sampleImageUrl' => $this->getSampleImageUrl(),
                'product' => $product,
                'comments' => $comments,
            ]
        );
    }
}
