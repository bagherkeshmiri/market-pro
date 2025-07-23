<?php

use App\Enums\CollectionType;
use App\Jobs\TestJob;
use App\Livewire\Site\Blog;
use App\Livewire\Site\Cart;
use App\Livewire\Site\Checkout;
use App\Livewire\Site\Contact;
use App\Livewire\Site\Faq;
use App\Livewire\Site\Index;
use App\Livewire\Site\Login;
use App\Livewire\Site\Products;
use App\Livewire\Site\Register;
use App\Livewire\Site\SinglePost;
use App\Livewire\Site\SingleProduct;
use App\Livewire\Site\Wishlist;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


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
        Route::get('/cart', Cart::class)->name('cart');
        Route::get('/wishlist', Wishlist::class)->name('wishlist');
        Route::get('/blog/{post}', SinglePost::class)->name('single-post');
        Route::get('/checkout', Checkout::class)->name('checkout');
    });


Route::get('/run-test-job/1369', function () {
    TestJob::dispatch();
});

//Route::get('/create-new-table', function () {
//    if (!Schema::hasTable('images')) {
//        Schema::create('images', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('imageable_id');
//            $table->string('imageable_type');
//            $table->boolean('is_main')->default(false);
//            $table->string('url');
//            $table->timestamps();
//        });
//
//        return 'images table created successfully.';
//    } else {
//        return 'images table already exists.';
//    }
//});


//Route::get('test', function () {
//    Session::forget('cart');
//    Session::forget('cart_summary');
//
//    Session::forget('wishlist');

//    dd(
//        Session::get('wishlist')
//    );
//});
