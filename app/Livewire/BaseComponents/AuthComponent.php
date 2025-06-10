<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;

class AuthComponent extends Component
{
    public function renderView(string $view)
    {
        return view($view)->layout('layouts.admin.admin-auth-layout');
    }

}
