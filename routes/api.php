<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetController;
use App\Http\Controllers\Api\Category\IndexController as CategoryIndexController;
use App\Http\Controllers\Api\Product\IndexController as ProductIndexController;
use App\Http\Controllers\Api\Product\ShowController as ProductShowController;
use App\Http\Controllers\Api\Cart\AddToCartController as AddToCartController;
use App\Http\Controllers\Api\Cart\IndexController as CartIndexController;
use App\Http\Controllers\Api\Cart\UpdateController as CartUpdateController;
use App\Http\Controllers\Api\Cart\DestroyController as CartDeleteController;
use App\Http\Controllers\Api\Cart\Product\DeleteController as CartProductDeleteController;
use App\Http\Controllers\Api\Order\StoreController as OrderStoreController;
use App\Http\Controllers\Api\Order\IndexController as OrderIndexController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group( function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
   
});
/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::middleware(['api-session'])->group( function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', LogoutController::class);
        Route::get('/orders', OrderIndexController::class);
    });
    Route::prefix('/cart')->group( function() {
        Route::post('/add', AddToCartController::class);  
        Route::get('/', CartIndexController::class);  
        Route::patch('/{id}', CartUpdateController::class);
        Route::delete('/', CartDeleteController::class);
        Route::delete('/{id}', CartProductDeleteController::class);
        
    });
    Route::prefix('/order')->group( function() { 
        Route::post('/', OrderStoreController::class);
        
        
    });
});

Route::get('/categories', CategoryIndexController::class);
Route::post('/products', ProductIndexController::class);
Route::get('/products/{slug}', ProductShowController::class);

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

/* Route::middleware(['api-session'])->prefix('/cart')->group( function() {
    Route::post('/add', AddToCartController::class);  
    Route::get('/', IndexCartController::class);  
});
Route::middleware('api-session')->prefix('/order')->group( function() {
  Route::post('/', OrderStoreController::class);
}); */