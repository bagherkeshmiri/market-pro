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

class CreateRole extends AdminComponent
{
    public $faName;
    public $enName;
    public $permissions;
    public $selectAll = false;


    public function boot(): void
    {
        $this->permissions = Permission::all();
    }

    public function render(): View
    {
        $pageTitle = 'ایجاد نقش';
        $allPermissions = $this->permissions;
        return $this->renderView(
            'livewire.admin.role.create-role',
            $pageTitle,
            compact('allPermissions')
        );
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->permissions = $this->permissions->pluck('id');
        } else {
            $this->permissions = [];
        }
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $data = [
            'fa_name' => $this->faName,
            'en_name' => $this->enName,
        ];
        DB::beginTransaction();
        try {
            $role = Role::create($data);
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
