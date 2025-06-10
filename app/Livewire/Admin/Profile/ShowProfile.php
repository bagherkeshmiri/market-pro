<?php

namespace App\Livewire\Admin\Profile;


use App\Livewire\BaseComponents\AdminComponent;

class ShowProfile extends AdminComponent
{
    public function render()
    {
        $pageTile = 'پروفایل';
        return $this->renderView('livewire.admin.profile.show-profile', [
            'pageTitle' => $pageTile,
            'admin' => auth()->user()
        ]);
    }
}
