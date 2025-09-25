<?php

namespace App\Livewire\Admin\Payment;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Payment;
use Illuminate\View\View;

class ListAllPayment extends AdminComponent
{
    public function render(): View
    {
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
        $payments = Payment::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.payment.list-all-payment',
            'لیست‌ پرداخت ها ',
            compact('tableHeads', 'payments')
        );
    }
}
