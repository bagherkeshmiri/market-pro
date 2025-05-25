<?php

namespace App\Http\Livewire\Admin\Account;

use App\Models\Admin;
use App\Repositories\Role\RoleRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowAccount extends Component
{
    public object $admin;
    public $name;
    public $family;
    public $mobile;
    public $username;
    public $password;
    public $role;
    public $adminRole;
    protected object $roleRepository;

    public function boot(RoleRepositoryInterface $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    public function mount(Admin $admin)
    {
        $this->name = $admin->name;
        $this->family = $admin->family;
        $this->mobile = $admin->mobile;
        $this->username = $admin->username;
        $this->role = $this->admin->roles->pluck('id')->toArray()[0];
    }

    public function render()
    {
        $roles = $this->roleRepository->all()->pluck('id', 'fa_name')->toArray();
        $this->adminRole = $this->admin->roles->pluck('id')->toArray()[0];
        $this->fill([$this->adminRole]);
        return view(
            'livewire.admin.account.show-account',
            ['admins' => $this->admin, 'roles' => $roles]
        )->layout('layouts.admin-layout');
    }

    public function update(): RedirectResponse
    {
        $this->validate([
            'name' => 'required',
            'family' => 'required',
            'username' => 'required|min:8|unique:admins,username,' . $this->admin->id,
            'role' => 'numeric',
            'mobile' => 'required|numeric|digits:11|unique:admins,mobile,' . $this->admin->id,
        ]);

        $data = [
            'name' => $this->name,
            'family' => $this->family,
            'username' => $this->username,
            'mobile' => $this->mobile,
        ];
        DB::beginTransaction();
        try {
            $this->admin->update($data);
            $this->admin->roles()->sync($this->role);
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
