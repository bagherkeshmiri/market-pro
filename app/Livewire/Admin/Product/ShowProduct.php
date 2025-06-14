<?php

namespace App\Livewire\Admin\Product;

use App\Enums\ProductStatus;
use App\Jobs\DeleteImageJob;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
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
    public $status;
    public $mainImage;
    public $galleryImages;


    public function mount(Product $product): void
    {
        $this->name = $product->name;
        $this->categoryId = $product->category_id;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->mainImage = $product->images->where('is_main', true)->first()->image_url ?? '';
        $this->galleryImages = $product->images->where('is_main', false);
    }

    public function render()
    {
        $pageTitle = 'ویرایش  محصول';
        $allCategories = Category::pluck('id', 'name')
            ->toArray();
        return $this->renderView(
            'livewire.admin.product.show-product',
            [
                'pageTitle' => $pageTitle,
                'allCategories' => $allCategories,
                'statuses' => showEnumLabels(ProductStatus::class),
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
            'stock' => 'required|integer',
            'status' => [
                'required',
                new Enum(ProductStatus::class)
            ],
            'mainImage' => $this->mainImage instanceof TemporaryUploadedFile
                ? 'file|mimes:jpg,png,jpeg,webp|max:500' // TODO reduce image size and width and height
                : 'nullable',
            'galleryImages' => 'nullable|array', // if array file has file|mimes:jpg,png,jpeg,webp|max:500 validation
        ]);

        $data = [
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'description' => $this->description ?? null,
            'price' => str_replace(',', '', $this->price),
            'stock' => $this->stock,
            'status' => $this->status,
        ];

        DB::beginTransaction();
        try {
            $this->product->update($data);

            if (!empty($this->mainImage) and $this->mainImage instanceof TemporaryUploadedFile) {
                $productImage = $this->product->images()->where('is_main', true)->first();
                if (!is_null($productImage)) {
                    DeleteImageJob::dispatch($productImage->image_url);
                    $productImage->delete();
                }

                $this->product->images()->create([
                    'image_url' => storeImage($this->mainImage, 'products'),
                    'is_main' => true,
                ]);
            }

            if (!empty($this->galleryImages) and is_array($this->galleryImages)) {
//                DeleteImageJob::dispatch($address); // TODO
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
            return redirect()->route('admin.product.show', ['product' => $this->product->id]);
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
