<?php

use App\Livewire\Site\Index;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class);


Route::get('test', function () {
    dd(
        Product::whereCategoryId(5)
            ->select(['id', 'name'])
            ->get()
    );
});
