<?php
namespace App\Repositories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Collection;

class ProductCategoryRepository {
  protected $productCategory;

  public function __construct(ProductCategory $productCategory)
  {
    $this->productCategory = $productCategory;
  }

  public function getAll(): Collection
  {
    return $this->productCategory->get();
  }

  public function getById($id): ProductCategory
  {
    return $this->productCategory->find($id);
  }

  public function store($data): ProductCategory
  {
    $this->productCategory->save($data);
    return $this->productCategory->fresh();
  }
  
  public function update($id, $newData): ProductCategory
  {
    $productCategory = $this->productCategory->find($id);

    $productCategory->update($newData);
    return $productCategory;
  }

  public function delete($id): ProductCategory
  {
    $productCategory = $this->productCategory->find($id);

    $productCategory->delete();
    return $productCategory;
  }
}