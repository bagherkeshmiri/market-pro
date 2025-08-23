<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Admin;
use App\Models\Role;
use DB;
use Exception;
use Illuminate\View\View;
use Livewire\Component;
use Throwable;

class EditAdmin extends Component
{
    public Admin $admin;
    public $roles;
    public $name;
    public $email;
    public $role;

    public function mount(): void
    {
        $this->roles = Role::pluck('id', 'fa_name')->toArray();
        $this->name = $this->admin->name;
        $this->email = $this->admin->email;
        $this->role = $this->admin->role_id;
    }

    public function render(): View
    {
        return view('livewire.admin.admin.edit-admin');
    }

    /**
     * @throws Throwable
     */
    public function update(): void
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
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
        }
    }

}
