<?php

namespace App\Livewire\Admin\Dashboard;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Admin;
use App\Models\Order;
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
//                Admin::count('id') + User::count('id'),   // TODO
                Admin::count('id'),
            ],
            'allProducts' => [
                'کل محصولات',
                'bg-rgba-primary text-primary',
                'bx-package',
                Product::count('id'),
            ],
            'allOrders' => [
                'کل سفارشات',
                'bg-rgba-warning text-warning',
                'bx-money',
                Order::count('id'),
            ],
            'allFactors' => [
                'کل فاکتور ها',
                'bg-rgba-info text-info',
                'bx-receipt',
                235,
            ],
            'todayOrders' => [
                'سفارشات امروز',
                'bg-rgba-danger text-danger',
                'bx-shopping-bag',
                Order::whereDate('created_at', Carbon::today())->count(),
            ],
            'todayFactors' => [
                'فاکتور های امروز',
                'bg-rgba-success text-success',
                'bx-receipt',
                500,
            ],
        ];
        return $this->renderView(
            'livewire.admin.dashboard.admin-dashboard',
            $pageTitle,
            compact('widgetsStatistics')
        );
    }
}
