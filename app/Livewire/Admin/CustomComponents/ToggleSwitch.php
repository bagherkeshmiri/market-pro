<?php

namespace App\Livewire\Admin\CustomComponents;

use Illuminate\View\View;
use Livewire\Component;

class ToggleSwitch extends Component
{
    public string $model;
    public bool $value = false;

    public function mount(string $model, bool $value = false): void
    {
        $this->model = $model;
        $this->value = $value;
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
