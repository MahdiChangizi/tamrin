<?php

namespace App\Repository\Products;

use App\Models\Product;

class ProductRepository implements ProductInterface 
{
    public function getAll()
    {
        return Product::with('category')->get();
    }
}