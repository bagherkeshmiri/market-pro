<?php

namespace App\Livewire\Admin\Account;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Role;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateUser extends AdminComponent
{
    public $name;
    public $family;
    public $mobile;
    public $userName;
    public $password;
    public $role;

    public function render()
    {
        $pageTile = 'ایجاد کاربر';
        $roles = Role::pluck('id', 'fa_name')->toArray();
        return $this->renderView(
            'livewire.admin.user.create-user',
            [
                'roles' => $roles,
                'pageTitle' => $pageTile,
            ]
        );
    }

    /**
     * @throws Throwable
     */
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
