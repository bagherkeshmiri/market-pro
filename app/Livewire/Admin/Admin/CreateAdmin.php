<?php

namespace App\Livewire\Admin\Admin;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class CreateAdmin extends AdminComponent
{
    public $name;
    public $email;
    public $password;
    public $role;


    public function mount(): void
    {
        $this->role = Role::first()->id;
    }


    public function render(): View
    {
        $roles = Role::pluck('id', 'fa_name')->toArray();
        return $this->renderView(
            'livewire.admin.admin.create-admin',
            'ایجاد مدیر',
            compact('roles')
        );
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,',
//            'role' => 'required|integer',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role,
            'password' => $this->password,
        ];

        DB::beginTransaction();
        try {
            Admin::create($data);
            DB::commit();
            $this->reset(['name', 'email', 'password', 'role']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.admin.index');
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.admin.create');
        }
    }
}
