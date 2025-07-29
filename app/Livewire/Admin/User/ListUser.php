<?php

namespace App\Livewire\Admin\User;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\User;
use Illuminate\View\View;

class ListUser extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست کاربران';
        $tableHeads = ['نام', 'ایمیل', 'موبایل', 'تاریخ ایجاد', 'عملیات'];
        $users = User::paginate(2);
//        $users = User::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.user.list-user',
            $pageTitle,
            compact('tableHeads', 'users',)
        );
    }
}
