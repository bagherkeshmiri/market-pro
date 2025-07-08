<?php

namespace App\Livewire\Admin\MainMenu;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;

class ListMainMenu extends AdminComponent
{
    public IsActive $active = IsActive::Yes;

    public function render()
    {
        $pageTitle = 'لیست منو ';
        $Menus = $this->mainMenuRepository->paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.mainMenu.list-main-menu',
            compact('pageTitle', 'Menus')
        );
    }
}
