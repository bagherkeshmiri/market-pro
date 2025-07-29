<?php

namespace App\Livewire\Admin\Dashboard;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class AdminDashboard extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'داشبورد';
        $widgetsStatistics = [
            'allUsers' => [
                'کل کاربران',
                'bg-rgba-success text-success',
                'bxs-group',
                Admin::count('id') + User::count('id'),
                route('admin.user.index')
            ],
            'allProducts' => [
                'کل محصولات',
                'bg-rgba-primary text-primary',
                'bx-package',
                Product::count('id'),
                route('admin.product.index')
            ],
            'allOrders' => [
                'کل سفارشات',
                'bg-rgba-warning text-warning',
                'bx-money',
                Order::count('id'),
                route('admin.order.index-all')
            ],
            'allFactors' => [
                'کل پرداخت ها',
                'bg-rgba-info text-info',
                'bxs-credit-card',
                Payment::count('id'),
                route('admin.payment.index')
            ],
            'todayOrders' => [
                'سفارشات امروز',
                'bg-rgba-danger text-danger',
                'bx-shopping-bag',
                Order::whereDate('created_at', Carbon::today())->count(),
                route('admin.order.index-today')
            ],
            'todayFactors' => [
                'پرداخت های امروز',
                'bg-rgba-success text-success',
                'bxs-credit-card',
                Payment::whereDate('created_at', Carbon::today())->count(),
            ],
        ];

        return $this->renderView(
            'livewire.admin.dashboard.admin-dashboard',
            $pageTitle,
            compact('widgetsStatistics')
        );
    }
}
