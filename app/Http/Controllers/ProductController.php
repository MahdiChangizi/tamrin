<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Media;
use App\Models\Product;
use App\Repository\Products\ProductRepository;
use App\Services\ProductServices;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected $productRepository;
    protected $productService;


    public function __construct(ProductRepository $productRepository, ProductServices $productService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }


    /* show all products */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return ProductResource::collection($products);
    }

    /* create a products */
    public function store(ProductStoreRequest $request)
    {
        $data = $this->productService->create($request);
        return new ProductResource($data);
    }

    /* update a products */
    public function update(Product $product, ProductUpdateRequest $request)
    {
        $data = $this->productService->update($product, $request);
        return new ProductResource($data);
    }

    /* delete a products */
    public function destroy(Product $product)
    {
        if ($product) {

            foreach ($product->medias as $media) {
                Storage::delete($media->image);
                $media->delete();
            }

            $product->delete();
            return response([
                'message' => 'عملیات با موفقیت انجام شد!',
                'status' => 'success'
            ]);
        }
        return response([
            'message' => 'محصول وجود ندارد!',
            'status' => 'error'
        ]);
    }


}
