<?php

namespace App\Livewire\Admin\Category;

use App\Enums\CategoryType;
use App\Jobs\DeleteImageJob;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;
use Throwable;

class ShowCategory extends AdminComponent
{
    use WithFileUploads;

    public Category $category;
    public $name;
    public $parentId;
    public $image;
    public $type;

    public function mount(): void
    {
        $this->name = $this->category->name;
        $this->parentId = $this->category->parent_id;
        $this->image = $this->category->image->url ?? null;
        $this->type = $this->category->type;
    }

    public function render(): View
    {
        $allCategories = Category::where('id', '!=', $this->category->id)
            ->pluck('id', 'name')
            ->toArray();

        Arr::forget($allCategories, $this->category->title);
        $types = showEnumLabels(CategoryType::class);
        return $this->renderView(
            'livewire.admin.category.show-category',
            'ویرایش دسته بندی',
            compact('allCategories','types')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'parentId' => 'nullable|exists:categories,id',
            'image' => $this->image instanceof TemporaryUploadedFile
                ? 'file|mimes:jpg,png,jpeg,webp|max:500' // TODO reduce image size and width and height
                : 'nullable',
            'type' => [
                'required',
                new Enum(CategoryType::class),
            ],
        ]);

        $data = [
            'name' => $this->name,
            'parent_id' => $this->parentId,
            'type' => $this->type,
        ];

        DB::beginTransaction();
        try {
            $this->category->update($data);

            if (!empty($this->image) and $this->image instanceof TemporaryUploadedFile) {
                $categoryImage = $this->category->image;
                if (!is_null($categoryImage)) {
                    DeleteImageJob::dispatch($categoryImage->url);
                    $categoryImage->delete();
                }

                $this->category->image()->create([
                    'url' => storeImage($this->image, 'categories'),
                    'is_main' => true,
                ]);
            }

            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.category.show', ['category' => $this->category->id]);
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.category.show', ['category' => $this->category->id]);
        }
    }
}
