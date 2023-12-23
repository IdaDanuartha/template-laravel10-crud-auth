<?php
namespace App\Repositories;

use App\Models\ProductImage;

class ProductImageRepository extends BaseRepository {
  public function __construct(ProductImage $productImage)
  {
      parent::__construct($productImage);
  }
}