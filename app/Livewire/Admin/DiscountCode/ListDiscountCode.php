<?php

namespace App\Livewire\Admin\DiscountCode;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\DiscountCode;
use Illuminate\View\View;

class ListDiscountCode extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست دسته بندی ها';
        $tableHeads = [
            'کد',
            'نوع',
            'مقدار',
            'حداکثر استفاده',
            ' دفعات استفاده',
            'حداقل سبد خرید',
            'تاریه انقضا',
            'تاریخ ایجاد',
            'عملیات'
        ];
        $discountCodes = DiscountCode::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.discount-code.list-discount-code',
            $pageTitle
        );
    }
}
