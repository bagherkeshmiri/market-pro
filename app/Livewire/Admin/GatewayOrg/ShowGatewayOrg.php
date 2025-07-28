<?php

namespace App\Livewire\Admin\GatewayOrg;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Gate;
use App\Models\GateOrg;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ShowGatewayOrg extends AdminComponent
{
    public GateOrg $gateOrg;
    public $gates, $gateId, $label, $app_key;
    public IsActive $isDefault, $isActive;

    protected $listeners = [
        'isActive-updated' => 'updateIsActive',
        'isDefault-updated' => 'updateIsDefault',
    ];

    public function mount(): void
    {
        $this->gates = Gate::withoutTrashed()
            ->isActive()
            ->select([
                'id',
                'name',
            ])
            ->pluck('id', 'name')
            ->toArray();

        $this->fill([
            'gateId' => $this->gateOrg->gate_id,
            'label' => $this->gateOrg->label,
            'isDefault' => $this->gateOrg->is_default,
            'isActive' => $this->gateOrg->is_active,
        ]);
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
        $pageTitle = ' ویرایش تنظیمات درگاه ' . $this->gateOrg->name;
        return $this->renderView(
            'livewire.admin.gateway-org.show-gateway-org',
            $pageTitle
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'label' => 'required',
            'gateId' => 'required|numeric|exists:gates,id',
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
            return redirect()->route('admin.gateway-org.show', [
                'gateOrg' => $this->gateOrg->id,
            ]);
        }

        if ($this->isDefault == IsActive::Yes) {
            GateOrg::query()->
            update([
                'is_default' => IsActive::No,
            ]);
        }

        $data = [
            'label' => $this->label,
            'gate_id' => $this->gateId,
            'is_active' => $this->isActive,
            'is_default' => $this->isDefault,
        ];

        DB::beginTransaction();
        try {
            $this->gateOrg->update($data);
            DB::commit();
            $this->reset(['label']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.gateway-org.show', ['gateOrg' => $this->gateOrg->id]);
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.gateway-org.show', ['gateOrg' => $this->gateOrg->id]);
        }
    }

    private function violatesConstraints(): bool
    {
        if (
            $this->isDefault === IsActive::No &&
            !GateOrg::withoutTrashed()
                ->isActive()
                ->isDefault()
                ->where('id', '!=', $this->gateOrg->id)
                ->exists()
        ) {
            session()->flash('error', 'حداقل یک درگاه پیش‌فرض باید موجود باشد');
            return true;
        }

        if (
            $this->isActive === IsActive::No &&
            !GateOrg::withoutTrashed()
                ->isActive()
                ->where('id', '!=', $this->gateOrg->id)
                ->exists()
        ) {
            session()->flash('error', 'حداقل یک درگاه فعال باید موجود باشد');
            return true;
        }

        return false;
    }
}
