<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductService {
  protected $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function getAllProducts(): Collection
  {
    return $this->productRepository->getAll();
  }

  public function getProductById($id): Product
  {
    return $this->productRepository->getById($id);
  }

  public function storeProduct($data): Product
  {
    return $this->productRepository->store($data);
  }
  
  public function updateProduct($id, $newData): Product
  {
    return $this->productRepository->update($id, $newData);
  }

  public function deleteProduct($id): Product
  {
    return $this->productRepository->delete($id);    
  }
}