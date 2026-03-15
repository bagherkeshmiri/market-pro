<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;

class Login extends SiteComponent
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public function login(): RedirectResponse|Redirector
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $user = User::where('email', $this->email)->first();

            if (is_null($user) || !Hash::check($this->password, $user->password)) {
                session()->flash('error', 'اطلاعات وارد شده نادرست است');
                return redirect()->route('site.login');
            }

            Auth::guard('web')->login($user);

            session()->regenerate();

            session()->flash('success', __('global.success_message'));
            return redirect()->route('site.home');
        } catch (Exception $e) {
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('site.login');
        }
    }

    public function render(): View
    {
        return $this->renderView(
            'livewire.site.login',
            'ورود'
        );
    }
}
