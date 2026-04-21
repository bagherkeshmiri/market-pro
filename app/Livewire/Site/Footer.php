<?php

namespace App\Livewire\Site;

use App\Models\Category;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;

class Footer extends Component
{
    public $siteTitle;
    public $siteWorkingHour;
    public $siteEmail;
    public $siteAddress;
    public $siteTel;

    public function mount(): void
    {
        $systemSetting = SystemSetting::getMultipleFromCache();

        $this->siteTitle = $systemSetting[SystemSetting::CACHE_PREFIX . 'site_title'];
        $this->siteWorkingHour = $systemSetting[SystemSetting::CACHE_PREFIX . 'site_working_hour'];
        $this->siteEmail = $systemSetting[SystemSetting::CACHE_PREFIX . 'site_email'];
        $this->siteAddress = $systemSetting[SystemSetting::CACHE_PREFIX . 'site_address'];
        $this->siteTel = $systemSetting[SystemSetting::CACHE_PREFIX . 'site_tel'];
    }

    public function render(): View
    {
        return view('livewire.site.footer');
    }
}
