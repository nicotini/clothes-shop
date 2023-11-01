<?php

namespace App\Http\Controllers\Api\Cart\Product;

use App\Http\Controllers\Controller;
use App\Service\CartService;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
   
    public function __invoke($id)
    {
        $this->cartService->removeProductFromCart($id);
        return response()->json(['message' => 'Product has been deleted from the cart']);
    }
}
