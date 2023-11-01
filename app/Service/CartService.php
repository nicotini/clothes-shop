<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartService
{
    protected $totalQuantity = 0;

    public function createCartToken()
    {
        return  Str::uuid()->toString();
    }
    public function setCartTokenToSession()
    {
        $uuid = $this->createCartToken();
        Session::put('uuid_token', $uuid);
        return $uuid;
    }
    public function getCartTokenFromSession()
    {
        return session('uuid_token');
    }

    public function getUserCart($user)
    {
        return  $user->cart;
    }

    public function getCart()
    {
       /*  if ($user = Auth::guard('sanctum')->user()) {
            return $user->cart;
        } else {
            if ($uuid = $this->getCartTokenFromSession()) {
                return Cart::where('uuid', $uuid)->first();
            }
        } */
        if ($uuid = $this->getCartTokenFromSession()) {
            return Cart::where('uuid', $uuid)->first();
        }


        return false;
    }

    public function saveCartItemsToDB($data, $cart)
    {
        try {
            $cartItems = $cart->cartItems;
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
        } catch (\Exception $e) {
            Log::error('Error saving cart items: ' . $e->getMessage());
            throw $e;
        }
    }
    public function saveCartUser($user, $data)
    {
        try {
            $uuid = $this->getCartTokenFromSession() ?? $this->setCartTokenToSession();
            

            DB::beginTransaction();
            $cart = $this->getCart();
            if ($cart) {
                if ($user->id !== null && $cart->user_id === null) {
                    // Обновляем user_id, если пользователь авторизовался
                    $cart->update(['user_id' => $user->id]);
                   // $cart = Cart::firstOrCreate(['user_id' => $user->id], ['uuid' => $uuid]);
                    
                }
                
            } else {
                if ($user->id !== null) {
                    // Пользователь авторизован - связываем с его корзиной
                    // $cart = Cart::firstOrCreate(['user_id' => $user->id], ['uuid' => $uuid]);
                    $cart = new Cart();
                    $cart->user_id = $user->id;
                    $cart->uuid = $uuid;
                    $cart->save();
                }
            }
            
            $this->saveCartItemsToDB($data, $cart);

            DB::commit();

            // return $cartItem;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            abort(500, 'An error occurred. Please try again later.');
        }
    }


    public function saveToDatabase($data)
    {
        try {
            $uuid = $this->getCartTokenFromSession() ?? $this->setCartTokenToSession();

            DB::beginTransaction();
            $cart = $this->getCart();
                if (!$cart) {
                    /* $cart = new Cart();
                    $cart->uuid = $uuid;
                    $cart->save();  */
                    $cart = Cart::firstOrCreate(['uuid' => $uuid]);
                } 
           
                $this->saveCartItemsToDB($data, $cart);
            
            DB::commit();
          
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error saving cart: ' . $exception->getMessage());
            return response()->json(['message' => 'An error occurred. Please try again later.'], 500);
        }
    }



    public function calculateTotalQuantity($cart)
    {
        $totalQuantity = 0;
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
        if ($cart = $this->getCart()) {
            $cartItems = $cart->cartItems;

            foreach ($cartItems as $item) {
                if ($item->product_id == $id) {
                    $findingProdId = $item;
                }
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
        if ($cart = $this->getCart()) {
            return $cart->delete();
        }
        return false;
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
