<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Category;
use App\Models\Product;
use App\Traits\HandlesCart;
use Illuminate\View\View;

class Products extends SiteComponent
{
    use HandlesCart;

    public object $category;
    public $id;

    public function mount(Category $category): void
    {
        $this->id = $category->id;
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
        $pageTitle = 'محصولات دسته ' . $this->category->name;
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $category = $this->category;
        $products = Product::whereCategoryId($this->category->id)
            ->paginate($this->perPage);
        return $this->renderView(
            'livewire.site.products',
            $pageTitle,
            compact('category', 'sampleProductImageUrl', 'products')
        );
    }
}
