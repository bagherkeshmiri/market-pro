<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Role;
use Illuminate\View\View;

class ListRole extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست نقش ها';
        $tableHeads = ['نام فارسی', 'نام لاتین', 'سطوح دسترسی', 'تاریخ ایجاد', 'عملیات'];
        $roles = Role::paginate($this->perPage);
        $mainRoleId = Role::first()->id;
        return $this->renderView(
            'livewire.admin.role.list-role',
            $pageTitle,
            compact('tableHeads', 'roles', 'mainRoleId')
        );
    }
}
