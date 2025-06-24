<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;

class SiteComponent extends Component
{
    protected $sampleProductImageUrl = 'images/frest/sample-product.png';

    public function renderView(string $view, string $pageTitle, array $variables = [])
    {
        return view($view, $variables)->layout('layouts.site.site-layout', ['pageTitle' => $pageTitle]);
    }

}
