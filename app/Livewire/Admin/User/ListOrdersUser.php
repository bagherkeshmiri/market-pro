<?php

namespace App\Livewire\Admin\User;

use App\Models\Order;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListOrdersUser extends Component
{
    use WithPagination;

    public User $user;

    public function render(): View
    {
        $orders = Order::whereUserId($this->user->id)->paginate(10);
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
        return view('livewire.admin.user.list-orders-user',
        compact('orderTableHeads','orders'));
    }
}
