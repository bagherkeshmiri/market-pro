<?php

namespace App\Livewire\Admin\Gateway;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Gate;
use Illuminate\View\View;

class ListGateway extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست‌ درگاه ها';
        $tableHeads = ['نام', 'لیبل','وضعیت', 'تاریخ ایجاد', 'عملیات'];
        $gateways = Gate::withoutTrashed()->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.gateway.list-gateway',
            $pageTitle,
            compact('tableHeads', 'gateways')
        );
    }
}
