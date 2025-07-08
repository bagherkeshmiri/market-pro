<?php

namespace App\Livewire\Admin\Auth;

use App\Livewire\BaseComponents\AuthComponent;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Features\SupportRedirects\Redirector;

class Login extends AuthComponent
{
    public $email;
    public $password;

    public function login(): RedirectResponse|Redirector
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        try {
            $admin = User::IsAdmin()
                ->where('email', $this->email)
                ->first();

            if (is_null($admin) || !Hash::check($this->password, $admin->password)) {
                session()->flash('error', __('global.wrong_inputs'));
                return redirect()->back();
            }

            Auth::loginUsingId($admin->id);
            return redirect()->route('admin.dashboard');
        } catch (Exception) {
            session()->flash('error', __('global.error_message'));
            return redirect()->back();
        }
    }

    public function render()
    {
        return $this->renderView('livewire.admin.auth.login');
    }
}
