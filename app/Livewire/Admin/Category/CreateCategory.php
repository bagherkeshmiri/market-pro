<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;
use Throwable;

class CreateCategory extends AdminComponent
{
    use WithFileUploads;

    public $name;
    public $parentId;
    public $image;

    public function render()
    {
        $pageTitle = 'ایجاد دسته بندی';
        $allCategories = Category::pluck('id', 'name')->toArray();
        return $this->renderView(
            'livewire.admin.category.create-category',
            compact('pageTitle', 'allCategories')
        );
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'parentId' => 'nullable|exists:categories,id',
            'image' => 'sometimes|file|mimes:jpg,png,jpeg,webp|max:500', // TODO reduce image size and width and height
        ]);

        $data = [
            'name' => $this->name,
            'parent_id' => $this->parentId,
        ];
        DB::beginTransaction();
        try {
            $createdCategory = Category::create($data);
            $createdCategory->image()->create([
                'url' => storeImage($this->image, 'categories'),
                'is_main' => true,
            ]);
            DB::commit();
            $this->reset(['name']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.category.index');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.category.create');
        }
    }
}
