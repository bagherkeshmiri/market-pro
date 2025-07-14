<?php

namespace App\Livewire\BaseComponents;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class SiteComponent extends Component
{
    use WithPagination;

    public int $page = 1;
    public int $perPage = 8;
    protected $queryString = ['page'];
    protected $sampleProductImageUrl = 'images/frest/sample-product.png';

    public function renderView(string $view, string $pageTitle, array $variables = [])
    {
//        $menus = Category::withoutTrashed()
//            ->select([
//                'id',
//                'parent_id',
//                'name',
//            ])
//            ->whereNull('parent_id')
////            ->with([
////                'children',
////                'children.children',
////                'children.children.children',
////            ])
//            ->get();
//
//
//        $searchMenuCategories = Category::select([
//            'id',
//            'name',
//        ])
//            ->whereNull('parent_id')
//            ->get();


        return view($view, $variables)->layout('layouts.site.site-layout', [
            'pageTitle' => $pageTitle,
//            'menus' => $menus,
//            'searchMenuCategories' => $searchMenuCategories,
        ]);
    }

}
