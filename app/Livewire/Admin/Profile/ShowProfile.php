<?php

namespace App\Livewire\Admin\Profile;


use App\Livewire\BaseComponents\AdminComponent;

class ShowProfile extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'پروفایل';
        $admin = auth()->user();
        return $this->renderView(
            'livewire.admin.profile.show-profile',
            $pageTitle,
            compact('admin')
        );
    }
}
