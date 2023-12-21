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

  public function findAll(): Collection
  {
    return $this->product->with(['product_category'])->get();
  }

  public function findById($id): Product
  {
    return $this->product->where('id', $id)->with(['product_category', 'product_images'])->first();
  }

  public function store(array $data): Product
  {        
    $product = $this->product->create($data);
    return $product;
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