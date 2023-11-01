<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Service\CartService;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
class IndexController extends Controller
{

    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function __invoke()
    {
        $cart = $this->cartService->getCart();
        if($cart) {
            $cart->cartItems;
        }

        return response()->json(['cart' => $cart], 200);
    }
}
