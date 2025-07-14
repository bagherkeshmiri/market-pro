<?php

namespace App\Livewire\Site;

use App\Models\Category;
use Illuminate\View\View;
use Livewire\Component;

class Menu extends Component
{
    public $cartCount = 0;
    public $cartTotal = 0;
    public $menus;
    public $searchMenuCategories;
    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount(): void
    {
        $this->menus = Category::withoutTrashed()
            ->select([
                'id',
                'parent_id',
                'name',
            ])
            ->whereNull('parent_id')
//            ->with([
//                'children',
//                'children.children',
//                'children.children.children',
//            ])
            ->get();


        $this->searchMenuCategories = Category::select([
            'id',
            'name',
        ])
            ->whereNull('parent_id')
            ->get();

        $this->cartCount = session('cart.count', 0);
        $this->cartTotal = session('cart.total', 0);

    }

    public function updateCart($count, $total): void
    {
        $this->cartCount = $count;
        $this->cartTotal = $total;
    }

    public function render(): View
    {
        return view('livewire.site.menu');
    }
}
