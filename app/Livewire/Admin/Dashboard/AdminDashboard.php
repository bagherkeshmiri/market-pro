<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.admin-dashboard')->layout('layouts.admin-layout');
    }
}
