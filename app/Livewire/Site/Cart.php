<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Cart extends SiteComponent
{
    public $items = [];

    protected $listeners = ['receiveCart' => 'setCart'];

    public function setCart($data): void
    {
        $this->items = $data['items'] ?? [];

//        \Log::info('items: ' . json_encode($this->items));

    }

    public function render(): View
    {
        $pageTitle = 'سبد خرید';
        return $this->renderView(
            'livewire.site.cart',
            $pageTitle,
            [
                'items' => $this->items,
            ]
        );
    }
}
