<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Product;

class SingleProduct extends SiteComponent
{
    public object $product;
    public $id;

    public function mount(Product $product): void
    {
        $this->id = $product->id;
    }

    public function render()
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
            compact('sampleProductImageUrl', 'product', 'products','comments')
        );
    }
}
