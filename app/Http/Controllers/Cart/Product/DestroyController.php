<?php

namespace App\Http\Controllers\Cart\Product;

use App\Http\Controllers\Controller;
use App\Service\CartService;


class DestroyController extends Controller
{

    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $this->cartService->removeProductFromCart($id);
        return redirect()->route('cart.index');
    }
}
