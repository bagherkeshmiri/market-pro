<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Category;
use App\Models\Product;

class Products extends SiteComponent
{
    public object $category;
    public $id;

    public function mount(Category $category): void
    {
        $this->id = $category->id;
    }

    public function render()
    {
        $pageTitle = 'محصولات دسته ' . $this->category->name;
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $category = $this->category;
        $products = Product::whereCategoryId($this->category->id)->get();
        return $this->renderView(
            'livewire.site.products',
            $pageTitle,
            compact('category', 'sampleProductImageUrl', 'products')
        );
    }
}
