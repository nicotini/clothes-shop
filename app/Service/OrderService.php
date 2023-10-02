<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{

    public function getCartById($cart_id)
    {
        $cart = false;
        if ($cart_id) {
            $cart = Cart::where('id', $cart_id)->first();
        }
        return $cart;
    }

    public function getCartItems($cart)
    {
        if ($cart) {
            return $cart->cartItems;
        }
    }

    public function saveToDatabase($data)
    {
        try {
            DB::beginTransaction();
            if (Auth::check()) {
                $order = new Order([
                    'user_id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'total_sum' => $data['total_sum']
                ]);
            } else {
                $order = new Order([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'total_sum' => $data['total_sum']
                ]);
            }

            $order->save();
            $cart = $this->getCartById($data['card_id']);
            if ($cart) {
                $cartItems = $this->getCartItems($cart);
                foreach ($cartItems as $cartItem) {
                    $orderItem = new OrderItem([
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'attributes' => $cartItem->attributes
                    ]);
                    $order->orderItems()->save($orderItem);
                }
            }
            $cart->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error saving order: ' . $exception->getMessage());
            abort(500, 'An error occurred. Please try again later.');
        }
    }

    public function getAllUserOrders()
    {
        
    }
}
