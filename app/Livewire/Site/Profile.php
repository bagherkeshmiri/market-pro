<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Auth;
use Illuminate\View\View;
use Livewire\WithPagination;

class Profile extends SiteComponent
{
    use WithPagination;

    public $user;

    public function mount()
    {
        $this->user = Auth::user();

        if (!$this->user) {
            return redirect()->route('site.home');
        }
    }

    public function render(): View
    {
        $orders = $this->user->orders()->latest()->paginate($this->perPage);


        return $this->renderView(
            'livewire.site.profile',
            'پروفایل',
            [
                'user' => $this->user,
                'orders' => $orders,
            ]
        );
    }
}
