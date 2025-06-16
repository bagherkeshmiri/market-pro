<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;

class SiteComponent extends Component
{
    public function renderView(string $view, array $variables = [])
    {
        return view($view, $variables)->layout('layouts.site.site-layout');
    }

}
