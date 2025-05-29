<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ShowCategory extends AdminComponent
{
    public object $category;
    public $title;
    public $parentId;
    public $type;
    public $description;
    public $seoTitle;
    public $enTitle;
    public $slug;
    protected object $categoryRepository;

    public function boot(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    public function mount(Category $category)
    {
        $this->title = $category->title;
        $this->parentId = $category->parent_id;
        $this->type = $category->type;
        $this->description = $category->description;
        $this->seoTitle = $category->seo_title;
        $this->enTitle = $category->en_title;
        $this->slug = $category->slug;
    }

    public function render()
    {
        $allCategories = $this->categoryRepository->all()->pluck('id', 'title')->toArray();
        Arr::forget($allCategories, $this->category->title);
        return $this->renderView('livewire.admin.category.show-category', [
            'allCategories' => $allCategories,
            'categoryType' => $this->categoryRepository->getModel()->getCategoryTypeList(),
        ]);
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'seoTitle' => 'required',
            'type' => 'required',
            'enTitle' => 'required',
        ]);

        $data = [
            'title' => $this->title,
            'parent_id' => ($this->parentId == 0) ? null : $this->parentId,
            'description' => $this->description,
            'seo_title' => $this->seoTitle,
            'type' => $this->type,
            'en_title' => $this->enTitle,
            'slug' => makeSlug($this->enTitle),
        ];

        DB::beginTransaction();
        try {
            $this->category->update($data);
            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.category.index');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.category.create');
        }
    }
}
