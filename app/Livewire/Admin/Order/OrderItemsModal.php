<?php

namespace App\Livewire\Admin\Order;

use Illuminate\View\View;
use Livewire\Component;

class OrderItemsModal extends Component
{
    public $items = [];
    public $modalId;
    public $modalTitle;

    public function render(): View
    {
        return view('livewire.admin.order.order-items-modal');
    }
}
