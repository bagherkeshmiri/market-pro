<?php

namespace App\Livewire\Admin\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategory extends Component
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
        return view('livewire.admin.category.list-category', ['categories' => $categories])->layout('layouts.admin-layout');
    }
}
