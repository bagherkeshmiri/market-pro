<?php

namespace App\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowProfile extends Component
{
    public function render()
    {
        $admin = auth()->user();
        return view('livewire.admin.profile.show-profile', ['admin' => $admin])->layout('layouts.admin-layout');
    }
}
