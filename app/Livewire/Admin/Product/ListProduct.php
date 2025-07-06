<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Product;

class ListProduct extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست‌ محصولات';
        $tableHeads = ['تصویر', 'نام', 'دسته', 'وضعیت', 'نوع تخفیف', 'قیمت اولیه', 'تخفیف ','قیمت نهایی ', ' موجودی ', 'عملیات'];
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $products = Product::with([
            'mainImage',
        ])->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.product.list-product',
            compact('pageTitle', 'tableHeads', 'products', 'sampleProductImageUrl')
        );
    }
}
