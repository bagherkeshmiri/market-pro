<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Product;

class ListProduct extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست‌ محصولات';
        $tableHeads = ['تصویر', 'نام', 'دسته محصول', 'وضعیت', 'نوع تخفیف', 'تخفیف', 'قیمت ( تومان )', 'تعداد موجودی ', 'تاریخ ایجاد', 'عملیات'];
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $products = Product::with([
            'mainImage:id,product_id,image_url',
        ])->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.product.list-product',
            compact('pageTitle', 'tableHeads', 'products', 'sampleProductImageUrl')
        );
    }
}
