<?php

namespace App\Livewire\Admin\User;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ShowUser extends AdminComponent
{
    public User $user;

    public function render(): View
    {
        $pageTitle = ' اطلاعات کاربر ' . $this->user->name;
        $payments = Payment::whereUserId($this->user->id)->paginate($this->perPage);
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
        $orders = Order::whereUserId($this->user->id)->paginate($this->perPage);
        $orderTableHeads = [
            'شماره سفارش',
            'وضعیت',
            'مبلغ کل',
            'تخفیف',
            'مالیات',
            'هزینه ارسال',
            'مبلغ پرداخت شده',
            'تاریخ ایجاد',
            'عملیات'
        ];
        return $this->renderView(
            'livewire.admin.user.show-user',
            $pageTitle,
            compact('paymentTableHeads', 'payments', 'orderTableHeads', 'orders')
        );
    }

}
