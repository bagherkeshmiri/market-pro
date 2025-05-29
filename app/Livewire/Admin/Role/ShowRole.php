<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Role;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ShowRole extends AdminComponent
{
    public Role $role;
    public $faName;
    public $enName;
    public $allPermissions;
    public $selectAll = false;
    public $permissions = [];
    protected object $permissionRepository;

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->faName = $role->fa_name;
        $this->enName = $role->en_name;
        $this->permissions = $this->role->permissions->pluck('id')->toArray();
    }

    public function boot(PermissionRepositoryInterface $permissionRepo)
    {
        $this->permissionRepository = $permissionRepo;
    }

    public function render()
    {
        $this->allPermissions = $this->permissionRepository->all();
        return $this->renderView(
            'livewire.admin.role.show-role',
            ['allPermissions' => $this->allPermissions]
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

    public function update(): RedirectResponse
    {
        $data = [
            'fa_name' => $this->faName,
            'en_name' => $this->enName,
        ];
        DB::beginTransaction();
        try {
            $this->role->update($data);
            $this->role->permissions()->sync(array_values($this->permissions));
            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->back();
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->back();
        }
    }
}
