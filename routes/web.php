<?php

use App\Livewire\Site\Blog;
use App\Livewire\Site\Contact;
use App\Livewire\Site\Index;
use App\Livewire\Site\Products;
use App\Livewire\Site\SingleProduct;
use Illuminate\Support\Facades\Route;


Route::name('site.')
    ->group(function () {
        Route::get('/', Index::class)->name('home');
        Route::get('/product/{product}', SingleProduct::class)->name('single-product');
        Route::get('/contact', Contact::class)->name('contact');
        Route::get('/blog', Blog::class)->name('blog');
        Route::get('/products/{category}', Products::class)->name('products');
    });


