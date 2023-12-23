<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Utils\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductService {
  protected $productRepository;
  protected $productImageService;
  protected $productCategoryService;
  protected $uploadFile;

  public function __construct(
    ProductRepository $productRepository, 
    ProductImageService $productImageService, 
    ProductCategoryService $productCategoryService,
    UploadFile $uploadFile)
  {
    $this->productRepository = $productRepository;
    $this->productImageService = $productImageService;
    $this->productCategoryService = $productCategoryService;
    $this->uploadFile = $uploadFile;
  }

  public function findAll($query)
  {        
    return $this->productRepository
                ->findAll()
                ->where('title', 'like', "%$query%")
                ->latest()
                ->paginate(5);
  }

  public function findById($id, $relations = []): Product
  {
    return $this->productRepository->findById($id, $relations);
  }

  public function store(array $data, array $product_images): Product
  {   
    DB::beginTransaction();     
    try {
      if ($data["thumbnail_img"]) {         
        $filename = $this->uploadFile->uploadSingleFile($data['thumbnail_img'], "products/thumbnails");
        $data['thumbnail_img'] = $filename;
      }     

      $product = $this->productRepository->store($data);
      $this->productImageService->store($product->id, $product_images["images"]);

      DB::commit();

      return $product;

    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      
      throw $e;
    }    
  }
  
  public function update($id, array $data, array $product_images): bool
  {
    DB::beginTransaction();     
    try {
      $product = $this->productRepository->findById($id); 
      
      if (isset($data["thumbnail_img"])) { 
        $this->uploadFile->deleteExistFile("products/thumbnails/$product->thumbnail_img");

        $filename = $this->uploadFile->uploadSingleFile($data['thumbnail_img'], 'products/thumbnails');
        $data['thumbnail_img'] = $filename;
      }     
      
      DB::commit();

      if(isset($product_images['images'])) $this->productImageService->update($product->id, $product_images);

      return $this->productRepository->update($id, $data);;

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
      $product = $this->productRepository->findById($id);      
      $product_images = $this->productImageService->findAll($id);

      $this->uploadFile->deleteExistFile("products/thumbnails/$product->thumbnail_img");

      foreach($product_images as $image) {        
        if($image->product_id == $product->id) {
          $this->productImageService->delete($image->id);
        }
      }
      
      DB::commit();

      return $this->productRepository->delete($id);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());

      throw $e;
    }
  }
}