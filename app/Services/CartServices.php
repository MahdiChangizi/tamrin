<?php

namespace App\Services;

use App\Models\Cart;

class CartServices {
    
    public function create($request)
    {
        $cart = Cart::create([
            'product_id' => $request->product_id,
            'user_id'    => 1,
            'number'     => $request->number
        ])->load('product');

        return $cart;
    }

    
    public function update($cart, $request)
    {
        $data = $cart->update([
            'product_id' => $request->product_id,
            'user_id'    => auth()->user()->id,
            'number'     => $request->number
        ]);

        $cart->load('product');

        return $data;
    }

    
    public function destroy($cart)
    {
        $cart->delete();

        return response([
            'message' => 'عملیات با موفقیت انجام شد!',
            'status'  => 'success'
        ]);
    }
    
}