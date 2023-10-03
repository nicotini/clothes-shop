<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Service\CartService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function __invoke()

    {
        if (auth()->check()) {
            $user = auth()->user();
            $cart = $this->cartService->getCart();
            $cartItems = $this->cartService->getCartItems($cart);
            $totalQuantity = $this->cartService->calculateTotalQuantity($cart);
            $totalSum = $this->cartService->calculateTotalSum($cart);
            return view('checkout.index', compact('cart', 'cartItems', 'totalQuantity', 'totalSum','user'));
        } else {

            $cart = $this->cartService->getCart();
            $cartItems = $this->cartService->getCartItems($cart);
            $totalQuantity = $this->cartService->calculateTotalQuantity($cart);
            $totalSum = $this->cartService->calculateTotalSum($cart);
            return view('checkout.index', compact('cart', 'cartItems', 'totalQuantity', 'totalSum'));
        }



        
    }
}
