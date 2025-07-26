<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Gate;

class ListGateway extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست‌ درگاه ها';
        $tableHeads = ['نام', 'لیبل', 'وضعیت', 'تاریخ ایجاد', 'عملیات'];
        $gateways = Gate::withoutTrashed()->paginate($this->perPage);
        return $this->renderView(
            'livewire.site.list-gateway',
            $pageTitle,
            compact('tableHeads', 'gateways')
        );
    }
}
