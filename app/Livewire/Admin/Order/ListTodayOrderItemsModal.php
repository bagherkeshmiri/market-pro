<?php

namespace App\Livewire\Admin\Order;

use Illuminate\View\View;
use Livewire\Component;

class ListTodayOrderItemsModal extends Component
{
    public $items = [];
    public $modalId;
    public $modalTitle;

    public function render(): View
    {
        return view('livewire.admin.order.list-today-order-items-modal');
    }
}
