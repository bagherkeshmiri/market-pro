<?php

namespace App\Livewire\Admin\MainMenu;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Repositories\MainMenu\MainMenuRepositoryInterface;
use Livewire\WithPagination;

class ListMainMenu extends AdminComponent
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
        $allmainMenus = $this->mainMenuRepository->paginate($this->perPage);
        return $this->renderView('livewire.admin.mainMenu.list-main-menu', ['allmainMenus' => $allmainMenus]);
    }
}
