<?php

namespace App\Repository\Categories;

use App\Models\Category;

class CategoryRepository implements CategoryInterface 
{
    public function getAll()
    {
        return Category::with('user')->get();
    }
}