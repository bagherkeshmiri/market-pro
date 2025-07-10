<?php

namespace App\Livewire\Site;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ProductComments extends Component
{
    use WithPagination;

    public $productId;

    public function mount($productId): void
    {
        $this->productId = $productId;
    }

    public function render(): View
    {
        $product = Product::findOrFail($this->productId);
        $comments = $product->comments()->latest()->paginate(3);
        return view(
            'livewire.site.product-comments',
            compact('comments')
        );
    }
}
