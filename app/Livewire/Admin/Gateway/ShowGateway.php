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

class ShowGateway extends AdminComponent
{
    public Gate $gate;
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
        $this->name = $this->gate->name;
        $this->label = $this->gate->label;
        $this->isActive = $this->gate->is_active;
        $this->isDefault = $this->gate->is_default;
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
        $statuses = showEnumLabels(IsActive::class);
        return $this->renderView(
            'livewire.admin.gateway.show-gateway',
            ' ویرایش درگاه ' . $this->gate->label,
            compact('statuses')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
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

        if ($this->violatesConstraints()) {
            return redirect()->route('admin.gateway.show', [
                'gate' => $this->gate->id,
            ]);
        }

        if ($this->isDefault == IsActive::Yes) {
            Gate::query()->
            update([
                'is_default' => IsActive::No,
            ]);
        }

        $data = [
            'name' => $this->name,
            'label' => $this->label,
            'is_active' => $this->isActive,
            'is_default' => $this->isDefault,
        ];

        if (!empty($this->token)) {
            $data['token'] = $this->token;
        }

        DB::beginTransaction();
        try {
            $this->gate->update($data);
            DB::commit();
            $this->reset(['name', 'label', 'token']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.gateway.show', ['gate' => $this->gate->id]);
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.gateway.show', ['gate' => $this->gate->id]);
        }
    }


    private function violatesConstraints(): bool
    {
        if ($this->isDefault === IsActive::No &&
            !Gate::withoutTrashed()
                ->isActive()
                ->isDefault()
                ->where('id', '!=', $this->gate->id)
                ->exists()
        ) {
            session()->flash('error', 'حداقل یک درگاه پیش‌فرض باید موجود باشد');
            return true;
        }

        if ($this->isActive === IsActive::No &&
            !Gate::withoutTrashed()
                ->isActive()
                ->where('id', '!=', $this->gate->id)
                ->exists()
        ) {
            session()->flash('error', 'حداقل یک درگاه فعال باید موجود باشد');
            return true;
        }

        if ($this->isActive === IsActive::No && $this->isDefault === IsActive::Yes) {
            session()->flash('error', 'امکان غیر فعال کردن درگاه پیش‌فرض وجود ندارد');
            return true;
        }

        return false;
    }


}
