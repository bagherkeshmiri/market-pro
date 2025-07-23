<?php

namespace App\Livewire\Site;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Faq extends SiteComponent
{
    public function render(): View
    {
        $pageTitle = 'سوالات متداول';
        $faqs = \App\Models\Faq::whereIsActive(IsActive::Yes)
            ->select([
                'id',
                'answer',
                'question'
            ])
            ->get();
        return $this->renderView(
            'livewire.site.faq',
            $pageTitle,
            compact('faqs')
        );
    }
}
