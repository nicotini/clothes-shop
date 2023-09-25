<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\CartItems;
use App\Service\CartService;
use Illuminate\Http\Request;

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
    public function __invoke()
    {
        $this->cartService->clearCart();
        return redirect()->route('shop.index');
    }
}
