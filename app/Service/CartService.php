<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CartService
{
    protected $totalQuantity = 0;


    public function getCart()
    {
        $user = Auth::user();
        if (Auth::check()) {
            // Для авторизованного пользователя
            $cart = $user->cart;
        } else {
            if (session()->has('cart_uuid')) {
                $cartUuid = session('cart_uuid');
                $cart = Cart::where('uuid', $cartUuid)->first();
            } else {
                $uuid = Str::uuid()->toString();
                $cart = session(['cart_uuid' => $uuid]);
            }
        }
        return $cart;
    }

    public function getCartItems($cart)
    {
        if ($cart) {
            return $cart->cartItems;
        }
    }

    public function saveToDatabase($userId = null, $data)
    {
        $uuid = session('cart_uuid') ?? Str::uuid()->toString();
        session(['cart_uuid' => $uuid]);
        
        try {
            DB::beginTransaction();

            $cart = $this->getCart();
           // dd($cart);
            if ($cart) {
                if ($userId !== null && $cart->user_id === null) {
                    // Обновляем user_id, если пользователь авторизовался
                    $cart->update(['user_id' => $userId]);
                }
            } else {

                if ($userId !== null) {
                    // Пользователь авторизован - связываем с его корзиной
                    $cart = Cart::firstOrCreate(['user_id' => $userId], ['uuid' => $uuid]);
                } else {
                    // Пользователь не авторизован - создаем новую корзину
                    $cart = new Cart();
                    $cart->uuid = $uuid;
                    $cart->save();
                }
                
            }
            $cartItems = $this->getCartItems($cart);
            $findingItem = false;
            $cartItem = new CartItems([
                'product_id' => $data['product_id'],
                'quantity' => $data['product_quantity'],
                'attributes' => json_encode($data['attributes'])
            ]);
            if (!empty($cartItems)) {
                foreach ($cartItems as $item) {
                    if ($item->product_id == $data['product_id']) {
                        $cartItemAttributes = json_decode($item->attributes, true);

                        if (empty(array_diff($cartItemAttributes, $data['attributes']))) {
                            $findingItem = $item;
                        }
                    }
                }
                if ($findingItem) {
                    $findingItem->increment('quantity', $data['product_quantity']);
                } else {
                    $cart->cartItems()->save($cartItem);
                }
            } else {
                $cart->cartItems()->save($cartItem);
            }

            DB::commit();

            // return $cartItem;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            abort(500, 'An error occurred. Please try again later.');
        }
    }



    public function calculateTotalQuantity($cart)
    {

        if ($cart && $cart->cartItems) {
            foreach ($cart->cartItems as $cartItem) {
                $totalQuantity = $this->totalQuantity += $cartItem->quantity;
            }
            return $totalQuantity;
        }
    }

    public function calculateTotalSum($cart)
    {
        $totalSum = 0;
        if ($cart) {
            foreach ($cart->cartItems as $cartItem) {
                $product = $cartItem->product;
                $quantity = $cartItem->quantity;

                // Calculate the sum for each product item
                $itemSum = $this->calculateProductSum($product, $quantity);

                // Store the item sum in the cart item
                $cartItem->itemSum = $itemSum;

                // Add the item sum to the total sum
                $totalSum += $itemSum;
            }

            return $totalSum;
        }
    }

    public function calculateProductSum($product, $quantity)
    {
        return $product->price * $quantity;
    }

    public function findProductId($id)
    {
        $findingProdId = null;
        $cart = $this->getCart();
        $cartItems = $this->getCartItems($cart);

        foreach ($cartItems as $item) {
            if ($item->product_id == $id) {
                $findingProdId = $item;
            }
        }

        return $findingProdId;
    }
    public function removeProductFromCart($id)
    {
        $productToRemove = $this->findProductId($id);
        if ($productToRemove) {
            return $productToRemove->delete();
        }
    }
    public function clearCart()
    {
        $cart = $this->getCart();
        if (!$cart) {
            return false;
        }
        return $cart->delete();
    }

    public function updateAmountItemsInCart($data, $id)
    {
        $productToUpdate = $this->findProductId($id);
        if ($productToUpdate) {
            $productToUpdate->update(['quantity' => $data['product_quantity']]);
            return $productToUpdate;
        }
    }
}
