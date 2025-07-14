<?php

namespace App\Livewire\Site;

use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;

class Menu extends Component
{
    public $cart = [];
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

        $this->cartCount = session('cart_summary.count', 0);
        $this->cartTotal = session('cart_summary.total', 0);
        $this->updateCart();

    }

    public function updateCart(): void
    {
        $this->cart = Session::get('cart', []);
        $summary = Session::get('cart_summary', ['count' => 0, 'total' => 0]);
        $this->cartCount = $summary['count'];
        $this->cartTotal = $summary['total'];
    }

    public function render(): View
    {
        return view('livewire.site.menu');
    }
}
