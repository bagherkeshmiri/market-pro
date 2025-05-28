<?php

namespace App\Livewire\Admin\Profile;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
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
        return view('livewire.admin.profile.change-password', ['admin' => $this->admin])->layout('layouts.admin-layout');
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
