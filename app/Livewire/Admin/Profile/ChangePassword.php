<?php

namespace App\Livewire\Admin\Profile;

use App\Livewire\BaseComponents\AdminComponent;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends AdminComponent
{
    protected $admin;
    public $oldPass;
    public $password;
    public $password_confirmation;

    public function boot()
    {
        $this->admin = auth()->user();
    }

    public function render()
    {
        return $this->renderView('livewire.admin.profile.change-password', ['admin' => $this->admin]);
    }

    public function change()
    {
        if (!Hash::check($this->oldPass, $this->admin->password)) {
            session()->flash('error', 'رمز عبور قبلی نادرست وارد شده است');
            return redirect()->route('admin.profile.change-password');
        }
        DB::beginTransaction();
        try {
            $this->admin->update([
                'password' => $this->password,
            ]);
            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.profile.change-password');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.profile.change-password');
        }
    }
}
