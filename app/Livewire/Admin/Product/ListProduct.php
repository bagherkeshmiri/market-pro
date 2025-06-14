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
        return $this->renderView(
            'livewire.admin.product.list-product',
            [
                'pageTitle' => $pageTitle,
                'tableHeads' => $tableHeads,
                'products' => Product::with([
                    'images',
                ])->paginate($this->perPage),
            ]
        );
    }
}
