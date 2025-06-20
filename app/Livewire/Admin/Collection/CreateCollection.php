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
    public $categoryProducts;

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
                ->get();
        }

//        $categoryProducts = $this->categoryProducts ?? [];



        return $this->renderView(
            'livewire.admin.collection.create-collection',
//            compact('pageTitle', 'statuses', 'types', 'categories', 'categoryProducts')
            compact('pageTitle', 'statuses', 'types', 'categories')
        );
    }


    /**
     * @throws Throwable
     */
    public function store()
    {
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
            'limitation' => 'required|min:0'
        ]);

        $data = [
            'title' => $this->title,
            'type' => $this->type,
            'is_active' => $this->isActive,
            'limitation' => $this->limitation,
        ];

        DB::beginTransaction();
        try {
            Collection::create($data);
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
