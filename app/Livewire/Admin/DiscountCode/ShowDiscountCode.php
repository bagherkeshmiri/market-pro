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

class ShowDiscountCode extends AdminComponent
{
    public DiscountCode $discount;
    public $code;
    public $isActive;
    public $type;
    public $amount;
    public $usageLimit;
    public $expiresAt;
    public $minOrderAmount;


    public function mount(): void
    {
        $this->code = $this->discount->code;
        $this->isActive = $this->discount->is_active;
        $this->type = $this->discount->type;
        $this->amount = $this->discount->amount;
        $this->usageLimit = $this->discount->usage_limit;
        $this->expiresAt = Jalalian::forge($this->discount->expires_at)->format('Y/m/d');
        $this->minOrderAmount = $this->discount->min_order_amount;
    }

    public function render(): View
    {
        $pageTitle = 'ویرایش کد تخفیف';
        $types = showEnumLabels(DiscountType::class);
        $statuses = showEnumLabels(IsActive::class);
        return $this->renderView(
            'livewire.admin.discount-code.show-discount-code',
            $pageTitle,
            compact('types', 'statuses')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
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
            'usage_limit' => $this->usageLimit,
            'expires_at' => Jalalian::fromFormat('Y/m/d', $this->expiresAt)->toCarbon()->endOfDay(),
            'min_order_amount' => str_replace(',', '', $this->minOrderAmount),
        ];

        DB::beginTransaction();
        try {
            $this->discount->update($data);
            DB::commit();
            $this->reset(['code', 'amount', 'usageLimit', 'minOrderAmount']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.discount.show', ['discount' => $this->discount->id]);
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.discount.show', ['discount' => $this->discount->id]);
        }
    }
}
