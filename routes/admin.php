<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\news\CategoryController;
use App\Http\Controllers\admin\news\NewsController;
use App\Http\Controllers\admin\news\SourceController;
use App\Http\Controllers\admin\products\BrandController;
use App\Http\Controllers\admin\products\CategoryController as ProductsCategoryController;
use App\Http\Controllers\admin\products\ColorController;
use App\Http\Controllers\admin\products\OrderController;
use App\Http\Controllers\admin\products\ProductController;
use App\Http\Controllers\admin\products\SizeController;
use App\Http\Controllers\admin\products\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::patch('/news_category/toggle-status/{slug}', [CategoryController::class, 'toggleStatus'])->name('news_category.toggle-status');
Route::patch('/news_source/toggle-status/{slug}', [SourceController::class, 'toggleStatus'])->name('news_source.toggle-status');
Route::patch('/products_category/toggle-status/{slug}', [ProductsCategoryController::class, 'toggleStatus'])->name('product_category.toggle-status');
Route::patch('/products_sub_category/toggle-status/{slug}', [SubCategoryController::class, 'toggleStatus'])->name('products_sub_category.toggle-status');
Route::patch('/products_brand/toggle-status/{slug}', [BrandController::class, 'toggleStatus'])->name('product_brand.toggle-status');
Route::patch('/products_color/toggle-status/{slug}', [ColorController::class, 'toggleStatus'])->name('product_color.toggle-status');
Route::patch('/products_size/toggle-status/{slug}', [SizeController::class, 'toggleStatus'])->name('product_size.toggle-status');
Route::patch('/products/toggle-status/{slug}', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
Route::get('/get-subcategories', [ProductController::class, 'getSubCategories'])->name('getSubCategories');

Route::resources([
    'blogs'=>BlogController::class,
    // -----------news---------------------
    'news_category'=>CategoryController::class,
    'news_source'=>SourceController::class,
    'news'=>NewsController::class,
    //----------end of news-----------------
    // --------products----------------------
    'products_category'=>ProductsCategoryController::class,
    'products_sub_category'=>SubCategoryController::class,
    'products_brand'=>BrandController::class,
    'color'=>ColorController::class,
    'size'=>SizeController::class,
    'products'=>ProductController::class,
    // ------end of products------------------
]);
// news
Route::post('ckeditor/upload', [NewsController::class, 'upload'])->name('ckeditor.upload');
Route::post('ckeditor/delete', [NewsController::class, 'delete'])->name('ckeditor.delete');
// products
Route::post('ckeditor/upload/product', [ProductController::class, 'upload'])->name('ckeditor.upload.product');
Route::post('ckeditor/delete/product', [ProductController::class, 'delete'])->name('ckeditor.delete.product');

Route::get('/orders',[OrderController::class,'index'])->name('admin.orders');
Route::get('/orders/{slug}',[OrderController::class,'view'])->name('admin.orders.view');
Route::put('/status/update/{slug}',[OrderController::class,'updateStatus'])->name('admin.update.status');





