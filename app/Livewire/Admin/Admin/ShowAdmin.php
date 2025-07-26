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

class ShowAdmin extends AdminComponent
{
    public Admin $admin;
    public $name;
    public $email;
    public $role;
    public $password;

    public function mount(Admin $admin): void
    {
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->role = $admin->role->id;
    }

    public function render(): View
    {
        $pageTitle = 'ویرایش مدیر';
        $roles = Role::pluck('id', 'fa_name')->toArray();
        $this->fill([$this->role]);
        $admins = $this->admin;

        return $this->renderView(
            'livewire.admin.admin.show-admin',
            $pageTitle,
            compact('roles', 'admins')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $this->admin->id,
            'role' => 'required|integer',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role,
        ];

        DB::beginTransaction();
        try {
            $this->admin->update($data);
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
