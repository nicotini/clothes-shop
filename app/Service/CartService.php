<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function addToCart($data)
    {
        try 
        {
            DB::beginTransaction();
           
            $cart = Cart::firstOrCreate(
                ['user_id' => $data['user_id']]
            );
            $cartItem = new CartItems([
                'product_id' => $data['product_id'],
                'quantity' => $data['product_quantity'],
                'attributes' => json_encode($data['attributes'])
                // Другие атрибуты элемента корзины, если они есть
            ]);
            //dd($cartItem);
            $cart->cartItems()->save($cartItem);
            DB::commit();
            return response()->json(['message' => 'Товар успешно добавлен в корзину']);
        } catch(\Exception $exception)
        {
            DB::rollBack();
            abort(500);
        }
    }
}