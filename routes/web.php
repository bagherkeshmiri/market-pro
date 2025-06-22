<?php

use App\Livewire\Site\Index;
use App\Livewire\Site\SingleProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


Route::name('site.')
    ->group(function () {
        Route::get('/', Index::class)->name('home');
        Route::get('/product/{product}', SingleProduct::class)->name('single-product');
    });


