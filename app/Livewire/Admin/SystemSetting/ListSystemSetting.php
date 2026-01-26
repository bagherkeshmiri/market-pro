<?php

namespace App\Livewire\Admin\SystemSetting;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\SystemSetting;
use Illuminate\View\View;

class ListSystemSetting extends AdminComponent
{
    public function render(): View
    {
        $tableHeads = [
            'عنوان',
            'کلید',
            'مقدار',
            'نوع داده',
            'تاریخ ایجاد',
            'عملیات'
        ];
        $systemSettings = SystemSetting::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.system-setting.list-system-setting',
            'لیست  تنظیمات',
            compact('tableHeads', 'systemSettings')
        );
    }
}
