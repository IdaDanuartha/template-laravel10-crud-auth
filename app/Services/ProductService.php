<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService {
  protected $productRepository;

  public function ___construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }
}