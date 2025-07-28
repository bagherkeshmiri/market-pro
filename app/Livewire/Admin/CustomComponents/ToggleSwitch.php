<?php

namespace App\Livewire\Admin\CustomComponents;

use App\Enums\IsActive;
use Illuminate\View\View;
use Livewire\Component;

class ToggleSwitch extends Component
{
    public string $model;
    public bool|IsActive $value = false;

    public function mount(string $model, bool|IsActive $value = false): void
    {
        $this->model = $model;

        if ($value instanceof IsActive) {
            $this->value = $value == IsActive::Yes;
        } else {
            $this->value = $value;
        }
    }

    public function updatedValue(): void
    {
        $this->dispatch($this->model . '-updated', value: $this->value);
    }

    public function render(): View
    {
        return view('livewire.admin.custom-components.toggle-switch');
    }
}
