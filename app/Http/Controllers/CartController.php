<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Requests\Cart\CartUpdateRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Repository\Carts\CartRepository;
use App\Services\CartServices;

class CartController extends Controller
{

    protected $cartRepository;
    protected $cartServices;

    
    public function __construct(CartRepository $cartRepository, CartServices $cartServices)
    {
        $this->cartRepository = $cartRepository;
        $this->cartServices = $cartServices;
    }


    public function index()
    {
        $carts = $this->cartRepository->getAll();
        return CartResource::collection($carts);
    }

    
    public function store(CartStoreRequest $request)
    {
        $cart = $this->cartServices->create($request);
        return new CartResource($cart);
    }

    
    public function update(Cart $cart, CartUpdateRequest $request)
    {
        $cart = $this->cartServices->update($cart, $request);
        return new CartResource($cart);
    }


    public function destroy(Cart $cart)
    {
        $cart = $this->cartServices->destroy($cart);
    }
    
}