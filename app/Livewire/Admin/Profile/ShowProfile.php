<?php

namespace App\Livewire\Admin\Profile;


use App\Livewire\BaseComponents\AdminComponent;

class ShowProfile extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'پروفایل';
        return $this->renderView('livewire.admin.profile.show-profile', [
            'pageTitle' => $pageTitle,
            'admin' => auth()->user()
        ]);
    }
}
