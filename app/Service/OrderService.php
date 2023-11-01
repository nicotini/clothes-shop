<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
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
    public function getTotalCartSum($cart)
    {
        $totalSum = 0;
        if ($cart) {
            $cartItems = $this->getCartItems($cart);
            foreach ($cartItems as $cartItem) {
                $cartItem->product;
                $totalSum += $cartItem->quantity * $cartItem->product->price;
            }
        }
        return $totalSum;
    }
    public function generateOrderNumber()
    {
        return 'N-' . now()->format('Ymd') . '-' . mt_rand(1000, 9999);
    }

    public function saveOrderItems($cart, $order)
    {
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
    }

    public function saveToDatabase($data, $cart)
    {
        try {
            DB::beginTransaction();

            $order = new Order([
                'name' => $data['name'],
                'email' => $data['email'],
                'total_sum' => $this->getTotalCartSum($cart),
                'order_number' => $this->generateOrderNumber()
            ]);
            $order->save();
            $this->saveOrderItems($cart, $order);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error saving order: ' . $exception->getMessage());
            abort(500, 'An error occurred. Please try again later.');
        }
    }

    public function saveToDBAuthUser($cart, $user)
    {
        try {
            DB::beginTransaction();
            $order = new Order([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'total_sum' => $this->getTotalCartSum($cart),
                'order_number' => $this->generateOrderNumber()
            ]);
            $order->save();

            $this->saveOrderItems($cart, $order);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error saving order: ' . $exception->getMessage());
            abort(500, 'An error occurred. Please try again later.');
        }
    }

    public function getAllUserOrders($userId)
    {
        if (Auth::check()) {
            $user = User::findOrFail($userId);
            return $user->orders;
        }
    }

    public function getOrderById($id)
    {
        $order = Order::find($id);
        return $order;
    }

    public function getOrderProducts($order)
    {
        if ($order) {
            return $order->orderItems;
        }
    }
}
