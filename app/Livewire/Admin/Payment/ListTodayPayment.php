<?php

namespace App\Livewire\Admin\Payment;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\View\View;

class ListTodayPayment extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست‌ پرداخت های امروز  ';
        $tableHeads = [
            'کاربر',
            'شماره سفارش',
            'درگاه',
            'شماره پرداخت',
            'وضعیت',
            'مبلغ',
            'شناسه پیگیری',
            'تاریخ پرداخت',
            'تاریخ ایجاد',
            'عملیات'
        ];
        $payments = Payment::whereDate('created_at', Carbon::today())->paginate($this->perPage);

        return $this->renderView(
            'livewire.admin.payment.list-today-payment',
            $pageTitle,
            compact('tableHeads', 'payments')

        );
    }
}
