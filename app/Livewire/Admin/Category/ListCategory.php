<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use Livewire\WithPagination;

class ListCategory extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $pageTitle = 'لیست دسته بندی ها';
        $tableHeads = ['نام', 'دسته پدر', 'تاریخ ایجاد', 'عملیات'];
        return $this->renderView(
            'livewire.admin.category.list-category',
            [
                'pageTitle' => $pageTitle,
                'tableHeads' => $tableHeads,
                'categories' => Category::paginate(),
            ]
        );
    }
}
