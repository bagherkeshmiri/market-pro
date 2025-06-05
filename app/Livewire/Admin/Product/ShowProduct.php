<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Throwable;

class ShowProduct extends AdminComponent
{
    use WithFileUploads;

    public object $product;
    public $name;
    public $categoryId;
    public $description;
    public $price;
    public $stock;
    public $mainImage;
    public $galleryImages;


    public function mount(Product $product): void
    {
        $this->name = $product->name;
        $this->categoryId = $product->category_id;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->mainImage = $product->images->where('is_main',true)->first()->image_url ?? '';
        $this->galleryImages = $product->images->where('is_main',false);
    }

    public function render()
    {
        $pageTile = 'ویرایش  محصول';
        $allCategories = Category::pluck('id', 'name')
            ->toArray();
        return $this->renderView(
            'livewire.admin.product.show-product',
            [
                'pageTitle' => $pageTile,
                'allCategories' => $allCategories,
            ]
        );
    }

    /**
     * @throws Throwable
     */
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'categoryId' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|string',
            'mainImage' => 'nullable|file',
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
            $this->product->update($data);

            if (!empty($this->mainImage)) {
                $this->product->images()->where('is_main', true)->delete();
                $this->product->images()->create([
                    'image_url' => storeImage($this->mainImage, 'products'),
                    'is_main' => true,
                ]);
            }

            if (!empty($this->galleryImages)) {
                $this->product->images()->where('is_main', false)->delete();

                foreach ($this->galleryImages as $galleryImage) {
                    $this->product->images()->create([
                        'image_url' => storeImage($galleryImage, 'products'),
                        'is_main' => false,
                    ]);
                }
            }

            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.product.show',[ 'product' => $this->product->id ]);
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.product.create');
        }
    }
}
