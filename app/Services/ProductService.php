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

  public function findAll(): Collection
  {
    return $this->productRepository->findAll();
  }

  public function findById($id): Product
  {
    return $this->productRepository->findById($id);
  }

  public function store($data): Product
  {
    return $this->productRepository->store($data);
  }
  
  public function update($id, $newData): Product
  {
    return $this->productRepository->update($id, $newData);
  }

  public function delete($id): Product
  {
    return $this->productRepository->delete($id);    
  }
}