<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;
use Livewire\WithPagination;

class SiteComponent extends Component
{
    use WithPagination;

    public int $page = 1;
    public int $perPage = 8;
    protected $queryString = ['page'];
    protected $sampleImageUrl = 'images/sample.png';

    protected  function renderView(string $view, string $pageTitle, array $variables = [])
    {
        return view($view, $variables)->layout('layouts.site.site-layout', [
            'pageTitle' => $pageTitle,
        ]);
    }

}
