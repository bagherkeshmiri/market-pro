<?php

namespace App\Http\Livewire\Admin\MainMenu;

use App\Models\MainMenu;
use App\Repositories\MainMenu\MainMenuRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowMainMenu extends Component
{
    public object $main_menu;
    public $title;
    public $address;
    protected object $mainMenuRepository;

    public function boot(MainMenuRepositoryInterface $mainMenuRepo)
    {
        $this->mainMenuRepository = $mainMenuRepo;
    }

    public function mount(MainMenu $main_menu)
    {
        $this->title = $main_menu->key;
        $this->address = $main_menu->value;
    }

    public function render()
    {
        return view('livewire.admin.mainMenu.show-main-menu')->layout(
            'layouts.admin-layout'
        );
    }

    public function update()
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
            $this->main_menu->update($data);
            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.main_menu.show', ['main_menu' => $this->main_menu->id]);
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.main_menu.show', ['main_menu' => $this->main_menu->id]);
        }
    }
}
