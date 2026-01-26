<?php

namespace App\Livewire\Site;

use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;

class Footer extends Component
{
    public $siteTitle;
    public $siteWorkingHour;
    public $siteEmail;
    public $siteAddress;

    public function mount(): void
    {
        $this->siteTitle = getSystemSetting('site_title');
        $this->siteWorkingHour = getSystemSetting('site_working_hour');
        $this->siteEmail = getSystemSetting('site_email');
        $this->siteAddress = getSystemSetting('site_address');
    }

    public function render(): View
    {
        return view('livewire.site.footer');
    }
}
