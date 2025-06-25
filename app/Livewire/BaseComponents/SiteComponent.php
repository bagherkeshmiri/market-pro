<?php

namespace App\Livewire\BaseComponents;

use App\Models\Category;
use Livewire\Component;

class SiteComponent extends Component
{
    protected $sampleProductImageUrl = 'images/frest/sample-product.png';

    public function renderView(string $view, string $pageTitle, array $variables = [])
    {
        $menus = Category::withoutTrashed()
            ->select([
                'id',
                'parent_id',
                'name',
            ])
            ->whereNull('parent_id')
            ->with([
                'children',
                'children.children',
                'children.children.children',
            ])
            ->get();
        return view($view, $variables)->layout('layouts.site.site-layout', [
            'pageTitle' => $pageTitle,
            'menus' => $menus,
        ]);
    }

}
