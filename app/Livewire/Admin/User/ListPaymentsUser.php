<?php

namespace App\Livewire\Admin\User;

use App\Models\Payment;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListPaymentsUser extends Component
{
    use WithPagination;

    public User $user;

    public function render(): View
    {
        $payments = Payment::where('user_id',$this->user->id)->paginate(10);
        $paymentTableHeads = [
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
        return view(
            'livewire.admin.user.list-payments-user',
            compact('paymentTableHeads', 'payments')
        );
    }
}
