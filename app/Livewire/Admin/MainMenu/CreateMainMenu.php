<?php

namespace App\Livewire\Admin\MainMenu;

use App\Livewire\BaseComponents\AdminComponent;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\MainMenu\MainMenuRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateMainMenu extends AdminComponent
{
    public $title;
    public $address;
    protected object $mainMenuRepository;

    public function boot(MainMenuRepositoryInterface $mainMenuRepo)
    {
        $this->mainMenuRepository = $mainMenuRepo;
    }

    public function render()
    {
        return $this->renderView('livewire.admin.mainMenu.create-main-menu');
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'address' => 'required',
        ]);
        $data = [
            'key' => $this->title,
            'value' => $this->address,
        ];
        DB::beginTransaction();
        try {
            $this->mainMenuRepository->create($data);
            DB::commit();
            $this->reset(['title', 'address']);
            session()->flash('success', __('global.success_message'));
            return redirect()->back();
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.main_menu.create');
        }
    }
}
