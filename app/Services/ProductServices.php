<?php

namespace App\Services;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductServices {

    public function create($request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);
        $product->load('category');

        foreach ($request->file('image') as $key => $image) {
            /* storage/images */
            $imagePath = $image->store('images');

            $title = $request->title[$key];
            Media::create([
                'title' => $title,
                'image' => $imagePath,
                'product_id' => $product->id,
            ]);
        }

        return $product;
    }


    public function update($product, $request)
    {
        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => $request->status,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            foreach ($product->media as $media) {
                Storage::delete($media->image);
                $media->delete();
            }

            foreach ($request->file('image') as $key => $image) {
                $imagePath = $image->store('public/images');
                $title = $request->title[$key];
                Media::create([
                    'title'      => $title,
                    'image'      => $imagePath,
                    'product_id' => $product->id,
                ]);
            }
        }

        return $product;
    }

}