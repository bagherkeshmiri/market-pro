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
        $tableHeads = ['نام', 'دسته محصول','توضیحات', 'قیمت ( تومان )','موجودی','تاریخ ایجاد', 'عملیات'];
        return $this->renderView(
            'livewire.admin.product.list-product',
            [
                'pageTitle' => $pageTitle,
                'tableHeads' => $tableHeads,
                'categories' => Product::paginate(),
            ]
        );
    }
}
