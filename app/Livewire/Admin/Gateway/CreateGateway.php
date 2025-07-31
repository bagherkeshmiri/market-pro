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
    public $isActive;

    public function mount(): void
    {
        $this->isActive = IsActive::No;
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
            Gate::create($data);
            DB::commit();
            $this->reset(['name']);
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
