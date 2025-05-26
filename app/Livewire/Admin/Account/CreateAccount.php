<?php

namespace App\Livewire\Admin\Account;

use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateAccount extends Component
{
    public $name;
    public $family;
    public $mobile;
    public $userName;
    public $password;
    public $role;
    protected object $roleRepository;
    protected object $adminRepository;

    public function boot(
        AdminRepositoryInterface $adminRepo,
        RoleRepositoryInterface $roleRepo,
    ) {
        $this->roleRepository = $roleRepo;
        $this->adminRepository = $adminRepo;
    }

    public function render()
    {
        $roles = $this->roleRepository->all()->pluck('id', 'fa_name')->toArray();
        return view('livewire.admin.account.create-account', ['roles' => $roles])->layout('layouts.admin-layout');
    }

    public function store(): RedirectResponse
    {
        $this->validate([
            'name' => 'required',
            'family' => 'required',
            'userName' => 'required|min:8|unique:admins',
            'password' => 'required|min:8',
            'role' => 'required|numeric',
            'mobile' => 'required|numeric|digits:11|unique:admins,mobile',
        ]);

        $data = [
            'name' => $this->name,
            'family' => $this->family,
            'username' => $this->userName,
            'password' => $this->password,
            'mobile' => $this->mobile,
        ];
        DB::beginTransaction();
        try {
            $admin = $this->adminRepository->create($data);
            $admin->roles()->attach($this->role);
            DB::commit();
            $this->reset(['name', 'family', 'userName', 'password', 'role', 'mobile']);
            session()->flash('success', __('global.success_message'));
            return redirect()->back();
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->back();
        }
    }
}
