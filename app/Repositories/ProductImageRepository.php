<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Collection;

class ProductImageRepository implements RepositoryInterface {
  protected $productImage;

  public function __construct(ProductImage $productImage)
  {
    $this->productImage = $productImage;
  }

  public function findAll(): Collection
  {
    return $this->productImage->get();
  }

  public function findById($id): ProductImage
  {
    return $this->productImage->find($id);
  }

  public function store(array $data): ProductImage
  {        
    $product = $this->productImage->create($data);
    return $product;
  }
  
  public function update($id, $newData): ProductImage
  {
    $product_image = $this->productImage->find($id);

    $product_image->update($newData);
    return $product_image;
  }

  public function delete($id): ProductImage
  {
    $product_image = $this->productImage->find($id);

    $product_image->delete();
    return $product_image;
  }
}