<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;

class ListCategory extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست دسته بندی ها';
        $tableHeads = ['تصویر','نام', 'دسته پدر', 'تاریخ ایجاد', 'عملیات'];
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $categories = Category::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.category.list-category',
            compact('pageTitle', 'tableHeads','sampleProductImageUrl', 'categories')
        );
    }
}
