<?php

namespace App\Livewire\Admin\Category;

use App\Jobs\DeleteImageJob;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;
use Throwable;

class ShowCategory extends AdminComponent
{
    use WithFileUploads;

    public object $category;
    public $name;
    public $parentId;
    public $image;

    public function mount(Category $category): void
    {
        $this->name = $category->name;
        $this->parentId = $category->parent_id;
        $this->image = $category->image->url ?? null;
    }

    public function render()
    {
        $pageTitle = 'ویرایش دسته بندی';
        $sampleProductImageUrl = $this->sampleProductImageUrl;
        $allCategories = Category::where('id', '!=', $this->category->id)
            ->pluck('id', 'name')
            ->toArray();
        Arr::forget($allCategories, $this->category->title);
        return $this->renderView(
            'livewire.admin.category.show-category',
            compact('pageTitle', 'sampleProductImageUrl', 'allCategories')
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
        ]);

        $data = [
            'name' => $this->name,
            'parent_id' => $this->parentId,
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
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.category.create');
        }
    }
}
