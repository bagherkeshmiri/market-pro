<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Role;
use Livewire\WithPagination;

class ListRole extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $pageTitle = 'لیست نقش ها';
        $tableHeads = ['نام فارسی','نام لاتین' , 'سطوح دسترسی' ,'تاریخ ایجاد', 'عملیات'];
        $roles = Role::paginate($this->perPage);
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
