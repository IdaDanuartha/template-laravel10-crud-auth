<?php
namespace App\Services;

use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductCategoryService {
  protected $productCategoryRepository;

  public function __construct(ProductCategoryRepository $productCategoryRepository)
  {
    $this->productCategoryRepository = $productCategoryRepository;
  }

  public function findAll($query = "")
  {
    return $this->productCategoryRepository
                ->findAll()
                ->where('name', 'like', "%$query%")
                ->latest()
                ->paginate(10);
  }

  public function findById($id): ProductCategory
  {
    return $this->productCategoryRepository->findById($id);
  }

  public function store($data): ProductCategory
  {
    DB::beginTransaction();     
    try {
      DB::commit();
      return $this->productCategoryRepository->store($data);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      
      throw $e;
    } 
  }
  
  public function update($id, $newData): bool
  {
    DB::beginTransaction();     
    try {
      DB::commit();
      return $this->productCategoryRepository->update($id, $newData);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      
      throw $e;
    }     
  }

  public function delete($id): bool
  {
    DB::beginTransaction();     
    try {
      DB::commit();
      return $this->productCategoryRepository->delete($id);    
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      
      throw $e;
    }  
  }
}