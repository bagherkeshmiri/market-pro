<?php

namespace App\Http\Livewire\Admin\MainMenu;

use App\Enums\IsActive;
use App\Repositories\MainMenu\MainMenuRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class ListMainMenu extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected object $mainMenuRepository;
    public IsActive $active = IsActive::Yes;

    public function boot(MainMenuRepositoryInterface $mainMenuRepo)
    {
        $this->mainMenuRepository = $mainMenuRepo;
    }

    public function render()
    {
        $allmainMenus = $this->mainMenuRepository->paginate();
        return view('livewire.admin.mainMenu.list-main-menu', ['allmainMenus' => $allmainMenus])->layout('layouts.admin-layout');
    }
}
