<?php

namespace App\Livewire\Admin\Auth;

use App\Livewire\BaseComponents\AuthComponent;
use App\Models\Admin;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
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
            $admin = Admin::query()->where('email', $this->email)
                ->first();

            if (is_null($admin) || !Hash::check($this->password, $admin->password)) {
                session()->flash('error', __('global.wrong_inputs'));
                return redirect()->back();
            }

            Auth::guard('admin')->loginUsingId($admin->id);
            session()->regenerate();

            return redirect()->route('admin.dashboard');
        } catch (Exception $e) {
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->back();
        }
    }

    public function render(): View
    {
        $pageTitle = 'ورود مدیران';
        return $this->renderView('livewire.admin.auth.login', $pageTitle);
    }
}
