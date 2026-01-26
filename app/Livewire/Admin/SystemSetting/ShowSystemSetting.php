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
use Morilog\Jalali\Jalalian;
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

//    /**
//     * @throws Throwable
//     */
//    public function update(): RedirectResponse|Redirector
//    {
//        $this->validate([
//            'code' => 'required',
//            'isActive' => [
//                'required',
//                new Enum(IsActive::class),
//            ],
//            'type' => [
//                'required',
//                new Enum(DiscountType::class),
//            ],
//            'amount' => 'required',
//            'usageLimit' => 'required',
//            'expiresAt' => 'required',
//            'minOrderAmount' => 'required',
//        ]);
//
//        $data = [
//            'code' => $this->code,
//            'is_active' => $this->isActive,
//            'type' => $this->type,
//            'amount' => str_replace(',', '', $this->amount),
//            'usage_limit' => $this->usageLimit,
//            'expires_at' => Jalalian::fromFormat('Y/m/d', $this->expiresAt)->toCarbon()->endOfDay(),
//            'min_order_amount' => str_replace(',', '', $this->minOrderAmount),
//        ];
//
//        DB::beginTransaction();
//        try {
//            $this->discount->update($data);
//            DB::commit();
//            $this->reset(['code', 'amount', 'usageLimit', 'minOrderAmount']);
//            session()->flash('success', __('global.success_message'));
//            return redirect()->route('admin.discount.show', ['discount' => $this->discount->id]);
//        } catch (Exception $e) {
//            DB::rollBack();
//            if (app()->isLocal()) {
//                session()->flash('error', $e->getMessage());
//            } else {
//                session()->flash('error', __('global.error_message'));
//            }
//            return redirect()->route('admin.discount.show', ['discount' => $this->discount->id]);
//        }
//    }
}
