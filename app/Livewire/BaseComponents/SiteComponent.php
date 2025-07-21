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

    public function getSampleImageUrl(): string
    {
        return config('defaults.default_image');
    }

    protected function renderView(string $view, string $pageTitle, array $variables = [])
    {
        return view($view, $variables)->layout('layouts.site.site-layout', [
            'pageTitle' => $pageTitle,
        ]);
    }

}
