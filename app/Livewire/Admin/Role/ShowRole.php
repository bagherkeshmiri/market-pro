<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ShowRole extends AdminComponent
{
    public Role $role;
    public $faName;
    public $enName;
    public $allPermissions;
    public $selectAll = false;
    public $permissions = [];


    public function boot(): void
    {
        $this->allPermissions = Permission::all();
    }

    public function mount(): void
    {
        $this->faName = $this->role->fa_name;
        $this->enName = $this->role->en_name;
        $this->permissions = $this->role->permissions->pluck('id')->toArray();
    }

    public function render(): View
    {
        $allPermissions = $this->permissions;
        return $this->renderView(
            'livewire.admin.role.show-role',
            'ویرایش نقش',
            compact('allPermissions')
        );
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->permissions = $this->allPermissions->pluck('id');
        } else {
            $this->permissions = [];
        }
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
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
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->back();
        }
    }
}
