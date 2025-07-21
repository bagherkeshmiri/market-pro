<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Product;
use Illuminate\View\View;

class ListProduct extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست‌ محصولات';
        $tableHeads = ['تصویر', 'نام', 'دسته', 'وضعیت', 'نوع تخفیف', 'قیمت اولیه', 'تخفیف ','قیمت نهایی ', ' موجودی ', 'عملیات'];
        $products = Product::with([
            'mainImage',
        ])->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.product.list-product',
            $pageTitle,
            compact('tableHeads', 'products')
        );
    }
}
