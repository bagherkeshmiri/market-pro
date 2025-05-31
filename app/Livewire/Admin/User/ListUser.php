<?php

namespace App\Livewire\Admin\User;

use App\Enums\UserType;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\User;
use Livewire\WithPagination;

class ListUser extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $pageTile = 'لیست کاربران';
        $tableHeads = ['نام', 'ایمیل', 'نقش', 'نوع کاربر', 'دسترسی ها', 'تاریخ ایجاد', 'عملیات'];
        $userQuery = User::query();
        $mainAdminId = (clone $userQuery)->isAdmin()->first()->id;
        $users = (clone $userQuery)->paginate();

        return $this->renderView(
            'livewire.admin.user.list-user',
            [
                'pageTitle' => $pageTile,
                'tableHeads' => $tableHeads,
                'users' => $users,
                'mainAdminId' => $mainAdminId,
                'isAdmin' => auth()->user()->type == UserType::Admin,
            ]
        );
    }
}
