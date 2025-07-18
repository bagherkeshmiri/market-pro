<?php

namespace App\Livewire\Admin\Product;

use App\Enums\DiscountType;
use App\Enums\ProductStatus;
use App\Jobs\DeleteImageJob;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;
use Throwable;

class ShowProduct extends AdminComponent
{
    use WithFileUploads;

    public object $product;
    public $name;
    public $categoryId;
    public $price;
    public $stock;
    public $status;
    public $discountType;
    public $discount;
    public $finalPrice;
    public $mainImage;
    public $galleryImages;
    public $longDescription;
    public $shortDescription;
    public $additionalInformation;

    public function mount(Product $product): void
    {
        $this->name = $product->name;
        $this->categoryId = $product->category_id;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->discountType = $product->discount_type;
        $this->discount = $product->discount;
        $this->finalPrice = $product->final_price;
        $this->mainImage = $product->mainImage->url ?? '';
        $this->galleryImages = $product->galleryImages;
        $this->longDescription = $product->long_description;
        $this->shortDescription = $product->short_description;
        $this->additionalInformation = $product->additional_information;
    }

    public function render(): View
    {
        $pageTitle = 'ویرایش  محصول';
        $allCategories = Category::pluck('id', 'name')
            ->toArray();
        $statuses = showEnumLabels(ProductStatus::class);
        $discountTypes = showEnumLabels(DiscountType::class);
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        return $this->renderView(
            'livewire.admin.product.show-product',
            $pageTitle,
            compact('allCategories', 'statuses', 'discountTypes', 'sampleProductImageUrl')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
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
            'mainImage' => $this->mainImage instanceof TemporaryUploadedFile
                ? 'file|mimes:jpg,png,jpeg,webp|max:500' // TODO reduce image size and width and height
                : 'nullable',
            'galleryImages' => 'nullable|array', // TODO if array file has file|mimes:jpg,png,jpeg,webp|max:500 validation
        ]);

        $this->price = (int)str_replace(',', '', $this->price);
        $this->discount = (int)str_replace(',', '', $this->discount);

        $this->validate([
            'price' => 'required|integer|min:0',
            'discount' => 'required|integer',
        ]);

        if ($this->status == ProductStatus::Exist && $this->stock <= 0) {
            session()->flash('warning', 'امکان ثبت محصول موجود با موجودی صفر وجود ندارد');
            return redirect()->route('admin.product.show', ['product' => $this->product->id]);
        }

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
            $this->product->update($data);

            if (!empty($this->mainImage) and $this->mainImage instanceof TemporaryUploadedFile) {
                $productImage = $this->product->mainImage;
                if (!is_null($productImage)) {
                    DeleteImageJob::dispatch($productImage->url);
                    $productImage->delete();
                }

                $this->product->images()->create([
                    'url' => storeImage($this->mainImage, 'products'),
                    'is_main' => true,
                ]);
            }

            if (!empty($this->galleryImages) and is_array($this->galleryImages)) {
//                DeleteImageJob::dispatch($address); // TODO
                $this->product->galleryImages->delete(); // TODO check delete galley images successfully

                foreach ($this->galleryImages as $galleryImage) {
                    $this->product->images()->create([
                        'url' => storeImage($galleryImage, 'products'),
                        'is_main' => false,
                    ]);
                }
            }
            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.product.show', ['product' => $this->product->id]);
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.product.show', ['product' => $this->product->id]);
        }
    }
}
