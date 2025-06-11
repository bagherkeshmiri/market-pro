<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Throwable;

class ShowCategory extends AdminComponent
{
    public object $category;
    public $name;
    public $parentId;

    public function mount(Category $category): void
    {
        $this->name = $category->name;
        $this->parentId = $category->parent_id;
    }

    public function render()
    {
        $pageTitle = 'ویرایش دسته بندی';
        $allCategories = Category::where('id', '!=', $this->category->id)
            ->pluck('id', 'name')
            ->toArray();
        Arr::forget($allCategories, $this->category->title);
        return $this->renderView(
            'livewire.admin.category.show-category',
            [
                'pageTitle' => $pageTitle,
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
            'parentId' => 'nullable|exists:categories,id',
        ]);

        $data = [
            'name' => $this->name,
            'parent_id' => $this->parentId,
        ];

        DB::beginTransaction();
        try {
            $this->category->update($data);
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
