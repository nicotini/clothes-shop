<?php

use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Shop\IndexController as ShopIndexController;
use App\Http\Controllers\Shop\ProductFilterController;
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

Route::group([], function() {
    Route::get('/', IndexController::class)->name('index');
});
Route::prefix('shop')->name('shop.')->group(function() {
    Route::get('/', ShopIndexController::class)->name('index');
    Route::post('/', ProductFilterController::class)->name('filter');
});
