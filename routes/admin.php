<?php

use App\Http\Controllers\admin\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resources([
    'news' => NewsController::class,
]);
