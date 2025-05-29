<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;

class AdminComponent extends Component
{
    protected $layoutName = 'layouts.admin.admin-layout';

    public function renderView(string $view, array $variables = [])
    {
        return view($view, $variables)->layout($this->layoutName);
    }

}
