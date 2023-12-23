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

  public function findAll(): Collection
  {
    return $this->productCategoryRepository->findAll();
  }

  public function findById($id): ProductCategory
  {
    return $this->productCategoryRepository->findById($id);
  }

  public function store($data): ProductCategory
  {
    return $this->productCategoryRepository->store($data);
  }
  
  public function update($id, $newData): bool
  {
    return $this->productCategoryRepository->update($id, $newData);
  }

  public function delete($id): bool
  {
    return $this->productCategoryRepository->delete($id);    
  }
}