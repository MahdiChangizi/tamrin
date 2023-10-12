<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repository\Categories\CategoryRepository;
use App\Services\CategoryServices;

class CategoryController extends Controller
{

    protected $categoryRepository;
    protected $categoryServices;

    
    public function __construct(CategoryRepository $categoryRepository, CategoryServices $categoryServices)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryServices = $categoryServices;
    }


    
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return CategoryResource::collection($categories);
    }

    
    public function store(CategoryStoreRequest $request)
    {
        $data = $this->categoryServices->create($request);
        return new CategoryResource($data);
    }


    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $data = $this->categoryServices->update($category, $request);
        return new CategoryResource($data);
    }


    public function destroy(Category $category)
    {
        $this->categoryServices->destroy($category);
    }

}            