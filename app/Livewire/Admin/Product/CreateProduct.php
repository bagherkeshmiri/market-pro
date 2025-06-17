<?php

namespace App\Livewire\Admin\Product;

use App\Enums\DiscountType;
use App\Enums\ProductStatus;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
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
    public $status;
    public $discountType;
    public $discount;
    public $mainImage;
    public $galleryImages;

    public function render()
    {
        $pageTitle = 'ایجاد محصول';
        $allCategories = Category::withoutTrashed()
            ->pluck('id', 'name')
            ->toArray();
        $statuses = showEnumLabels(ProductStatus::class);
        $discountTypes = showEnumLabels(DiscountType::class);
        return $this->renderView(
            'livewire.admin.product.create-product',
            compact('pageTitle', 'allCategories', 'statuses', 'discountTypes')
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
            'stock' => 'required|integer',
            'status' => [
                'required',
                new Enum(ProductStatus::class)
            ],
            'discountType' => [
                'nullable',
                new Enum(DiscountType::class)
            ],
            'discount' => 'nullable|integer',
            'mainImage' => 'required|file|mimes:jpg,png,jpeg,webp|max:500', // TODO reduce image size and width and height
            'galleryImages' => 'nullable|array', // if array file has file|mimes:jpg,png,jpeg,webp|max:500 validation
        ]);

        $data = [
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'description' => $this->description ?? null,
            'price' => (int)str_replace(',', '', $this->price),
            'stock' => $this->stock,
            'status' => $this->status,
            'discount_type' => $this->discountType,
            'discount' => $this->discount,
            'final_price' => calculateProductFinalPrice($this->discountType, str_replace(',', '', $this->price), str_replace(',', '', $this->discount)),
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
            $this->reset(['name', 'description', 'price', 'stock', 'discount']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.product.index');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.product.create');
        }
    }
}
