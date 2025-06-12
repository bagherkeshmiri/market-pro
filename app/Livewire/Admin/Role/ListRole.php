<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Role;
use Livewire\WithPagination;

class ListRole extends AdminComponent
{

    public function render()
    {
        $pageTitle = 'لیست نقش ها';
        $tableHeads = ['نام فارسی','نام لاتین' , 'سطوح دسترسی' ,'تاریخ ایجاد', 'عملیات'];
        $roles = Role::paginate();
        $mainRoleId = Role::first()->id;
        return $this->renderView(
            'livewire.admin.role.list-role',
            [
                'pageTitle' => $pageTitle,
                'tableHeads' => $tableHeads,
                'roles' => $roles,
                'mainRoleId' => $mainRoleId,
            ]
        );
    }
}
