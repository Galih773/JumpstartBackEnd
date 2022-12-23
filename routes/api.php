<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyProductController;
use App\Http\Controllers\UserProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api','prefix' => 'products'], function ($router) {
    Route::get('index', [UserProductsController::class, 'index']);
    Route::get('detail', [UserProductsController::class, 'detail']);
    Route::get('filter', [UserProductsController::class, 'filter']);
});

Route::group(['middleware' => 'api','prefix' => 'user'], function ($router) {
    Route::post('cart', [BuyProductController::class, 'cart']);
    Route::post('addCart', [BuyProductController::class, 'addCart']);
    Route::post('checkout', [BuyProductController::class, 'checkout']);
    Route::post('deleteCart', [BuyProductController::class, 'deleteCart']);
    Route::post('decreaseCart', [BuyProductController::class, 'decreaseCart']);
});

Route::get('/checkout/success', [BuyProductController::class, 'success'])->name('checkout.success');
