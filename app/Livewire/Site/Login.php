<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class Login extends SiteComponent
{

    public $email = '';
    public $password = '';
    public $remember = false;

    /**
     * @throws Throwable
     */
    public function login(): RedirectResponse|Redirector
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::whereEmail($this->email)->first();

            if (is_null($user)) {
                session()->flash('error', 'اطلاعات وارد شده نادرست است');
                return redirect()->route('site.login');
            }

            Auth::login($user);

            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('site.home');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('site.login');
        }
    }


    public function render(): View
    {
        $pageTitle = 'ورود';
        return $this->renderView(
            'livewire.site.login',
            $pageTitle
        );
    }
}
