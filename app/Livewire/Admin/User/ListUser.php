<?php

namespace App\Livewire\Admin\User;

use App\Enums\UserType;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\User;

class ListUser extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست کاربران';
        $tableHeads = ['نام', 'ایمیل', 'نقش', 'نوع کاربر', 'دسترسی ها', 'تاریخ ایجاد', 'عملیات'];
        $userQuery = User::query();
        $mainAdminId = (clone $userQuery)->isAdmin()->first()->id;
        $users = (clone $userQuery)->paginate($this->perPage);
        $isAdmin = auth()->user()->type == UserType::Admin;
        return $this->renderView(
            'livewire.admin.user.list-user',
            $pageTitle,
            compact('tableHeads', 'users', 'mainAdminId', 'isAdmin')
        );
    }
}
