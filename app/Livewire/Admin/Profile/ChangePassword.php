<?php

namespace App\Livewire\Admin\Profile;

use App\Livewire\BaseComponents\AdminComponent;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ChangePassword extends AdminComponent
{
    protected $admin;
    public $oldPass;
    public $password;
    public $password_confirmation;

    public function boot(): void
    {
        $this->admin = auth('admin')->user();
    }

    public function render(): View
    {
        $pageTitle = ' تغییر رمز عبور';
        $admin = $this->admin;
        return $this->renderView(
            'livewire.admin.profile.change-password',
            $pageTitle,
            compact('admin')
        );
    }

    /**
     * @throws Throwable
     */
    public function change(): RedirectResponse|Redirector
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
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.profile.change-password');
        }
    }
}
