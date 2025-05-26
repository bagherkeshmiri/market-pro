<?php

namespace App\Livewire\Admin\Role;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class ListRole extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected object $permissionRepository;
    protected object $roleRepository;

    public function boot(
        PermissionRepositoryInterface $permissionRepo,
        RoleRepositoryInterface $roleRepo,
    ) {
        $this->permissionRepository = $permissionRepo;
        $this->roleRepository = $roleRepo;
    }

    public function render()
    {
        $roles = $this->roleRepository->paginate();
        $mainRoleId = $this->roleRepository->first()->id;
        return view('livewire.admin.role.list-role',['roles' => $roles , 'mainRoleId' => $mainRoleId])->layout('layouts.admin-layout');
    }
}
