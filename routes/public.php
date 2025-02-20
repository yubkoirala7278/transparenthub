<?php

use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\NewsController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\PalikaController;
use App\Http\Controllers\frontend\ProfessionalController;
use App\Http\Controllers\frontend\ShopController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/professional-services', [ProfessionalController::class, 'index'])->name('professional');
Route::get('/professional-detail/{slug}', [ProfessionalController::class, 'professionalDetail'])->name('professional.detail');
Route::post('/appointment/book', [ProfessionalController::class, 'bookAppointment'])->name('appointment.book');
Route::get('/palika', [PalikaController::class, 'index'])->name('palika');
Route::get('/palika-detail/{slug}', [PalikaController::class, 'palikaDetail'])->name('palika-detail');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog-detail/{slug}', [BlogController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('professional/get-subcategories/{categoryId}', [ProfessionalController::class, 'getSubcategories'])->name('professional.getSubcategories');



// news
Route::get('/news-detail/{slug?}/{keyword?}', [NewsController::class, 'news'])->name('news.view');
Route::get('/news-with-category/{category}', [NewsController::class, 'newsWithCategories'])->name('news.with.category');
Route::get('/news-suggestions', [NewsController::class, 'getSuggestions'])->name('news.suggestions');
Route::get('/news/load', [NewsController::class, 'load'])->name('news.load');

// product
Route::get('/product-detail/{slug}', [ShopController::class, 'productDetail'])->name('product.detail');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/load-more-products', [ShopController::class, 'loadMoreProducts']);
Route::get('/filter-products', [ShopController::class, 'filterProducts'])->name('products.filter');
Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ShopController::class, 'viewCart'])->name('cart.view'); 
Route::middleware('auth')->group(function () {
    // Route to update the quantity of a cart item
    Route::post('/cart/update', [ShopController::class, 'updateCart'])->name('cart.update');
    // Route to remove an item from the cart
    Route::post('/cart/remove', [ShopController::class, 'removeFromCart'])->name('cart.remove');
    // checkout page
    Route::get('/checkout',[ShopController::class,'checkout'])->name('checkout');
    // checkout produt
    Route::post('/checkout-products',[ShopController::class,'checkoutProduct'])->name('checkout.products');
    Route::get('/checkout-success',[ShopController::class,'orderSuccess'])->name('order.success');
    // check my orders
    Route::get('/my-orders',[OrderController::class,'index'])->name('my-order');
    Route::get('/my-orders-detail/{slug}',[OrderController::class,'orderDetails'])->name('my-order-details');
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
});



// login with socialite
Route::get('auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/auth/header', function () {
    return view('partials.auth-header');
})->name('auth.header');

