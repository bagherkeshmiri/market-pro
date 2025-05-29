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
        $roles = Role::paginate();
        $mainRoleId = Role::first()->id;
        return $this->renderView(
            'livewire.admin.role.list-role',
            [
                'roles' => $roles,
                'mainRoleId' => $mainRoleId,
            ]
        );
    }
}
