<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Service\CartService;
use App\Service\OrderService;


class StoreController extends Controller
{
    protected $orderService;
    protected $cartService;
    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $cart =  $this->cartService->getCart();
        if ($user = auth()->user()) {
            $this->orderService->saveToDBAuthUser($cart, $user);
        } else {
            $this->orderService->saveToDatabase($data, $cart);
        }
        return redirect()->route('checkout.success');
    }
}
