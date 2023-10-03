<?php

namespace App\Providers;

use App\Service\CartService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        view()->composer('*', function ($view) {
            $cartService = app(CartService::class);
            $cart = $cartService->getCart();
            $totalQuantity = $cartService->calculateTotalQuantity($cart);
            $view->with('totalQuantity', $totalQuantity);
        });
    }
}
