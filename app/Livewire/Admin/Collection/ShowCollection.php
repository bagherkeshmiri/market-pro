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

class ShowCollection extends AdminComponent
{
    public object $collection;
    public $title;
    public $type;
    public $limitation;
    public $isActive;
    public $category;
    public $categoryProducts = [];
    public $selectedProducts = [];

    public function mount(Collection $collection): void
    {
        $this->title = $collection->title;
        $this->type = $collection->type;
        $this->limitation = $collection->limitation;
        $this->isActive = $collection->is_active;

        $this->selectedProducts = $collection->productCollection->load('product')
            ->map(fn($item) => [
                'id' => $item->product->id,
                'name' => $item->product->name,
            ])
            ->toArray();

    }

    public function render()
    {
        $pageTitle = 'ویرایش  کالکشن ' . $this->title;
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
                ->filter(fn($product) => !in_array($product->id, array_column((array)$this->selectedProducts, 'id')))
                ->values()
                ->toArray();
        } else {
            $this->categoryProducts = [];
        }

        $categoryProducts = $this->categoryProducts;
        $selectedCategory = $categories->search($this->category);
        $selectedProducts = $this->selectedProducts;

        return $this->renderView(
            'livewire.admin.collection.show-collection',
            compact('pageTitle', 'statuses', 'types', 'categories', 'categoryProducts', 'selectedCategory', 'selectedProducts')
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

    /**
     * @throws Throwable
     */
    public function update()
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
            $this->collection->update($data);

            $this->collection->productCollection()->delete();

            $i = 1;
            foreach ($this->selectedProducts as $selectedProduct) {
                $this->collection->productCollection()->create([
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
