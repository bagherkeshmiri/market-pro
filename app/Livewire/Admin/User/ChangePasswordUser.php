<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Component;
use Throwable;

class ChangePasswordUser extends Component
{
    public User $user;
    public $oldPass;
    public $password;
    public $password_confirmation;

    public function render(): View
    {
        return view('livewire.admin.user.change-password-user');
    }

    /**
     * @throws Throwable
     */
    public function change(): void
    {
        if (!Hash::check($this->oldPass, $this->user->password)) {
            session()->flash('error', 'رمز عبور قبلی نادرست وارد شده است');
            return ;
        }
        DB::beginTransaction();
        try {
            $this->user->update([
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
