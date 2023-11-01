<?php

namespace App\Http\Controllers\Api\Cart;

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
        // $user = Auth::guard('sanctum')->user();
        if($user = Auth::guard('sanctum')->user()) {
            $this->cartService->saveCartUser($user, $data);
        } else {
            $this->cartService->saveToDatabase($data);            
        }        
        
        return response()->json(['message' => 'Product added to cart successfully' , "user_id" => $user]);
    }
}
