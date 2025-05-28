<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class ListRole extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $roles = Role::paginate();
        $mainRoleId = Role::first()->id;
        return view('livewire.admin.role.list-role',['roles' => $roles , 'mainRoleId' => $mainRoleId])->layout('layouts.admin-layout');
    }
}
