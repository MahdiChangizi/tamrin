<?php

namespace App\Services;

use App\Models\Category;

class CategoryServices {
    
    public function create($request)
    {
        $data = Category::create([
            'name'      => $request->name,
            'status'    => $request->status,
            'parent_id' => $request->parent_id,
            'user_id'   => auth()->user()->id
        ]);
        $data->load('user');

        return $data;
    }

    
    public function update($category, $request)
    {
        $data = $category->update([
            'name'      => $request->name,
            'status'    => $request->status,
            'parent_id' => $request->parent_id,
            'user_id'   => auth()->user()->id,
        ]);
        $category->load('user');

        return $data;
    }

    
    public function destroy($category)
    {
        if ($category->children->isEmpty() && $category->products->isEmpty()) {
            $category->delete();
            return response([
                'message' => 'محصول با موفقیت پاک شد!',
                'status'  => 'success'
            ]);
        } 
        else {
            return response([
                'message' => 'نمی‌توانید دسته‌بندی که زیردسته یا محصول دارد را پاک کنید!',
                'status'  => 'error'
            ]);
        }
    }
    
}