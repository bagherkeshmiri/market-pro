<?php

namespace App\Livewire\Admin\SystemSetting;

use App\Enums\SystemSettingType;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ShowSystemSetting extends AdminComponent
{
    public SystemSetting $systemSetting;
    public $label;
    public $key;
    public $type;
    public $value;

    public function mount(): void
    {
        $this->label = $this->systemSetting->label;
        $this->key = $this->systemSetting->key;
        $this->type = $this->systemSetting->type;
        $this->value = $this->systemSetting->value;
    }

    public function render(): View
    {
        $types = showEnumLabels(SystemSettingType::class);
        return $this->renderView(
            'livewire.admin.system-setting.show-system-setting',
            'ویرایش تنظیمات سایت',
            compact('types')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'label' => 'required',
            'key' => 'required',
            'value' => 'required',
            'type' => [
                'required',
                new Enum(SystemSettingType::class),
            ],
        ]);

        $data = [
            'label' => $this->label,
            'key' => $this->key,
            'value' => $this->value,
            'type' => $this->type,
        ];

        DB::beginTransaction();
        try {
            $this->systemSetting->update($data);
            DB::commit();
            $this->reset(['label', 'key', 'value', 'type']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.system-setting.show', ['systemSetting' => $this->systemSetting->id]);
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.system-setting.show', ['systemSetting' => $this->systemSetting->id]);
        }
    }
}
