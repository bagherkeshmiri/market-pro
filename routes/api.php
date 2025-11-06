<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| api Routes
|--------------------------------------------------------------------------
*/

Route::post('/upload', function (Request $request) {
    $request->validate([
        'image' => 'required',
    ]);

    return responseSuccess([
        'data' => storeImage($request->file('image'), 'global'),
    ]);
})->name('api.upload');
