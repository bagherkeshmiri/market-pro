<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Models\User;
use App\Repositories\Admin\AdminRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;

    public function login(): RedirectResponse
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ]);
        try {
            $admin = User::query()
                ->where('username', $this->username)
                ->first();

            if (is_null($admin)) {
                session()->flash('error', __('global.wrong_username'));
                return redirect()->back();
            }
            if (!Hash::check($this->password, $admin->password)) {
                session()->flash('error', __('global.wrong_password'));
                return redirect()->back();
            }
            Auth::guard('admin')->loginUsingId($admin->id);
            return redirect()->route('admin.dashboard');
        } catch (Exception) {
            session()->flash('error', __('global.error_message'));
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.admin.auth.login')->layout('layouts.admin-auth-layout');
    }
}
