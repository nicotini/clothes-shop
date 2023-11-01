<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Service\CartService;


class DestroyController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    
    public function __invoke()
    {
        $this->cartService->clearCart();
        return response()->json(['message' => 'Your cart is deleted']);
    }
}
