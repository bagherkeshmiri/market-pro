<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\BaseComponents\AdminComponent;
use App\Repositories\Category\CategoryRepositoryInterface;
use Livewire\WithPagination;

class ListCategory extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected object $categoryRepository;

    public function boot(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    public function render()
    {
        $categories = $this->categoryRepository->paginate();
        return $this->renderView('livewire.admin.category.list-category', ['categories' => $categories]);
    }
}
