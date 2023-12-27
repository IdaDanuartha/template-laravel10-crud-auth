
# Standarisasi Kode

Untuk standarisasi kode pada laravel 10, kita menggunakan Service Repository Pattern. Simplenya nanti kita bekerja pada beberapa folder yang terpisah, seperti Model, Interface, Repository, Service, Controller, dan Request.

## Contoh Kode CRUD Sederhana

* #### #### Model Product

```bash
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}

```

* #### Repository Interface

```bash
<?php

namespace App\Interfaces;

interface RepositoryInterface 
{
  public function findAll();
  public function findById(int $id, array $relations = []);
  public function store(array $data);
  public function update(int $id, array $newData);
  public function delete(int $id);  
}
```

* #### Base Repository

```bash
<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface {
  protected $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function findAll(): Model
  {    
    return $this->model;
  }

  public function findById($id, $relations = []): ?Model
  {
    // find by id
  }

  public function store(array $data): Model
  {    
    // store to database
  }

  public function update($id, array $data): bool
  {
    // update data from database
  }

  public function delete($id): bool
  {
    // delete data from database
  }
}
```

* #### Product Repository

```bash
<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository {
  public function __construct(Product $product)
  {
    parent::__construct($product);
  }
}
```

* #### Product Service

```bash
<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Log;

class ProductService {
  protected $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function findAll($query = "")
  {        
    return $this->productRepository
                ->findAll()
                ->when($query, function($q) use($query) {
                  $q->where('title', 'LIKE', "%$query%")
                  ->orWhereHas('product_category', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                  });
                })->latest()->paginate(10);
  }

  public function findById($id, $relations = []): Product
  {
    // get data by id
  }

  public function store(array $data, array $product_images): Product
  {   
    // store data
  }
  
  public function update($id, array $data, array $product_images): bool
  {
    // update data  
  }

  public function delete($id): bool
  {
    // delete data
  }
}
```

* #### Product Controller

```bash
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $productCategoryService;

    public function __construct(
      ProductService $productService, 
      ProductCategoryService $productCategoryService
    )
    {
      $this->productService = $productService;
      $this->productCategoryService = $productCategoryService;
    }

    public function index(Request $request)
    {                           
        $products = $this->productService->findAll($request["query"]);
        $categories = $this->productCategoryService->findAll();
        
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {        
      // store data
    }

    public function show($id)
    {                
      // show data
    }

    public function update(UpdateProductRequest $request, $id)
    {
      // update data
    }

    public function destroy($id)
    {
      // delete data
    }
}

```

* #### Store Product Request

```bash
<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:products,title|max:100',
            'product_category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required|min:15',
            'thumbnail_img' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'images.*' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
        ];
    }
}
```

* #### Update Product Request

```bash
<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {        
        return [
            'title' => 'required|max:100|unique:products,title,' . $this->product_id,
            'product_category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required|min:15',
            'thumbnail_img' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'images.*' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'product_category_id' => 'product_category',
            'thumbnail_img' => 'thumbnail_image'
        ]; 
    }
}
```
