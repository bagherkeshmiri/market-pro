<?php

namespace App\Livewire\Admin\Order;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Order;
use Illuminate\View\View;

class ListTodayOrder extends AdminComponent
{

    public function render(): View
    {
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
        $orders = Order::whereBetween('created_at', [
            today()->startOfDay()->toDateTimeString(),
            today()->endOfDay()->toDateTimeString()
        ])->paginate($this->perPage);

        return $this->renderView(
            'livewire.admin.order.list-today-order',
            'لیست ‌سفارشات امروز',
            compact('tableHeads', 'orders')
        );
    }
}
