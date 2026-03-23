<?php

namespace App\Livewire\Admin\System;

use App\Livewire\BaseComponents\AdminComponent;
use Illuminate\Contracts\View\View;
use App\Services\SystemMonitorService;

class SystemMonitor extends AdminComponent
{
    public $systemData = [
        'memory' => 0.0,
        'disk' => [
            'total' => 0.0,
            'used' => 0.0,
            'free' => 0.0,
            'percentage' => 0
        ],
        'cpu' => 0.0,
    ];

    public function mount(SystemMonitorService $monitorService): void
    {
        $this->updateAllData($monitorService);
    }

    public function updateAllData(SystemMonitorService $monitorService): void
    {
        $this->systemData = $monitorService->getAllData();
    }

    public function render(): View
    {
        return $this->renderView(
            'livewire.admin.system.list-system',
            'وضعیت سیستم',
        );
    }
}
