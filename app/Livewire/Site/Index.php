<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Product;

class Index extends SiteComponent
{
    public function render()
    {
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $products = Product::limit(8)
            ->with('mainImage:id,product_id,image_url')
            ->get();

        return $this->renderView(
            'livewire.site.index',
            compact('products','sampleProductImageUrl')
        );
    }
}
