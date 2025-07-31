<?php

use App\Enums\CollectionType;
use App\Enums\OrderStatus;
use App\Http\Controllers\site\AuthController;
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
use App\Models\GateOrg;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
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
        Route::middleware('auth:web')->get('/checkout', Checkout::class)->name('checkout');
    });


Route::prefix('auth')
    ->group(function () {
        Route::controller(AuthController::class)
            ->group(function () {
                Route::get('/logout', 'logout')
                    ->name('logout');
            });
    });


Route::get('/run-test-job/1369', function () {
    TestJob::dispatch();
});


//Route::get('/create-new-table', function () {
//    if (!Schema::hasTable('user_addresses')) {
//        Schema::create('user_addresses', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('user_id')->index();
//            $table->unsignedBigInteger('province_id')->index();
//            $table->unsignedBigInteger('city_id')->index();
//            $table->text('address');
//            $table->string('postal_code')->nullable();
//            $table->timestamps();
//        });
//
//        return 'user_addresses table created successfully.';
//    } else {
//        return 'user_addresses table already exists.';
//    }
//});


//Route::get('test', action: function () {
//    Session::forget('cart');
//    Session::forget('cart_summary');

//    Session::forget('wishlist');
//
//    dd(
//        Session::get('wishlist')
//    );
//});
