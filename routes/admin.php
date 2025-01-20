<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\news\CategoryController;
use App\Http\Controllers\admin\news\NewsController;
use App\Http\Controllers\admin\news\SourceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::patch('/news_category/toggle-status/{slug}', [CategoryController::class, 'toggleStatus'])->name('news_category.toggle-status');
Route::patch('/news_source/toggle-status/{slug}', [SourceController::class, 'toggleStatus'])->name('news_source.toggle-status');

Route::resources([
    'blogs'=>BlogController::class,
    // -----------news---------------------
    'news_category'=>CategoryController::class,
    'news_source'=>SourceController::class,
    'news'=>NewsController::class,
    //----------end of news-----------------
]);

Route::post('ckeditor/upload', [NewsController::class, 'upload'])->name('ckeditor.upload');
Route::post('ckeditor/delete', [NewsController::class, 'delete'])->name('ckeditor.delete');




