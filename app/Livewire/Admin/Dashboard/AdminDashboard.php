<?php

namespace App\Livewire\Admin\Dashboard;

use App\Livewire\BaseComponents\AdminComponent;

class AdminDashboard extends AdminComponent
{
    public function render()
    {
        return $this->renderView('livewire.admin.dashboard.admin-dashboard');
    }
}
