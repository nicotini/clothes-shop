<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Shop\IndexController as ShopIndexController;
use App\Http\Controllers\Shop\ProductFilterController;
use App\Http\Controllers\Cart\AddToCartController;
use App\Http\Controllers\Cart\IndexController as CartIndexController;
use App\Http\Controllers\Cart\Product\DestroyController as CartProductDestroyController;
use App\Http\Controllers\Cart\DestroyController as CartDestroyController;
use App\Http\Controllers\Cart\UpdateController as CartUpdateController;

use App\Http\Controllers\Checkout\IndexController as CheckoutController;
use App\Http\Controllers\Checkout\StoreController as CheckoutStoreController;
use App\Http\Controllers\Checkout\SuccessController as CheckoutSuccessController;

use App\Http\Controllers\Order\IndexController as OrderIndexControlller;
use App\Http\Controllers\Order\ShowController as OrderShowControlller;



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

Route::group([], function() {
    Route::get('/', IndexController::class)->name('index');
});
Route::prefix('shop')->name('shop.')->group(function() {
  Route::get('/', ShopIndexController::class)->name('index');
  Route::post('/', ProductFilterController::class)->name('filter');
});
Route::prefix('cart')->name('cart.')->group( function() {
    Route::post('/', AddToCartController::class)->name('add');
    Route::get('/', CartIndexController::class)->name('index');
    Route::delete('/{id}', CartProductDestroyController::class)->name('delete');
    Route::delete('/', CartDestroyController::class)->name('delete.cart');
    Route::patch('/{id}', CartUpdateController::class)->name('update');

});

Route::prefix('checkout')->name('checkout.')->group( function() {
    Route::get('/', CheckoutController::class)->name('index');
    Route::post('/', CheckoutStoreController::class)->name('store');
    Route::get('/success', CheckoutSuccessController::class)->name('success');
});

Route::prefix('order')->name('order.')->middleware('auth')->group( function() {
    Route::get('/', OrderIndexControlller::class)->name('index');
    Route::get('/{id}', OrderShowControlller::class)->name('show');
});




require __DIR__.'/auth.php';

