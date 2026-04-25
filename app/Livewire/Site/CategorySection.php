<?php

namespace App\Livewire\Site;

use App\Traits\SampleImages;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class CategorySection extends Component
{
    use SampleImages;

    public string $title;
    public $items;

    public function mount(string $title, Collection|array $items): void
    {
        $this->title = $title;
        $this->items = $items;
    }

    public function render(): View
    {
        return view('livewire.site.category-section', [
            'sampleImageUrl' => $this->getSampleImageUrl(),
        ]);
    }
}
