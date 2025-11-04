<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;

class Register extends SiteComponent
{
    public $email;
    public $password;

    public function create(): RedirectResponse|Redirector
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        try {
            $data = [
                'email' => $this->email,
                'password' => $this->password,
            ];

            $createdUser = User::create($data);

            Auth::guard('web')->login($createdUser);

            session()->regenerate();

            session()->flash('success', __('global.success_message'));
            return redirect()->route('site.home');
        } catch (Exception $e) {
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('site.register');
        }
    }


    public function render(): View
    {
        return $this->renderView(
            'livewire.site.register',
            'عضویت'
        );
    }
}
