<?php

namespace App\Livewire\Admin\Account;

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
        $userQuery = User::query();
        $mainAdminId = (clone $userQuery)->isAdmin()->first()->id;
        $users = (clone $userQuery)->paginate();

        return $this->renderView(
            'livewire.admin.user.list-user',
            [
                'users' => $users,
                'mainAdminId' => $mainAdminId,
                'isAdmin' => auth()->user()->type == UserType::Admin,
                'pageTitle' => $pageTile,
            ]
        );
    }
}
