<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\MainMenuController;
use App\Http\Livewire\Admin\Account\CreateAccount;
use App\Http\Livewire\Admin\Account\ListAccount;
use App\Http\Livewire\Admin\Account\ShowAccount;
use App\Http\Livewire\Admin\Auth\Login;
use App\Http\Livewire\Admin\Category\CreateCategory;
use App\Http\Livewire\Admin\Category\ListCategory;
use App\Http\Livewire\Admin\Category\ShowCategory;
use App\Http\Livewire\Admin\Dashboard\AdminDashboard;
use App\Http\Livewire\Admin\MainMenu\CreateMainMenu;
use App\Http\Livewire\Admin\MainMenu\ListMainMenu;
use App\Http\Livewire\Admin\MainMenu\ShowMainMenu;
use App\Http\Livewire\Admin\Profile\ChangePassword;
use App\Http\Livewire\Admin\Profile\ShowProfile;
use App\Http\Livewire\Admin\Role\CreateRole;
use App\Http\Livewire\Admin\Role\ListRole;
use App\Http\Livewire\Admin\Role\ShowRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\AccountController;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')
    ->group(function () {
        Route::get('/management', Login::class)->name('login');

        Route::controller(AuthController::Class)->group(function () {
            Route::get('/logout', 'logout')->name('logout');
        });
    });

Route::prefix('dashboard')->group(function () {
    Route::get('/', AdminDashboard::Class)->name('dashboard');

    Route::name('role.')->prefix('role')->group(function () {
        Route::get('/', ListRole::class)->middleware('CheckListPermission')->name('index');
        Route::get('/create', CreateRole::class)->middleware('CheckCreatePermission')->name('create');
        Route::get('/show/{role}', ShowRole::class)->middleware('CheckEditPermission')->name('show');
        Route::get('/delete/{role}', [RoleController::class, 'delete'])->middleware('CheckDeletePermission')->name('delete');
    });

    Route::name('user.')
        ->prefix('users')
        ->group(function () {
            Route::get('/', ListAccount::class)->middleware('CheckListPermission')->name('index');
            Route::get('/create', CreateAccount::class)->middleware('CheckCreatePermission')->name('create');
            Route::get('/show/{admin}', ShowAccount::class)->middleware('CheckEditPermission')->name('show');
            Route::get('/delete/{admin}', [AccountController::class, 'delete'])->middleware('CheckDeletePermission')->name('delete');
        });

    Route::name('profile.')
        ->prefix('profile')
        ->group(function () {
            Route::get('/', ShowProfile::class)->name('index');
            Route::get('/changePass', ChangePassword::class)->name('change-password');
        });

    Route::name('category.')
        ->prefix('category')
        ->group(function () {
            Route::get('/', ListCategory::class)->middleware('CheckListPermission')->name('index');
            Route::get('/create', CreateCategory::class)->middleware('CheckCreatePermission')->name('create');
            Route::get('/show/{category}', ShowCategory::class)->middleware('CheckEditPermission')->name('show');
            Route::get('/delete/{category}', [CategoryController::class, 'delete'])->middleware('CheckDeletePermission')->name('delete');
        });

    Route::name('menu.')
        ->prefix('menu')
        ->group(function () {
            Route::get('/', ListMainMenu::class)->middleware('CheckListPermission')->name('index');
            Route::get('/create', CreateMainMenu::class)->middleware('CheckCreatePermission')->name('create');
            Route::get('/show/{main_menu}', ShowMainMenu::class)->middleware('CheckEditPermission')->name('show');
            Route::get('/delete/{main_menu}', [MainMenuController::class, 'delete'])->middleware('CheckDeletePermission')->name('delete');
            Route::get('/enable/{main_menu}', [MainMenuController::class, 'enable'])->middleware('CheckEnablePermission')->name('enable');
            Route::get('/disable/{main_menu}', [MainMenuController::class, 'disable'])->middleware('CheckDisablePermission')->name('disable');
        });
});
