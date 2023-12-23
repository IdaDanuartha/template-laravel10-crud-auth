<?php
namespace App\Services;

use App\Models\ProductImage;
use App\Repositories\ProductImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductImageService {
  protected $productImageRepository;

  public function __construct(ProductImageRepository $productImageRepository)
  {
    $this->productImageRepository = $productImageRepository;
  }

  public function findAll()
  {
    return $this->productImageRepository->findAll();
  }

  public function findById($id): ProductImage
  {
    return $this->productImageRepository->findById($id);
  }

  public function store(int $product_id, array $product_images): void
  {   
    DB::beginTransaction();     
    try {            
      foreach($product_images as $image) {
        $product_image_name = date("Ymdhis") . "_" . $image->getClientOriginalName();                
        $image->move(public_path("uploads/products/images"), $product_image_name);        

        $data = [
          "image" => $product_image_name,
          "product_id" => $product_id,
        ];

        $this->productImageRepository->store($data);
      }

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      
      throw $e;
    }    
  }
  
  public function update(int $product_id, array $product_images): void
  {
    DB::beginTransaction();
    try {            
      $images = ProductImage::where('product_id', $product_id)->whereIn("id", explode(",", $product_images['image_deleted']))->get();            
            
      foreach($images as $image) {                      
          $image->delete();

          $path = "uploads/products/images/$image->image";                
          if(File::exists($path)) {
              File::delete($path);
          }

      } 

      if ($product_images) {
        $this->store($product_id, $product_images["images"]);
      }

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      
      throw $e;
    } 
  }

  public function delete($id): bool
  {
    DB::beginTransaction();
    try {      
      $product_images = $this->productImageRepository->findById($id);
      
      $path = "uploads/products/images/$product_images->image";

      if(File::exists($path) ) {
        File::delete($path);
      }
      
      DB::commit();           

      return $this->productImageRepository->delete($id);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());

      throw $e;
    }       
  }
}