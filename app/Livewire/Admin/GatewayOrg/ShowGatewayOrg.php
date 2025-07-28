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
    public $gates;
    public $gateId;
    public $label;
    public $app_key;
    public IsActive $isDefault;
    public IsActive $isActive;

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

        $this->gateId = $this->gateOrg->gate_id;
        $this->label = $this->gateOrg->label;
        $this->isDefault = $this->gateOrg->is_default;
        $this->isActive = $this->gateOrg->is_active;
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

        $defaultGateOrgExist = GateOrg::withoutTrashed()
            ->isActive()
            ->isDefault()
            ->where('id', '!=', $this->gateOrg->id)
            ->exists();


        if (!$defaultGateOrgExist && $this->isDefault == IsActive::No) {
            session()->flash('error', 'حداقل یک درگاه پیش‌فرض باید موجود باشد ');
            return redirect()->route('admin.gateway-org.show', ['gateOrg' => $this->gateOrg->id]);
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
}
