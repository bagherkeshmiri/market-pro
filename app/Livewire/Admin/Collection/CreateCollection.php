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
    public $categoryProducts = [];
    public $selectedProducts = [];
    public $selectedCategories = [];


    public function mount(): void
    {
        $this->type = CollectionType::Product;
        $this->isActive = IsActive::No;


        $categories = Category::withoutTrashed()
            ->select([
                'id',
                'name',
            ])
            ->get();
    }

    public function updatedType(): void
    {
        $this->category = null;
        $this->categoryProducts = [];
        $this->selectedProducts = [];
        $this->selectedCategories = [];
    }

    public function render()
    {
        $pageTitle = 'ایجاد  کالکشن';
        $statuses = showEnumLabels(IsActive::class);
        $types = showEnumLabels(CollectionType::class);
        $categories = Category::withoutTrashed()
            ->select([
                'id',
                'name',
            ])
            ->get()


            ->mapWithKeys(fn($item) => [
                $item->name => $item->id,
            ]);

        if (!is_null($this->category)) {
            $this->categoryProducts = Product::whereCategoryId($this->category)
                ->select(['id', 'name'])
                ->get()
                ->filter(fn($product) => !in_array($product->id, array_column($this->selectedProducts, 'id')))
                ->values()
                ->toArray();
        } else {
            $this->categoryProducts = [];
        }

        $viewData = [
            'pageTitle' => $pageTitle,
            'statuses' => $statuses,
            'types' => $types,
            'categories' => $categories,
        ];

        if ($this->type == CollectionType::Product) {
            $viewData['categoryProducts'] = $this->categoryProducts;
            $viewData['selectedCategory'] = $categories->search($this->category);
            $viewData['selectedProducts'] = $this->selectedProducts;
        }

        if ($this->type == CollectionType::Category) {
            $viewData['selectedCategories'] = $this->selectedCategories;
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
            $this->categoryProducts = collect($this->categoryProducts)
                ->reject(fn($item) => $item['id'] == $productId)
                ->values()
                ->toArray();
        }
    }

    public function unselectProduct(int|string $productId, string $productName): void
    {
        $this->categoryProducts[] = ['id' => $productId, 'name' => $productName];
        $this->selectedProducts = collect($this->selectedProducts)
            ->reject(fn($item) => $item['id'] == $productId)
            ->values()
            ->toArray();
    }


    public function selectCategory(int|string $categoryId, string $categoryName): void
    {

//        dd(
//            $this->categories
//
//        );


        if (!in_array($categoryId, array_column($this->selectedCategories, 'id'))) {
            $this->selectedCategories[] = ['id' => $categoryId, 'name' => $categoryName];

//            $this->categories = $this->categories
//                ->reject(fn($item) => $item == $categoryId)
//                ->values()
//                ->toArray();
        }



        dd(
            $this->selectedCategories,
        );


    }

    public function unselectCategory(int|string $productId, string $productName): void
    {
        $this->categoryProducts[] = ['id' => $productId, 'name' => $productName];
        $this->selectedProducts = collect($this->selectedProducts)
            ->reject(fn($item) => $item['id'] == $productId)
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
        };

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
