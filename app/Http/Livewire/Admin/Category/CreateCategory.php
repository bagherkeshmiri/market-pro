<?php

namespace App\Http\Livewire\Admin\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateCategory extends Component
{
    public $title;
    public $seoTitle;
    public $parentId;
    public $description;
    public $enTitle;
    public $slug;
    public $type = [];
    protected object $categoryRepository;

    public function boot(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    public function render()
    {
        $allCategories = $this->categoryRepository->all()->pluck('id', 'title')->toArray();
        return view(
            'livewire.admin.category.create-category',
            [
                'allCategories' => $allCategories,
                'categoryType' => $this->categoryRepository->getModel()->getCategoryTypeList(),
            ],
        )->layout('layouts.admin-layout');
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'seoTitle' => 'required',
            'type' => 'required|numeric',
            'enTitle' => 'required',
        ]);
        $data = [
            'title' => $this->title,
            'parent_id' => $this->parentId,
            'description' => $this->description,
            'seo_title' => $this->seoTitle,
            'type' => $this->type,
            'en_title' => $this->enTitle,
            'slug' => makeSlug($this->enTitle),
        ];
        DB::beginTransaction();
        try {
            $this->categoryRepository->create($data);
            DB::commit();
            $this->reset(['title', 'seoTitle', 'type', 'description']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.category.index');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.category.create');
        }
    }
}
