<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Auth;

use Illuminate\View\View;

class Profile extends SiteComponent
{
    public function render(): View
    {
        $user = Auth::user();
        $orders = $user->orders;

        return $this->renderView(
            'livewire.site.profile',
            'پروفایل',
            compact('user', 'orders')
        );
    }
}
