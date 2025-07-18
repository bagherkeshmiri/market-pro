<?php

namespace App\Livewire\Admin\Faq;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Faq;
use Illuminate\View\View;

class ListFaq extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست‌ سوالات متداول';
        $tableHeads = ['سوال', 'وضعیت', 'پاسخ', 'عملیات'];
        $faqs = Faq::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.faq.list-faq',
            $pageTitle,
            compact('tableHeads','faqs')
        );
    }
}
