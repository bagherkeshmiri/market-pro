<?php

namespace App\Livewire\Admin\User;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\User;
use Illuminate\View\View;

class ListUser extends AdminComponent
{

    // TODO search components completed
    // TODO add search in users list

    public function render(): View
    {
        $tableHeads = ['نام', 'ایمیل', 'موبایل', 'تاریخ ایجاد', 'عملیات'];
        $users = User::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.user.list-user',
            'لیست کاربران',
            compact('tableHeads', 'users',)
        );
    }
}
