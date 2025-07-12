<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;

class AuthComponent extends Component
{
    public function renderView(string $view, string $pageTitle)
    {
        return view($view)->layout(
            'layouts.admin.admin-auth-layout', [
                'pageTitle' => $pageTitle,
            ]
        );
    }

}
