<?php

namespace App\Livewire\Admin\Admin;

use App\Enums\UserType;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ShowAdmin extends AdminComponent
{
    public User $admin;
    public $name;
    public $email;
    public $type;
    public $role;
    public $password;
    public $adminRole;

    public function mount(User $admin): void
    {
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->type = $admin->type;
        $this->role = $this->admin->permissions->pluck('id')->toArray()[0];
    }

    public function render(): View
    {
        $pageTitle = 'ویرایش کاربر';
        $roles = Role::pluck('id', 'fa_name')->toArray();
        $this->adminRole = auth()->user()->role_id;
        $this->fill([$this->adminRole]);
        $types = showEnumLabels(UserType::class);
        $admins = $this->admin;
        return $this->renderView(
            'livewire.admin.user.show-user',
            $pageTitle,
            compact('roles', 'types', 'admins')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->admin->id,
            'role' => 'required|integer',
            'type' => [
                'required',
                new Enum(UserType::class),
            ],
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role,
            'type' => $this->type->value,
        ];

        DB::beginTransaction();
        try {
            $this->admin->update($data);
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
