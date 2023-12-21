<?php
namespace App\Services;

use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductCategoryService {
  protected $productCategoryRepository;

  public function __construct(ProductCategoryRepository $productCategoryRepository)
  {
    $this->productCategoryRepository = $productCategoryRepository;
  }

  public function getAllCategories(): Collection
  {
    return $this->productCategoryRepository->getAll();
  }

  public function getCategoryById($id): ProductCategory
  {
    return $this->productCategoryRepository->getById($id);
  }

  public function storeCategory($data): ProductCategory
  {
    return $this->productCategoryRepository->store($data);
  }
  
  public function updateCategory($id, $newData): ProductCategory
  {
    return $this->productCategoryRepository->update($id, $newData);
  }

  public function deleteCategory($id): ProductCategory
  {
    return $this->productCategoryRepository->delete($id);    
  }
}