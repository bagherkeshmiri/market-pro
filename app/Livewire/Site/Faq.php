<?php

namespace App\Livewire\Site;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;

class Faq extends SiteComponent
{
    public function render(): View
    {
        $faqs = \App\Models\Faq::where('is_active',IsActive::Yes)
            ->select([
                'id',
                'answer',
                'question'
            ])
            ->get();
        return $this->renderView(
            'livewire.site.faq',
            'سوالات متداول',
            compact('faqs')
        );
    }
}
