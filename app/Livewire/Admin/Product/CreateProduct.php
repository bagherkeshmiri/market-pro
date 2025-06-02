<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Throwable;

class CreateProduct extends AdminComponent
{
    use WithFileUploads;

    public $name;
    public $categoryId;
    public $description;
    public $price;
    public $stock;
    public $mainImage;
    public $galleryImages;

    public function render()
    {
        $pageTile = 'ایجاد محصول';
        $allCategories = Category::withoutTrashed()
            ->pluck('id', 'name')
            ->toArray();

        return $this->renderView(
            'livewire.admin.product.create-product',
            [
                'pageTitle' => $pageTile,
                'allCategories' => $allCategories,
            ],
        );
    }

    /**
     * @throws Throwable
     */
    public function store()
    {

        dd(
            $this
        );

        $this->validate([
            'name' => 'required',
            'categoryId' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|string',
            'stock' => 'required|integer',
        ]);

        $data = [
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'description' => $this->description ?? null,
            'price' => str_replace(',', '', $this->price),
            'stock' => $this->stock,
        ];

        DB::beginTransaction();
        try {
            Product::create($data);
            DB::commit();
            $this->reset(['name','description', 'price', 'stock']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.product.index');
        } catch (Exception $e) {
            DB::rollBack();

            dd(
                $e->getMessage()
            );

            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.product.create');
        }
    }
}
