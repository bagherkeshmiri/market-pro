<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;

class ListProduct extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $pageTitle = 'لیست‌ محصولات';
        $tableHeads = ['تصویر', 'نام', 'دسته محصول', 'قیمت ( تومان )', 'تعداد موجودی ', 'تاریخ ایجاد', 'عملیات'];
        return $this->renderView(
            'livewire.admin.product.list-product',
            [
                'pageTitle' => $pageTitle,
                'tableHeads' => $tableHeads,
                'products' => Product::with([
                    'images',
                ])->paginate(),
            ]
        );
    }
}
