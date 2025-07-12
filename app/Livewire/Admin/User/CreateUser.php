<?php

namespace App\Livewire\Admin\User;

use App\Enums\UserType;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class CreateUser extends AdminComponent
{
    public $name;
    public $email;
    public $type;
    public $password;
    public $role;

    public function render()
    {
        $pageTitle = 'ایجاد کاربر';
        $roles = Role::pluck('id', 'fa_name')->toArray();
        $types = showEnumLabels(UserType::class);
        return $this->renderView(
            'livewire.admin.user.create-user',
            $pageTitle,
            compact('roles', 'types')
        );
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,',
//            'role' => 'required|integer',
            'type' => [
                'required',
                new Enum(UserType::class),
            ],
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role,
            'type' => $this->type,
            'password' => $this->password,
        ];

        DB::beginTransaction();
        try {
            User::create($data);
            DB::commit();
            $this->reset(['name', 'email', 'password', 'role', 'type']);
            session()->flash('success', __('global.success_message'));
            return redirect()->back();
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->back();
        }
    }
}
