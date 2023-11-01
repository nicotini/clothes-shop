<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartRequest;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if($user = auth()->user()) {
            $this->cartService->saveCartUser($user, $data);
        } else {
            $this->cartService->saveToDatabase($data);  
        }
        
        return redirect()->route('shop.index');
    }
}
