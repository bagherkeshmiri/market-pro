<?php

namespace App\Livewire\Admin\Collection;

use App\Enums\CollectionType;
use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Traits\Collection\CollectionValidation;
use App\Traits\Collection\HandlesCollectionItemsSelection;
use App\Traits\Collection\HandlesCollectionRelations;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class CreateCollection extends AdminComponent
{
    use HandlesCollectionRelations;
    use HandlesCollectionItemsSelection;
    use CollectionValidation;

    public $title;
    public $type;
    public $limitation;
    public $sort;
    public $isActive;
    public $category;
    public $unselectedProducts = [];
    public $selectedProducts = [];
    public $selectedCategories = [];
    public $unselectedCategories = [];
    public $categories = [];

    public function mount(): void
    {
        $this->type = CollectionType::Product;
        $this->isActive = IsActive::No;
        $this->categories = Category::withoutTrashed()
            ->select([
                'id',
                'name',
            ])
            ->get();
    }

    public function updatedType(): void
    {
        $this->category = null;
        $this->unselectedProducts = [];
        $this->selectedProducts = [];
        $this->selectedCategories = [];
        $this->unselectedCategories = $this->categories->values()
            ->toArray();
    }

    public function render(): View
    {
        $statuses = showEnumLabels(IsActive::class);
        $types = showEnumLabels(CollectionType::class);
        $selectBoxCategories = $this->categories->mapWithKeys(fn($item) => [
            $item->name => $item->id,
        ]);

        if (!is_null($this->category)) {
            $this->unselectedProducts = Product::where('category_id',$this->category)
                ->select(['id', 'name'])
                ->get()
                ->filter(fn($product) => !in_array($product->id, array_column($this->selectedProducts, 'id')))
                ->values()
                ->toArray();
        } else {
            $this->unselectedProducts = [];
        }

        $viewData = [
            'statuses' => $statuses,
            'types' => $types,
            'selectBoxCategories' => $selectBoxCategories,
        ];

        if ($this->type == CollectionType::Product) {
            $viewData['unselectedProducts'] = $this->unselectedProducts;
            $viewData['selectedCategory'] = $selectBoxCategories->search($this->category);
            $viewData['selectedProducts'] = $this->selectedProducts;
        }

        if ($this->type == CollectionType::Category) {
            $viewData['selectedCategories'] = $this->selectedCategories;
            $viewData['unselectedCategories'] = $this->unselectedCategories;
        }

        return $this->renderView(
            'livewire.admin.collection.create-collection',
            'ایجاد  کالکشن',
            $viewData
        );
    }

    public function selectProduct(int|string $productId, string $productName): void
    {
        $this->selectItem($productId, $productName, 'selectedProducts', 'unselectedProducts');
    }

    public function unselectProduct(int|string $productId, string $productName): void
    {
        $this->unselectItem($productId, $productName, 'selectedProducts', 'unselectedProducts');
    }

    public function selectCategory(int|string $categoryId, string $categoryName): void
    {
        $this->selectItem($categoryId, $categoryName, 'selectedCategories', 'unselectedCategories');
    }

    public function unselectCategory(int|string $categoryId, string $categoryName): void
    {
        $this->unselectItem($categoryId, $categoryName, 'selectedCategories', 'unselectedCategories');
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        if ($redirect = $this->validateCollectionSelection()) {
            return $redirect;
        }

        $this->validate([
            'title' => 'required',
            'type' => [
                'required',
                new Enum(CollectionType::class),
            ],
            'isActive' => [
                'required',
                new Enum(IsActive::class),
            ],
            'limitation' => 'required|min:0|max:20'
        ]);

        $data = [
            'title' => $this->title,
            'type' => $this->type,
            'is_active' => $this->isActive,
            'limitation' => $this->limitation,
        ];

        DB::beginTransaction();
        try {
            $createdCollection = Collection::create($data);
            $this->attachItemsToCollection($createdCollection);

            DB::commit();
            $this->reset(['title', 'limitation']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.collection.index');
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.collection.create');
        }
    }
}
