<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use Illuminate\View\View;

class ListCategory extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست دسته بندی ها';
        $tableHeads = ['تصویر', 'نام', 'دسته پدر', 'نوع', 'تاریخ ایجاد', 'عملیات'];
        $categories = Category::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.category.list-category',
            $pageTitle,
            compact('tableHeads', 'sampleImageUrl', 'categories')
        );
    }
}
