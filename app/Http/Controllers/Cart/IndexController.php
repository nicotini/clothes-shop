<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Service\CartService;
use Illuminate\Support\Facades\Auth;

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
      $cartItems = $this->cartService->getCartItems($cart);
      $totalQuantity = $this->cartService->calculateTotalQuantity($cart);
      $totalSum = $this->cartService->calculateTotalSum($cart);
      
         
        
      
      

      return view('cart.index', compact('cart', 'cartItems', 'totalQuantity','totalSum'));
      
   }
}
