<?php

namespace App\Repository\Carts;

use App\Models\Cart;

class CartRepository implements CartInterface 
{
    public function getAll()
    {
        return Cart::with('product')->get();
    }
}