<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\StoreRequest as OrderStoreRequest;
use App\Service\CartService;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    protected $orderService;
    protected $cartService;
    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }
    public function __invoke(Request $request)
    {
        $cart =  $this->cartService->getCart();
        if(Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
            $this->orderService->saveToDBAuthUser($cart, $user);
        } else {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
            ]);
            $this->orderService->saveToDatabase($data, $cart);
        }
        return response()->json(['message' => 'Your order created successfully']);
        
    }
}
