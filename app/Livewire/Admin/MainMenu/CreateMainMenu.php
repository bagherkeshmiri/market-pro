<?php

namespace App\Livewire\Admin\MainMenu;

use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\MainMenu\MainMenuRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateMainMenu extends Component
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
        return view('livewire.admin.mainMenu.create-main-menu')->layout(
            'layouts.admin-layout'
        );
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
