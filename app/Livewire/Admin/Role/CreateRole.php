<?php

namespace App\Livewire\Admin\Role;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateRole extends Component
{
    public $faName;
    public $enName;
    public $allPermissions;
    public $permissions = [];
    public $selectAll = false;
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
        $this->allPermissions = $this->permissionRepository->all();
        return view('livewire.admin.role.create-role', ['allPermissions' => $this->allPermissions])->layout(
            'layouts.admin-layout'
        );
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->permissions = $this->permissionRepository->all()->pluck('id');
        } else {
            $this->permissions = [];
        }
    }

    public function store(): RedirectResponse
    {
        $data = [
            'fa_name' => $this->faName,
            'en_name' => $this->enName,
        ];
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->create($data);
            $role->permissions()->attach($this->permissions);
            DB::commit();
            $this->reset(['faName', 'enName', 'permissions']);
            session()->flash('success', __('global.success_message'));
            return redirect()->back();
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->back();
        }
    }
}
