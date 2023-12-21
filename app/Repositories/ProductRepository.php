<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements RepositoryInterface {
  protected $product;

  public function __construct(Product $product)
  {
    $this->product = $product;
  }

  public function getAll(): Collection
  {
    return $this->product->with(['product_category', 'product_images'])->get();
  }

  public function getById($id): Product
  {
    return $this->product->find($id);
  }

  public function store($data): Product
  {
    $this->product->save($data);
    return $this->product->fresh();
  }
  
  public function update($id, $newData): Product
  {
    $product = $this->product->find($id);

    $product->update($newData);
    return $product;
  }

  public function delete($id): Product
  {
    $product = $this->product->find($id);

    $product->delete();
    return $product;
  }
}