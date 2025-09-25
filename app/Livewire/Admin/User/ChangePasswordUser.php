<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Throwable;

class ChangePasswordUser extends Component
{
    public User $user;
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
        $this->validate([
            'password' => 'required|min:8|confirmed'
        ]);

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
