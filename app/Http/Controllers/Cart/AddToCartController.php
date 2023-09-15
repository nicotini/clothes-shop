<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartRequest;
use App\Service\CartService;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function __invoke(CartRequest $request)
    {
        $data = $request->validated();
        
        $this->cartService->addToCart($data);
        return redirect()->route('shop.index');
    }
}
