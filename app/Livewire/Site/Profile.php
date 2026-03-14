<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\WithPagination;

class Profile extends SiteComponent
{
    use WithPagination;

    public $user;
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;

    public function mount(): RedirectResponse|null
    {
        $this->user = Auth::user();

        if (!$this->user) {
            return redirect()->route('site.home');
        }
        return null;
    }

    public function render(): View
    {
        $payments = $this->user->payments()->with('order')->latest()->paginate($this->perPage);
        $orders = $this->user->orders()->latest()->paginate($this->perPage);

        return $this->renderView(
            'livewire.site.profile',
            'پروفایل',
            [
                'user' => $this->user,
                'orders' => $orders,
                'payments' => $payments,
            ]
        );
    }

    public function changePassword(): RedirectResponse
    {
        $this->validate([
            'currentPassword' => 'required|min:8',
            'newPassword' => 'required|min:8|confirmed',
            'confirmPassword' => 'required|min:8',
        ]);

        try {

            // TODO

            session()->flash('success', __('global.success_message'));
            return redirect()->route('site.profile');
        } catch (Exception $e) {
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('site.profile');
        }

    }
}
