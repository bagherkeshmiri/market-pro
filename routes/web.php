<?php

use App\Livewire\Site\Blog;
use App\Livewire\Site\Contact;
use App\Livewire\Site\Faq;
use App\Livewire\Site\Index;
use App\Livewire\Site\Login;
use App\Livewire\Site\Products;
use App\Livewire\Site\Register;
use App\Livewire\Site\SingleProduct;
use Illuminate\Support\Facades\Route;


Route::name('site.')
    ->group(function () {
        Route::get('/', Index::class)->name('home');
        Route::get('/product/{product}', SingleProduct::class)->name('single-product');
        Route::get('/contact', Contact::class)->name('contact');
        Route::get('/products/{category}', Products::class)->name('products');
        Route::get('/blog', Blog::class)->name('blog');
        Route::get('/login', Login::class)->name('login');
        Route::get('/register', Register::class)->name('register');
        Route::get('/faq', Faq::class)->name('faq');
    });




//Route::get('/create-new-table', function () {
//    if (!Schema::hasTable('collection_categories')) {
//        Schema::create('collection_categories', function (Illuminate\Database\Schema\Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('collection_id')->index();
//            $table->unsignedBigInteger('category_id')->index();
//            $table->timestamps();
//        });
//
//        return 'collection_categories table created successfully.';
//    } else {
//        return 'collection_categories table already exists.';
//    }
//});
