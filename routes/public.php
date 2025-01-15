<?php

use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\NewsController;
use App\Http\Controllers\frontend\PalikaController;
use App\Http\Controllers\frontend\ProfessionalController;
use App\Http\Controllers\frontend\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/', function(){
//     return view('welcome');
// })->name('frontend.home');
Route::get('/', [IndexController::class, 'index'])->name('frontend.home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product-detail', [ShopController::class, 'productDetail'])->name('product.detail');
Route::get('/professional-services', [ProfessionalController::class, 'index'])->name('professional');
Route::get('/professional-detail', [ProfessionalController::class, 'professionalDetail'])->name('professional.detail');
Route::get('/palika', [PalikaController::class, 'index'])->name('palika');
Route::get('/palika-detail', [PalikaController::class, 'palikaDetail'])->name('palika-detail');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog-detail', [BlogController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

