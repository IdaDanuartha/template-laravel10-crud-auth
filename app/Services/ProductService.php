<?php
namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductService {
  protected $productRepository;
  protected $productImageService;

  public function __construct(ProductRepository $productRepository, ProductImageService $productImageService)
  {
    $this->productRepository = $productRepository;
    $this->productImageService = $productImageService;
  }

  public function findAll(): Collection
  {
    return $this->productRepository->findAll();
  }

  public function findById($id): JsonResponse
  {
    return response()->json([
      "data" => $this->productRepository->findById($id)
    ]);
  }

  public function store(array $data, array $product_images): Product
  {   
    DB::beginTransaction(); 
    try {
      if ($data["thumbnail_img"]) { 
        $thumbnail_img_name = date("Ymdhis") . "_" . $data["thumbnail_img"]->getClientOriginalName();                
        $data["thumbnail_img"]->move(public_path("uploads/products/thumbnails"), $thumbnail_img_name);
        $data['thumbnail_img'] = $thumbnail_img_name;
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
  
  public function update($id, $newData): Product
  {
    return $this->productRepository->update($id, $newData);
  }

  public function delete($id): Product
  {
    DB::beginTransaction();
    try {
      $product = $this->productRepository->findById($id);      
      $product_images = $this->productImageService->findAll();

      $path = "uploads/products/thumbnails/$product->thumbnail_img";      

      if(File::exists($path) ) {
        File::delete($path);
      }      

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