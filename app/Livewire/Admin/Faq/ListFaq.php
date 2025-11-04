<?php

namespace App\Livewire\Admin\Faq;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Faq;
use Illuminate\View\View;

class ListFaq extends AdminComponent
{
    public function render(): View
    {
        $tableHeads = ['سوال', 'وضعیت', 'پاسخ', 'عملیات'];
        $faqs = Faq::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.faq.list-faq',
            'لیست‌ سوالات متداول',
            compact('tableHeads','faqs')
        );
    }
}
