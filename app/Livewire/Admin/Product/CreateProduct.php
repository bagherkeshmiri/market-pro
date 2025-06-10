<?php

namespace App\Livewire\Admin\Product;

use App\Enums\ProductStatus;
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
                'statuses' => showEnumLabels(ProductStatus::class),
            ],
        );
    }

    /**
     * @throws Throwable
     */
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'categoryId' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|string',
            'mainImage' => 'required|file',
            'galleryImages' => 'nullable|array',
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
            $storedProduct = Product::create($data);
            $storedProduct->images()->create([
                'image_url' => storeImage($this->mainImage, 'products'),
                'is_main' => true,
            ]);

            if (!empty($this->galleryImages)) {
                foreach ($this->galleryImages as $galleryImage) {
                    $storedProduct->images()->create([
                        'image_url' => storeImage($galleryImage, 'products'),
                        'is_main' => false,
                    ]);
                }
            }

            DB::commit();
            $this->reset(['name', 'description', 'price', 'stock']);
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
