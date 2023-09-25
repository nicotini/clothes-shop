<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $guarded = false;

    public function cartItems()
    {
        return $this->hasMany(CartItems::class, 'cart_id', 'id');
    }
}
