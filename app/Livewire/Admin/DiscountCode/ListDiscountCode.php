<?php

namespace App\Livewire\Admin\DiscountCode;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\DiscountCode;
use Illuminate\View\View;

class ListDiscountCode extends AdminComponent
{
    public function render(): View
    {
        $tableHeads = [
            'کد',
            'نوع',
            'وضعیت',
            'مقدار',
            'حداکثر استفاده',
            ' دفعات استفاده',
            'حداقل سبد خرید',
            'تاریخ انقضا',
            'تاریخ ایجاد',
            'عملیات'
        ];
        $discountCodes = DiscountCode::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.discount-code.list-discount-code',
            'لیست دسته بندی ها',
            compact('tableHeads', 'discountCodes')
        );
    }
}
