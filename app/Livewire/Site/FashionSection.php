<?php

namespace App\Livewire\Site;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class FashionSection extends Component
{
    public string $title;
    public $items;
    public string $sampleProductImageUrl;

    public function mount(string $title, Collection|array $items, string $sampleProductImageUrl): void
    {
        $this->title = $title;
        $this->items = $items;
        $this->sampleProductImageUrl = $sampleProductImageUrl;
    }

    public function render(): View
    {
        return view('livewire.site.fashion-section');
    }
}
