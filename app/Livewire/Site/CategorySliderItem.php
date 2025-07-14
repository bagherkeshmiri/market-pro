<?php

namespace App\Livewire\Site;

use App\Models\Category;
use Illuminate\View\View;
use Livewire\Component;

class CategorySliderItem extends Component
{
    public string $title;
    public Category $category;
    public string $sampleProductImageUrl;

    public function mount(string $title, Category $category, string $sampleProductImageUrl): void
    {
        $this->title = $title;
        $this->category = $category;
        $this->sampleProductImageUrl = $sampleProductImageUrl;
    }

    public function render(): View
    {
        return view('livewire.site.category-slider-item');
    }
}
