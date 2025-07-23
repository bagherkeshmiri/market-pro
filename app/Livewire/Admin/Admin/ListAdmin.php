<?php

namespace App\Livewire\Admin\Admin;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Admin;
use Illuminate\View\View;

class ListAdmin extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست کاربران';
        $tableHeads = ['نام', 'ایمیل', 'نقش', 'دسترسی ها', 'تاریخ ایجاد', 'عملیات'];
        $adminQuery = Admin::query();
        $mainAdminId = (clone $adminQuery)->first()->id;
        $admins = (clone $adminQuery)->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.admin.list-admin',
            $pageTitle,
            compact('tableHeads', 'admins', 'mainAdminId')
        );
    }
}
