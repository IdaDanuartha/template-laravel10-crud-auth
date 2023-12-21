<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $productCategoryService;

    public function __construct(ProductService $productService, ProductCategoryService $productCategoryService)
    {
      $this->productService = $productService;
      $this->productCategoryService = $productCategoryService;
    }

    public function index()
    {
        $products = $this->productService->findAll();
        $categories = $this->productCategoryService->findAll();
        
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        //
    }

    public function store(StoreProductRequest $request)
    {
        try {                        
            $this->productService->store($request->except(['images']), $request->only('images'));

            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', $e->getMessage());
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(UpdateProductRequest $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $this->productService->delete($id);
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', $e->getMessage());
        }
    }
}
