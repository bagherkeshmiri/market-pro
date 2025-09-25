<?php

namespace App\Livewire\Admin\User;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\User;
use Illuminate\View\View;

class ShowUser extends AdminComponent
{
    public User $user;

    public function render(): View
    {
        return $this->renderView(
            'livewire.admin.user.show-user',
            ' اطلاعات کاربر ' . $this->user->name
        );
    }

}
