<?php

namespace App\Livewire\Admin\GatewayOrg;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Gate;
use Illuminate\View\View;

class CreateGatewayOrg extends AdminComponent
{
    public $gates;
    public $gateId;
    public $label;
    public $app_key;
    public $isDefault;

    public function mount(): void
    {
        $this->gates = Gate::withoutTrashed()
            ->isActive()
            ->select([
                'id',
                'name',
            ])
            ->pluck('id', 'name')
            ->toArray();
    }


    public function render(): View
    {
        $pageTitle = 'ایجاد تنظیمات درگاه';
        return $this->renderView(
            'livewire.admin.gateway-org.create-gateway-org',
            $pageTitle
        );
    }
}
