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

class ShowCollection extends AdminComponent
{
    use HandlesCollectionRelations;
    use HandlesCollectionItemsSelection;
    use CollectionValidation;

    public object $collection;
    public $title;
    public $type;
    public $limitation;
    public $isActive;
    public $category;
    public $unselectedProducts = [];
    public $selectedProducts = [];
    public $selectedCategories = [];
    public $unselectedCategories = [];
    public $categories = [];

    public function mount(Collection $collection): void
    {
        $this->title = $collection->title;
        $this->type = $collection->type;
        $this->limitation = $collection->limitation;
        $this->isActive = $collection->is_active;
        $this->categories = Category::withoutTrashed()
            ->select([
                'id',
                'name',
            ])
            ->get();

        if ($this->type == CollectionType::Product) {
            $this->selectedProducts = $collection->productCollection->load('product')
                ->map(fn($item) => [
                    'id' => $item->product->id,
                    'name' => $item->product->name,
                ])
                ->toArray();
        }


        if ($this->type == CollectionType::Category) {
            $this->selectedCategories = $collection->categoryCollection->load('category')
                ->map(fn($item) => [
                    'id' => $item->category->id,
                    'name' => $item->category->name,
                ])
                ->toArray();

            $this->unselectedCategories = $this->categories->whereNotIn('id', collect($this->selectedCategories)->pluck('id'))
                ->map(fn($item) => [
                    'id' => $item->id,
                    'name' => $item->name,
                ])
                ->toArray();
        }
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
        $pageTitle = 'ویرایش  کالکشن ' . $this->title;
        $statuses = showEnumLabels(IsActive::class);
        $types = showEnumLabels(CollectionType::class);
        $selectBoxCategories = $this->categories->mapWithKeys(fn($item) => [
            $item->name => $item->id,
        ]);

        if (!is_null($this->category)) {
            $this->unselectedProducts = Product::whereCategoryId($this->category)
                ->select(['id', 'name'])
                ->get()
                ->filter(fn($product) => !in_array($product->id, array_column((array)$this->selectedProducts, 'id')))
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
            'livewire.admin.collection.show-collection',
            $pageTitle,
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
    public function update(): RedirectResponse|Redirector
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
            if ($this->collection->type != $this->type) {
                match ($this->collection->type) {
                    CollectionType::Product => $this->collection->productCollection()->delete(),
                    CollectionType::Category => $this->collection->categoryCollection()->delete(),
                };
            }

            $this->collection->update($data);
            $this->syncItemsToCollection($this->collection);

            DB::commit();
            $this->reset(['title', 'limitation']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.collection.index');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.collection.create');
        }
    }
}
