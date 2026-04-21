<?php

namespace App\Livewire\Admin\SystemSetting;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\SystemSetting;
use Cache;
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

    public function syncCache(): void
    {
        $systemSettings = SystemSetting::get(['key', 'value']);

        foreach ($systemSettings as $systemSetting) {
            $key = $systemSetting->key;
            $value = $systemSetting->value;

            Cache::forget('setting_' . $key);

            Cache::rememberForever('setting_' . $key, function () use ($key, $value) {
                return $value;
            });
        }
    }
}
