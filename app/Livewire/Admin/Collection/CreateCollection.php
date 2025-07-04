<?php

namespace App\Livewire\Admin\Collection;

use App\Enums\CollectionType;
use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Throwable;

class CreateCollection extends AdminComponent
{
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

    public function render()
    {
        $pageTitle = 'ایجاد  کالکشن';
        $statuses = showEnumLabels(IsActive::class);
        $types = showEnumLabels(CollectionType::class);
        $selectBoxCategories = $this->categories->mapWithKeys(fn($item) => [
            $item->name => $item->id,
        ]);

        if (!is_null($this->category)) {
            $this->unselectedProducts = Product::whereCategoryId($this->category)
                ->select(['id', 'name'])
                ->get()
                ->filter(fn($product) => !in_array($product->id, array_column($this->selectedProducts, 'id')))
                ->values()
                ->toArray();
        } else {
            $this->unselectedProducts = [];
        }

        $viewData = [
            'pageTitle' => $pageTitle,
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
            $viewData
        );
    }

    public function selectProduct(int|string $productId, string $productName): void
    {
        if (!in_array($productId, array_column($this->selectedProducts, 'id'))) {
            $this->selectedProducts[] = ['id' => $productId, 'name' => $productName];
            $this->unselectedProducts = collect($this->unselectedProducts)
                ->reject(fn($item) => $item['id'] == $productId)
                ->values()
                ->toArray();
        }
    }

    public function unselectProduct(int|string $productId, string $productName): void
    {
        $this->unselectedProducts[] = ['id' => $productId, 'name' => $productName];
        $this->selectedProducts = collect($this->selectedProducts)
            ->reject(fn($item) => $item['id'] == $productId)
            ->values()
            ->toArray();
    }


    public function selectCategory(int|string $categoryId, string $categoryName): void
    {
        if (!in_array($categoryId, array_column($this->selectedCategories, 'id'))) {
            $this->selectedCategories[] = ['id' => $categoryId, 'name' => $categoryName];

            $this->unselectedCategories = collect($this->unselectedCategories)
                ->reject(fn($item) => $item['id'] == $categoryId)
                ->values()
                ->toArray();
        }
    }

    public function unselectCategory(int|string $categoryId, string $categoryName): void
    {
        $this->unselectedCategories[] = ['id' => $categoryId, 'name' => $categoryName];
        $this->selectedCategories = collect($this->selectedCategories)
            ->reject(fn($item) => $item['id'] == $categoryId)
            ->values()
            ->toArray();
    }

    /**
     * @throws Throwable
     */
    public function store()
    {
        if (count($this->selectedProducts) > $this->limitation) {
            session()->flash('error', 'تعداد محصولات انتخاب شده نباید بیشتر از 20 عدد باشد');
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

            $i = 1;
            foreach ($this->selectedProducts as $selectedProduct) {
                $createdCollection->productCollection()->create([
                    'product_id' => $selectedProduct['id'],
                    'sort' => $i,
                ]);
                $i++;
            }

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
