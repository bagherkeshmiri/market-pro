<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;

class Index extends SiteComponent
{
    public function render()
    {
        return $this->renderView('livewire.site.index');
    }
}
