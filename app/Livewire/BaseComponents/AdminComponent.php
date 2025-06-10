<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;

class AdminComponent extends Component
{
    public function renderView(string $view, array $variables = [])
    {
        return view($view, $variables)->layout('layouts.admin.admin-layout');
    }

}
