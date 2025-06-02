<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| api Routes
|--------------------------------------------------------------------------
*/

Route::post('/upload', function (Request $request) {
    $request->validate([
        'image' => 'required',
    ]);
    $file = $request->file('image');
    $date = Carbon::now();
    $year = $date->year;
    $week = $date->week;
    $originalPath = 'uploads/images/' . $year . '/' . $week;
    $path = Storage::disk('public')->put($originalPath, $file);
    $url = '/storage/' . $path;
    return response(
        $url
    );
})->name('api.upload');


