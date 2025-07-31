<?php

namespace App\Livewire\Admin\GatewayOrg;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\GateOrg;
use Illuminate\View\View;

class ListGatewayOrg extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست‌  تنظیمات درگاه ها';
        $tableHeads = ['لیبل','درگاه', 'وضعیت', 'پیش‌فرض', 'تاریخ ایجاد', 'عملیات'];
        $gatewayOrgs = GateOrg::withoutTrashed()->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.gateway-org.list-gateway-org',
            $pageTitle,
            compact('tableHeads', 'gatewayOrgs')
        );
    }
}
