<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithPagination;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Profile extends SiteComponent
{
    use WithPagination;

    public $user;
    public $currentPassword;
    public $newPassword;
    public $newPassword_confirmation;
    public $activeSection;
    public $section;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount(): RedirectResponse|Redirector|null
    {
        $this->user = Auth::user();

        if (!$this->user) {
            return redirect()->route('site.home');
        }

        $this->activeSection = 'info';

        if (request()->has('section') && in_array(request()->get('section'), ['info', 'payments', 'orders', 'password'])) {
            $this->activeSection = request()->get('section');
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
                'activeSection' => $this->activeSection,
            ]
        );
    }

    public function showSection(string $sectionId): void
    {
        $this->activeSection = $sectionId;
    }

    public function changePassword(): void
    {
        $this->activeSection = 'password';

        $this->validate([
            'currentPassword' => 'required|min:8',
            'newPassword' => 'required|min:8|confirmed',
        ]);

        try {
            if (!Hash::check($this->currentPassword, $this->user->password)) {
                session()->flash('error', __('validation.current_password'));
                return;
            }

            $this->user->update([
                'password' => $this->newPassword
            ]);

            $this->reset(['currentPassword', 'newPassword', 'newPassword_confirmation']);

            session()->flash('success', __('global.success_message'));
        } catch (Exception $e) {
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
        }
    }
}
