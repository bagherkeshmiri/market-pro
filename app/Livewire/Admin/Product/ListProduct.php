<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Product;

class ListProduct extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست‌ محصولات';
        $tableHeads = ['تصویر', 'نام', 'دسته محصول', 'وضعیت', 'قیمت ( تومان )', 'تعداد موجودی ', 'تاریخ ایجاد', 'عملیات'];
        $products = Product::with([
            'images',
        ])->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.product.list-product',
            compact('pageTitle', 'tableHeads', 'products')
        );
    }
}
