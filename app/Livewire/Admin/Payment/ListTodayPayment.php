<?php

namespace App\Livewire\Admin\Payment;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Gate;
use App\Models\Payment;
use App\Services\Payment\GatewayFactory;
use Carbon\Carbon;
use Exception;
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


    /**
     * @throws Exception
     */
    public function inquiry(Payment $payment): void
    {
        $gateway = GatewayFactory::make(Gate::find($payment->gate_id));

        $inquiryResult = $gateway->inquiry($payment->authority);


//        if ($inquiryResult['status'] && $inquiryResult['paymentStatus'] == 'PAID') {
            $verifyResult = $gateway->verify([
                'Authority' => $payment->authority,
                'amount' => (int)$payment->amount,
            ]);

            dd(
                $verifyResult
            );
//        }
    }
}
