<?php

namespace App\Livewire\Admin\Collection;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Collection;
use Illuminate\View\View;

class ListCollection extends AdminComponent
{
    protected $listeners = ['updateOrder'];


    public function updateOrder(array $orderedIds): void
    {
        foreach ($orderedIds as $index => $id) {
            Collection::where('id', $id)
                ->update(['sort' => ++$index]);
        }

        session()->flash('success', 'ترتیب کالکشن ها با موفقیت ذخیره شد.');
    }

    public function render(): View
    {
        $pageTitle = 'لیست  کالکشن ها';
        $tableHeads = ['نام', 'نوع', 'وضعیت', 'تعداد آیتم ها', 'تاریخ ایجاد', 'عملیات'];
        $collections = Collection::orderBy('sort')
            ->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.collection.list-collection',
            $pageTitle,
            compact('tableHeads', 'collections')
        );
    }
}
