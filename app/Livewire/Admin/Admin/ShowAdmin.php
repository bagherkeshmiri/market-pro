<?php

namespace App\Livewire\Admin\Admin;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Admin;
use Illuminate\View\View;

class ShowAdmin extends AdminComponent
{
    public Admin $admin;

    public function render(): View
    {
        return $this->renderView(
            'livewire.admin.admin.show-admin',
            'ویرایش مدیر'
        );
    }


}
