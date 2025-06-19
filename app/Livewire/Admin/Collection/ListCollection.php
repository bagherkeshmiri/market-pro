<?php

namespace App\Livewire\Admin\Collection;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Collection;

class ListCollection extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست  کالکشن ها';
        $tableHeads = ['نام', 'نوع', 'وضعیت', 'تعداد', ' مرتب سازی','تاریخ ایجاد', 'عملیات'];
        $collections = Collection::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.collection.list-collection',
            compact('pageTitle', 'tableHeads', 'collections')
        );
    }
}
