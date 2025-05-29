<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;

class AuthComponent extends Component
{
    protected $layoutName = 'layouts.admin.admin-auth-layout';

    public function renderView(string $view)
    {
        return view($view)->layout($this->layoutName);
    }

}
