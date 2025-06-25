<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Category;
use App\Models\Product;

class Index extends SiteComponent
{
    public function render()
    {
        $pageTitle = 'مرجع خرید انواع پیکسل خمیری';
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $products = Product::limit(8)
            ->with('mainImage:id,product_id,image_url')
            ->get();



        return $this->renderView(
            'livewire.site.index',
            $pageTitle,
            compact('products', 'sampleProductImageUrl')
        );
    }
}
