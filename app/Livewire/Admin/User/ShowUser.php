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
        $pageTitle = ' اطلاعات کاربر ' . $this->user->name;

        return $this->renderView(
            'livewire.admin.user.show-user',
            $pageTitle
        );
    }

}
