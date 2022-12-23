<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Order\Edit;
use App\Http\Livewire\Product\Create;
use App\Http\Livewire\Product\CreateGallery;
use App\Http\Livewire\Product\Gallery;
use App\Http\Livewire\Product\Index;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/products', Index::class)->name('products.index');
    Route::get('/products/create', Create::class)->name('products.create');
    Route::get('/products/{product}/edit', Create::class)->name('products.edit');
    Route::get('/products/{product}/gallery', Gallery::class)->name('products.gallery');
    Route::get('/product-galleries', Gallery::class)->name('product-galleries.index');
    Route::get('/product-galleries/create', CreateGallery::class)->name('product-galleries.create');
    Route::get('/orders', \App\Http\Livewire\Order\Index::class)->name('orders.index');
    Route::get('/orders/{item}/edit', Edit::class)->name('orders.edit');
});
// Route::get('/', Dashboard::class)->name('dashboard')->middleware('auth');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
