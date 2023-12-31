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

    public function index(Request $request)
    {                           
        $products = $this->productService->findAll($request["query"]);
        $categories = $this->productCategoryService->findAll();
        
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {        
        try {                        
            $this->productService->store($request->except(['images']), $request->only('images'));

            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Failed to create product');
        }
    }

    public function show($id)
    {                
        return response()->json([
            "product" => $this->productService->findById($id, ["product_category", "product_images"]),
            "categories" => $this->productCategoryService->findAll()
        ]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {                     
            $this->productService->update($id, $request->except(['product_id', 'images', 'image_deleted']), $request->only('images', 'image_deleted'));

            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Failed to update product');
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->delete($id);
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Failed to delete product');
        }
    }
}
