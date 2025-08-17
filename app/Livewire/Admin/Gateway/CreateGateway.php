<?php

namespace App\Livewire\Admin\Gateway;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Gate;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class CreateGateway extends AdminComponent
{
    public $name;
    public $label;
    public $token;
    public IsActive $isActive;
    public IsActive $isDefault;

    protected $listeners = [
        'isActive-updated' => 'updateIsActive',
        'isDefault-updated' => 'updateIsDefault',
    ];

    public function mount(): void
    {
        $this->isActive = IsActive::No;
        $this->isDefault = IsActive::No;
    }

    public function updateIsActive(bool $value): void
    {
        $this->isActive = $value ? IsActive::Yes : IsActive::No;
    }

    public function updateIsDefault(bool $value): void
    {
        $this->isDefault = $value ? IsActive::Yes : IsActive::No;
    }

    public function render(): View
    {
        $pageTitle = 'ایجاد درگاه';
        $statuses = showEnumLabels(IsActive::class);
        return $this->renderView(
            'livewire.admin.gateway.create-gateway',
            $pageTitle,
            compact('statuses')
        );
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required|regex:/^[A-Za-z]+$/',
            'label' => 'required',
            'token' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (
                        request()->isActive == IsActive::Yes->value ||
                        request()->isDefault == IsActive::Yes->value
                    ) {
                        if (empty($value)) {
                            $fail('توکن در صورت فعال بودن یا پیش‌فرض بودن الزامی است.');
                        }
                    }
                }
            ],
            'isActive' => [
                'required',
                new Enum(IsActive::class)
            ],
            'isDefault' => [
                'required',
                new Enum(IsActive::class)
            ],
        ]);


        $data = [
            'name' => $this->name,
            'label' => $this->label,
            'token' => $this->token,
            'is_active' => $this->isActive,
            'is_default' => $this->isDefault,
        ];

        DB::beginTransaction();
        try {
            Gate::create($data);
            DB::commit();
            $this->reset(['name', 'label', 'token']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.gateway.index');
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.gateway.create');
        }
    }

}
