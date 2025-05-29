<?php

namespace App\Livewire\Admin\Profile;


use App\Livewire\BaseComponents\AdminComponent;

class ShowProfile extends AdminComponent
{
    public function render()
    {
        $admin = auth()->user();
        return $this->renderView('livewire.admin.profile.show-profile', ['admin' => $admin]);
    }
}
