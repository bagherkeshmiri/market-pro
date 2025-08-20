<?php

namespace App\Livewire\Admin\DiscountCode;

use App\Enums\DiscountType;
use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\DiscountCode;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Morilog\Jalali\Jalalian;
use Throwable;

class CreateDiscountCode extends AdminComponent
{
    public $code;
    public $isActive;
    public $type;
    public $amount;
    public $usageLimit;
    public $usedCount;
    public $expiresAt;
    public $minOrderAmount;

    public function mount(): void
    {
        $this->isActive = IsActive::No;
        $this->type = DiscountType::Percent;
    }

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


    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'code' => 'required',
            'isActive' => [
                'required',
                new Enum(IsActive::class),
            ],
            'type' => [
                'required',
                new Enum(DiscountType::class),
            ],
            'amount' => 'required',
            'usageLimit' => 'required',
            'expiresAt' => 'required',
            'minOrderAmount' => 'required',
        ]);


        $data = [
            'code' => $this->code,
            'is_active' => $this->isActive,
            'type' => $this->type,
            'amount' => str_replace(',', '', $this->amount),
            'usageLimit' => $this->usageLimit,
            'expires_at' => Jalalian::fromFormat('Y/m/d', $this->expiresAt)->toCarbon()->endOfDay(),
            'min_order_amount' => str_replace(',', '', $this->minOrderAmount),
        ];

        DB::beginTransaction();
        try {
            DiscountCode::create($data);
            DB::commit();
            $this->reset(['code', 'amount', 'usageLimit', 'minOrderAmount']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.discount.index');
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.discount.create');
        }
    }
}
