<?php

use App\Livewire\Site\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class);


Route::get('test', function () {
    $products = \App\Models\Product::all();

    foreach ($products as $product) {
        $product->final_price = calculateProductFinalPrice($product->discount_type, $product->price, $product->discount);
        $product->save();
    }
});
