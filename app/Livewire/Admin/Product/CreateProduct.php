<?php

namespace App\Livewire\Admin\Product;

use App\Enums\DiscountType;
use App\Enums\ProductStatus;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;
use Throwable;

class CreateProduct extends AdminComponent
{
    use WithFileUploads;

    public $name;
    public $categoryId;
    public $price;
    public $stock;
    public $status;
    public $discountType;
    public $discount;
    public $mainImage;
    public $galleryImages;
    public $longDescription;
    public $shortDescription;
    public $additionalInformation;

    public function mount(): void
    {
        $this->categoryId = Category::withoutTrashed()
            ->first()->id;

        $this->status = ProductStatus::NotExist;
        $this->discountType = DiscountType::Percent;
    }

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
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'categoryId' => 'required|exists:categories,id',
            'longDescription' => 'nullable|string|max:4294967295',
            'shortDescription' => 'nullable|string|max:65535',
            'additionalInformation' => 'nullable|string|max:5000',
            'stock' => 'required|integer',
            'status' => [
                'required',
                new Enum(ProductStatus::class)
            ],
            'discountType' => [
                'nullable',
                new Enum(DiscountType::class)
            ],
            'mainImage' => 'required|file|mimes:jpg,png,jpeg,webp|max:500', // TODO reduce image size and width and height
            'galleryImages' => 'nullable|array', // if array file has file|mimes:jpg,png,jpeg,webp|max:500 validation
        ]);

        $this->price = (int)str_replace(',', '', $this->price);
        $this->discount = (int)str_replace(',', '', $this->discount);

        $this->validate([
            'price' => 'required|integer|min:0',
            'discount' => 'required|integer',
        ]);

        $data = [
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'price' => $this->price,
            'stock' => $this->stock,
            'status' => $this->status,
            'discount_type' => $this->discountType,
            'discount' => $this->discount,
            'final_price' => calculateProductFinalPrice($this->discountType, $this->price, $this->discount),
            'long_description' => $this->longDescription ?? null,
            'short_description' => $this->shortDescription ?? null,
            'additional_information' => $this->additionalInformation ?? null,
        ];

        DB::beginTransaction();
        try {
            $storedProduct = Product::create($data);
            $storedProduct->images()->create([
                'url' => storeImage($this->mainImage, 'products'),
                'is_main' => true,
            ]);

            if (!empty($this->galleryImages)) {
                foreach ($this->galleryImages as $galleryImage) {
                    $storedProduct->images()->create([
                        'url' => storeImage($galleryImage, 'products'),
                        'is_main' => false,
                    ]);
                }
            }

            DB::commit();
            $this->reset(['name', 'price', 'stock', 'discount']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.product.index');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.product.create');
        }
    }
}
