<?php

namespace App\Livewire\Admin\Category;

use App\Enums\CategoryType;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;
use Throwable;

class CreateCategory extends AdminComponent
{
    use WithFileUploads;

    public $name;
    public $parentId;
    public $image;
    public $type;

    public function render(): View
    {
        $pageTitle = 'ایجاد دسته بندی';
        $allCategories = Category::pluck('id', 'name')->toArray();
        $types = showEnumLabels(CategoryType::class);
        return $this->renderView(
            'livewire.admin.category.create-category',
            $pageTitle,
            compact('allCategories','types')
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
            'image' => 'nullable|file|mimes:jpg,png,jpeg,webp|max:500', // TODO reduce image size and width and height
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
            $createdCategory = Category::create($data);

            if (!is_null($this->image)) {
                $createdCategory->image()->create([
                    'url' => storeImage($this->image, 'categories'),
                    'is_main' => true,
                ]);
            }

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
