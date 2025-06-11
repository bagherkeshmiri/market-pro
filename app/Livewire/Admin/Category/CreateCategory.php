<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateCategory extends AdminComponent
{
    public $name;
    public $parentId;

    public function render()
    {
        $pageTitle = 'ایجاد دسته بندی';
        $allCategories = Category::pluck('id', 'name')->toArray();
        return $this->renderView(
            'livewire.admin.category.create-category',
            [
                'pageTitle' => $pageTitle,
                'allCategories' => $allCategories,
            ],
        );
    }

    /**
     * @throws Throwable
     */
    public function store()
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
            Category::create($data);
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
