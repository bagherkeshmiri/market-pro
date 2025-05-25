<?php

namespace App\Http\Controllers\admin;

use App\Enums\IsActive;
use App\Http\Controllers\Controller;
use App\Models\MainMenu;

class MainMenuController extends Controller
{
    public function delete(MainMenu $main_menu)
    {
        $main_menu->delete();
        return redirect()->route('admin.main_menu.index');
    }

    public function enable(MainMenu $main_menu)
    {
        $main_menu->update([
            'is_active' => IsActive::Yes,
        ]);
        return redirect()->route('admin.main_menu.index');
    }

    public function disable(MainMenu $main_menu)
    {
        $main_menu->update([
            'is_active' => IsActive::No,
        ]);
        return redirect()->route('admin.main_menu.index');
    }
}
