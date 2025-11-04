<?php

namespace App\Livewire\Admin\Profile;


use App\Livewire\BaseComponents\AdminComponent;
use Illuminate\View\View;

class ShowProfile extends AdminComponent
{
    public function render(): View
    {
        $admin = auth('admin')->user();

        return $this->renderView(
            'livewire.admin.profile.show-profile',
            'پروفایل',
            compact('admin')
        );
    }
}
