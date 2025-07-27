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

class CreateGatewayOrg extends AdminComponent
{
    public $gates;
    public $gateId;
    public $label;
    public $app_key;
    public $isDefault = false;
    public bool $isActive = false;

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

        $this->gateId = reset($this->gates);
    }

    public function updateIsActive(bool $value): void
    {
        $this->isActive = $value;
    }

    public function updateIsDefault(bool $value): void
    {
        $this->isDefault = $value;
    }

    public function render(): View
    {
        $pageTitle = 'ایجاد تنظیمات درگاه';
        return $this->renderView(
            'livewire.admin.gateway-org.create-gateway-org',
            $pageTitle
        );
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'label' => 'required',
            'gateId' => 'required|numeric|exists:gates,id',
            'isActive' => [
                'required',
                new Enum(IsActive::class)
            ],
        ]);

        $data = [
            'label' => $this->label,
            'gate_id' => $this->gateId,
            'is_active' => $this->isActive,
            'is_default' => $this->isDefault,
        ];

        DB::beginTransaction();
        try {
            GateOrg::create($data);
            DB::commit();
            $this->reset(['label']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.gateway-org.index');
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.gateway-org.create');
        }
    }


}
