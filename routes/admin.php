<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\MainMenuController;
use App\Livewire\Admin\User\CreateUser;
use App\Livewire\Admin\User\ListUser;
use App\Livewire\Admin\User\ShowUser;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Category\CreateCategory;
use App\Livewire\Admin\Category\ListCategory;
use App\Livewire\Admin\Category\ShowCategory;
use App\Livewire\Admin\Dashboard\AdminDashboard;
use App\Livewire\Admin\Profile\ChangePassword;
use App\Livewire\Admin\Profile\ShowProfile;
use App\Livewire\Admin\Role\CreateRole;
use App\Livewire\Admin\Role\ListRole;
use App\Livewire\Admin\Role\ShowRole;
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
        Route::middleware('ValidAdmin')->get('/management', Login::class)->name('login');

        Route::controller(AuthController::class)->group(function () {
            Route::get('/logout', 'logout')->name('logout');
        });
    });

Route::prefix('dashboard')
    ->middleware('InvalidAdmin')
    ->group(function () {
        Route::get('/', AdminDashboard::class)->name('dashboard');

        Route::name('role.')->prefix('role')->group(function () {
            Route::get('/', ListRole::class)->name('index');
            Route::get('/create', CreateRole::class)->name('create');
            Route::get('/show/{role}', ShowRole::class)->name('show');
            Route::get('/delete/{role}', [RoleController::class, 'delete'])->name('delete');
        });

        Route::name('user.')
            ->prefix('users')
            ->group(function () {
                Route::get('/', ListUser::class)->name('index');
                Route::get('/create', CreateUser::class)->name('create');
                Route::get('/show/{admin}', ShowUser::class)->name('show');
                Route::get('/delete/{admin}', [AccountController::class, 'delete'])->name('delete');
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
                Route::get('/', ListCategory::class)->name('index');
                Route::get('/create', CreateCategory::class)->name('create');
                Route::get('/show/{category}', ShowCategory::class)->name('show');
                Route::get('/delete/{category}', [CategoryController::class, 'delete'])->name('delete');
            });

//        Route::name('menu.')
//            ->prefix('menu')
//            ->group(function () {
//                Route::get('/', ListMainMenu::class)->name('index');
//                Route::get('/create', CreateMainMenu::class)->name('create');
//                Route::get('/show/{main_menu}', ShowMainMenu::class)->name('show');
//                Route::get('/delete/{main_menu}', [MainMenuController::class, 'delete'])->name('delete');
//                Route::get('/enable/{main_menu}', [MainMenuController::class, 'enable'])->middleware('CheckEnablePermission')->name('enable');
//                Route::get('/disable/{main_menu}', [MainMenuController::class, 'disable'])->middleware('CheckDisablePermission')->name('disable');
//            });
    });
