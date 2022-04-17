<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home
Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
// Service
Route::get('/search', \App\Http\Controllers\SearchController::class)->name('search');
Route::get('/car-wash', \App\Http\Controllers\PageController::class)->name('page');
Route::get('/tire-service', \App\Http\Controllers\PageController::class)->name('page');
Route::get('/auto-detailing', \App\Http\Controllers\PageController::class)->name('page');
Route::get('/price', \App\Http\Controllers\PriceController::class)->name('page');
// Static
Route::get('/promotion', \App\Http\Controllers\PromotionController::class)->name('page');
Route::get('/about-us', \App\Http\Controllers\PageController::class)->name('page');
Route::get('/contact', \App\Http\Controllers\PageController::class)->name('page');
Route::get('/gallery', \App\Http\Controllers\GalleryController::class)->name('page');
// Other
Route::get('/{page:slug}', \App\Http\Controllers\PageController::class)->name('page');
