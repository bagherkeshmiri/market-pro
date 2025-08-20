<?php

namespace App\Livewire\Admin\DiscountCode;

use App\Enums\DiscountType;
use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use Illuminate\View\View;

class CreateDiscountCode extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'ایجاد کد تخفیف';
        $types = showEnumLabels(DiscountType::class);
        $statuses = showEnumLabels(IsActive::class);
        return $this->renderView(
            'livewire.admin.discount-code.create-discount-code',
            $pageTitle,
            compact('types', 'statuses')
        );
    }
}
