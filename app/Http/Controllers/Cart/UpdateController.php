<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\UpdateRequest;
use App\Models\CartItems;
use App\Service\CartService;

class UpdateController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->cartService->updateAmountItemsInCart($data, $id);

        return redirect()->route('cart.index');
    }
}
