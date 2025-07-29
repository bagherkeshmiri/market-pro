<?php

namespace App\Livewire\Admin\Payment;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Payment;
use Illuminate\View\View;

class ListPayment extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست‌ پرداخت ها ';
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
            'livewire.admin.payment.list-payment',
            $pageTitle,
            compact('tableHeads', 'payments')
        );
    }
}
