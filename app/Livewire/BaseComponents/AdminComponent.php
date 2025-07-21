<?php

namespace App\Livewire\BaseComponents;

use Livewire\Component;
use Livewire\WithPagination;

class AdminComponent extends Component
{
    use WithPagination;

    public int $page = 1;
    public int $perPage = 10;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['page'];
    protected $sampleImageUrl = 'images/sample.png';

    public function renderView(string $view, string $pageTitle, array $variables = [])
    {
        return view($view, $variables)->layout('layouts.admin.admin-layout', [
            'pageTitle' => $pageTitle,
        ]);
    }

}
