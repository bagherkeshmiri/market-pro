<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\AdminComponent;
use Illuminate\View\View;

class CreateGateway extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'ایجاد درگاه';
        return $this->renderView(
            'livewire.site.create-gateway',
            $pageTitle
        );
    }
}
