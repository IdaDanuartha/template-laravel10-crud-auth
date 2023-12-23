<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private $productCategoryService;

    public function __construct(ProductCategoryService $productCategoryService)
    {      
      $this->productCategoryService = $productCategoryService;
    }

    public function index(Request $request)
    {                                   
        $categories = $this->productCategoryService->findAll();
        
        return view('categories.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {        
        try {                        
            $this->productCategoryService->store($request->all());

            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Failed to create category');
        }
    }

    public function show($id)
    {        
        return response()->json([            
            "categories" => $this->productCategoryService->findById($id)
        ]);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try {                     
            $this->productCategoryService->update($id, $request->all());

            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Failed to update category');
        }
    }

    public function destroy($id)
    {
        try {
            $this->productCategoryService->delete($id);
            
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Failed to delete category');
        }
    }
}
