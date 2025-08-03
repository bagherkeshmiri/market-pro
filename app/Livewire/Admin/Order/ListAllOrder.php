<?php

namespace App\Livewire\Admin\Order;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Order;
use Illuminate\View\View;

class ListAllOrder extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست سفارش ها';
        $tableHeads = [
            'کاربر',
            'شماره سفارش',
            'وضعیت',
            'مبلغ کل',
            'تخفیف',
            'مالیات',
            'هزینه ارسال',
            'مبلغ پرداختی ',
            'تاریخ ایجاد',
            'عملیات',
        ];
        $orders = Order::paginate($this->perPage);

        return $this->renderView(
            'livewire.admin.order.list-all-order',
            $pageTitle,
            compact('tableHeads', 'orders')
        );
    }
}
