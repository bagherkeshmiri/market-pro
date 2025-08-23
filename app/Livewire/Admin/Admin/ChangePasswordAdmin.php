<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Component;
use Throwable;

class ChangePasswordAdmin extends Component
{
    public Admin $admin;
    public $oldPass;
    public $password;
    public $password_confirmation;

    public function render(): View
    {
        return view('livewire.admin.admin.change-password-admin');
    }

    /**
     * @throws Throwable
     */
    public function change(): void
    {
        if (!Hash::check($this->oldPass, $this->admin->password)) {
            session()->flash('error', 'رمز عبور قبلی نادرست وارد شده است');
            return ;
        }
        DB::beginTransaction();
        try {
            $this->admin->update([
                'password' => $this->password,
            ]);
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
