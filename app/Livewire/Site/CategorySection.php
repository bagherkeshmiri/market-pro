<?php

namespace App\Livewire\Site;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class CategorySection extends Component
{
    public string $title;
    public $items;
    public string $sampleImageUrl;

    public function mount(string $title, Collection|array $items, string $sampleImageUrl): void
    {
        $this->title = $title;
        $this->items = $items;
        $this->sampleImageUrl = $sampleImageUrl;
    }

    public function render(): View
    {
        return view('livewire.site.category-section');
    }
}
