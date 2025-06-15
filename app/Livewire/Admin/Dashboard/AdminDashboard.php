<?php

namespace App\Livewire\Admin\Dashboard;

use App\Livewire\BaseComponents\AdminComponent;

class AdminDashboard extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'داشبورد';
        $widgetsStatistics = [
            'allUsers' => [
                'کل کاربران',
                'bg-rgba-success text-success',
                'bxs-group',
                20,
            ],
            'allProducts' => [
                'کل محصولات',
                'bg-rgba-warning text-warning',
                'bx-package',
                200,
            ],
            'allOrders' => [
                'کل سفارشات',
                'bg-rgba-primary text-primary',
                'bx-money',
                450,
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
                4,
            ],
        ];
        return $this->renderView('livewire.admin.dashboard.admin-dashboard', [
            'pageTitle' => $pageTitle,
            'widgetsStatistics' => $widgetsStatistics,

        ]);
    }
}
