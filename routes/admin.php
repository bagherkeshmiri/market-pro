<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Livewire\Admin\Admin\CreateAdmin;
use App\Livewire\Admin\Admin\ListAdmin;
use App\Livewire\Admin\Admin\ShowAdmin;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Category\CreateCategory;
use App\Livewire\Admin\Category\ListCategory;
use App\Livewire\Admin\Category\ShowCategory;
use App\Livewire\Admin\Collection\CreateCollection;
use App\Livewire\Admin\Collection\ListCollection;
use App\Livewire\Admin\Collection\ShowCollection;
use App\Livewire\Admin\Comment\ListComment;
use App\Livewire\Admin\Dashboard\AdminDashboard;
use App\Livewire\Admin\DiscountCode\CreateDiscountCode;
use App\Livewire\Admin\DiscountCode\ListDiscountCode;
use App\Livewire\Admin\DiscountCode\ShowDiscountCode;
use App\Livewire\Admin\Faq\CreateFaq;
use App\Livewire\Admin\Faq\ListFaq;
use App\Livewire\Admin\Faq\ShowFaq;
use App\Livewire\Admin\Gateway\CreateGateway;
use App\Livewire\Admin\Gateway\ListGateway;
use App\Livewire\Admin\Gateway\ShowGateway;
use App\Livewire\Admin\Order\ListAllOrder;
use App\Livewire\Admin\Order\ListTodayOrder;
use App\Livewire\Admin\Payment\ListAllPayment;
use App\Livewire\Admin\Payment\ListTodayPayment;
use App\Livewire\Admin\Post\CreatePost;
use App\Livewire\Admin\Post\ListPost;
use App\Livewire\Admin\Post\ShowPost;
use App\Livewire\Admin\Product\CreateProduct;
use App\Livewire\Admin\Product\ListProduct;
use App\Livewire\Admin\Product\ShowProduct;
use App\Livewire\Admin\Profile\ChangePassword;
use App\Livewire\Admin\Profile\ShowProfile;
use App\Livewire\Admin\Role\CreateRole;
use App\Livewire\Admin\Role\ListRole;
use App\Livewire\Admin\Role\ShowRole;
use App\Livewire\Admin\User\ListUser;
use App\Livewire\Admin\User\ShowUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')
    ->group(function () {
        Route::middleware('redirectIfAdminAuthenticated')
            ->get('/management', Login::class)
            ->name('login');

        Route::controller(AuthController::class)
            ->group(function () {
                Route::get('/logout', 'logout')
                    ->name('logout');
            });
    });

Route::prefix('dashboard')
    ->middleware([
        'auth:admin',
    ])
    ->group(function () {
        Route::get('/', AdminDashboard::class)->name('dashboard');

        Route::name('role.')->prefix('role')->group(function () {
            Route::get('/', ListRole::class)->name('index');
            Route::get('/create', CreateRole::class)->name('create');
            Route::get('/show/{role}', ShowRole::class)->name('show');
            Route::get('/delete/{role}', [RoleController::class, 'delete'])->name('delete');
        });

        Route::name('admin.')
            ->prefix('admin')
            ->group(function () {
                Route::get('/', ListAdmin::class)->name('index');
                Route::get('/create', CreateAdmin::class)->name('create');
                Route::get('/show/{admin}', ShowAdmin::class)->name('show');
                Route::get('/delete/{admin}', [AdminController::class, 'delete'])->name('delete');
            });


        Route::name('user.')
            ->prefix('user')
            ->group(function () {
                Route::get('/', ListUser::class)->name('index');
                Route::get('/show/{user}', ShowUser::class)->name('show');
                Route::get('/delete/{user}', [UserController::class, 'delete'])->name('delete');
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


        Route::name('product.')
            ->prefix('product')
            ->group(function () {
                Route::get('/', ListProduct::class)->name('index');
                Route::get('/create', CreateProduct::class)->name('create');
                Route::get('/show/{product}', ShowProduct::class)->name('show');
                Route::get('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
            });


        Route::name('collection.')
            ->prefix('collection')
            ->group(function () {
                Route::get('/', ListCollection::class)->name('index');
                Route::get('/create', CreateCollection::class)->name('create');
                Route::get('/show/{collection}', ShowCollection::class)->name('show');
            });


        Route::name('comment.')
            ->prefix('comment')
            ->group(function () {
                Route::get('/', ListComment::class)->name('index');
            });


        Route::name('faq.')
            ->prefix('faq')
            ->group(function () {
                Route::get('/', ListFaq::class)->name('index');
                Route::get('/create', CreateFaq::class)->name('create');
                Route::get('/show/{faq}', ShowFaq::class)->name('show');
            });


        Route::name('post.')
            ->prefix('post')
            ->group(function () {
                Route::get('/', ListPost::class)->name('index');
                Route::get('/create', CreatePost::class)->name('create');
                Route::get('/show/{post}', ShowPost::class)->name('show');
            });


        Route::name('gateway.')
            ->prefix('gateway')
            ->group(function () {
                Route::get('/', ListGateway::class)->name('index');
                Route::get('/create', CreateGateway::class)->name('create');
                Route::get('/show/{gate}', ShowGateway::class)->name('show');
            });


        Route::name('order.')
            ->prefix('order')
            ->group(function () {
                Route::get('/today', ListTodayOrder::class)->name('index-today');
                Route::get('/all', ListAllOrder::class)->name('index-all');
            });


        Route::name('payment.')
            ->prefix('payment')
            ->group(function () {
                Route::get('/today', ListTodayPayment::class)->name('index-today');
                Route::get('/all', ListAllPayment::class)->name('index-all');
            });


        Route::name('discount.')
            ->prefix('discount')
            ->group(function () {
                Route::get('/', ListDiscountCode::class)->name('index');
                Route::get('/create', CreateDiscountCode::class)->name('create');
                Route::get('/show/{collection}', ShowDiscountCode::class)->name('show');
            });
    });
