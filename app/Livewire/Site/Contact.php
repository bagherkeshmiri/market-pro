<?php

namespace App\Livewire\Site;

use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Contact extends SiteComponent
{
    public $siteTitle;
    public $siteWorkingHour;
    public $siteEmail;
    public $siteAddress;
    public $siteTel;

    public function mount(): void
    {
        $this->siteTitle = getSystemSetting('site_title');
        $this->siteWorkingHour = getSystemSetting('site_working_hour');
        $this->siteEmail = getSystemSetting('site_email');
        $this->siteAddress = getSystemSetting('site_address');
        $this->siteTel = getSystemSetting('site_tel');
    }

    public function render(): View
    {
        return $this->renderView(
            'livewire.site.contact',
            'ارتباط با ما'
        );
    }
}
