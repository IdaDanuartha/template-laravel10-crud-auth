<?php
namespace App\Services;

use App\Models\ProductImage;
use App\Repositories\ProductImageRepository;
use App\Utils\UploadFile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductImageService {
  protected $productImageRepository;
  protected $uploadFile;

  public function __construct(ProductImageRepository $productImageRepository, UploadFile $uploadFile)
  {
    $this->productImageRepository = $productImageRepository;
    $this->uploadFile = $uploadFile;
  }

  public function findAll($product_id)
  {
    return $this->productImageRepository
                ->findAll()
                ->where('product_id', $product_id)
                ->get();
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
        $filename = $this->uploadFile->uploadSingleFile($image, 'products/images');       

        $data = [
          "image" => $filename,
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
          $this->uploadFile->deleteExistFile("products/images/$image->image");
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
      
      $this->uploadFile->deleteExistFile("products/images/$product_images->image");
      
      DB::commit();           

      return $this->productImageRepository->delete($id);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());

      throw $e;
    }       
  }
}