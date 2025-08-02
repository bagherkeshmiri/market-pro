<?php

namespace App\Livewire\Admin\Order;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\View\View;

class ListTodayOrder extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست ‌سفارشات امروز';
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
        ];
        $orders = Order::whereDate('created_at', Carbon::today())->paginate($this->perPage);

        return $this->renderView(
            'livewire.admin.order.list-today-order',
            $pageTitle,
            compact('tableHeads', 'orders')
        );
    }
}
