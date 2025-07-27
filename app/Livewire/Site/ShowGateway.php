<?php

namespace App\Livewire\Site;

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
    public $isActive;

    public function mount(): void
    {
        $this->name = $this->gate->name;
        $this->label = $this->gate->label;
        $this->isActive = $this->gate->is_active;
    }

    public function render(): View
    {
        $pageTitle = ' ویرایش درگاه ' . $this->gate->name;
        $statuses = showEnumLabels(IsActive::class);
        return $this->renderView(
            'livewire.site.show-gateway',
            $pageTitle,
            compact('statuses')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'label' => 'required',
            'isActive' => [
                'required',
                new Enum(IsActive::class)
            ],
        ]);

        $data = [
            'name' => $this->name,
            'label' => $this->label,
            'is_active' => $this->isActive,
        ];

        DB::beginTransaction();
        try {
            $this->gate->update($data);
            DB::commit();
            $this->reset(['name', 'label']);
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

}
