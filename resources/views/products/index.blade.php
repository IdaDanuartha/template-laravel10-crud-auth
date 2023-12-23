@extends('layouts.main')

@section('main')
<div class="card">
  <div class="d-flex justify-content-between align-items-center">
    <h5 class="card-header">Products</h5>
    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
    data-bs-target="#createProductModal">Create New Product</button>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($products as $item)        
          <tr class="table-body">
            <input type="hidden" class="product_id" value="{{ $item->id }}">
            <td>              
              <span class="fw-medium">{{ $item->title }}</span>
            </td>
            <td>{{ $item->product_category->name }}</td>
            <td>Rp. @rupiah($item->price)</td>
            <td>{{ $item->stock }}</td>            
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item detail-product-data" href="#" data-bs-toggle="modal"
                  data-bs-target="#detailProductModal"
                    ><i class="bx bx-file me-1"></i> Detail</a
                  >
                  <a class="dropdown-item edit-product-data" data-bs-toggle="modal"
                  data-bs-target="#editProductModal"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item delete-product-data" href="#" data-bs-toggle="modal"
                  data-bs-target="#deleteProductModal"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                  >
                </div>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Product not found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="mx-3">
      {{ $products->links() }}
    </div>
  </div>
</div>

{{-- Create Product --}}
<div class="modal fade" id="createProductModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="createProductModalTitle">Create New Product</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="thumbnail_img" class="form-label">Thumbnail</label>
            <label for="thumbnail_img" class="d-block mb-3">
              <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-product-preview-img border" width="300" alt="">
            </label>
            <input
              type="file"
              id="thumbnail_img"
              name="thumbnail_img"
              class="form-control create-product-input"
              required
              />
            @error('thumbnail_img')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="images" class="form-label">Product Images (Upload multiple images)</label>
            <div class="row multiple-preview-images mb-3">
              <label for="images" class="col-3">
                <img src="{{ asset('assets/img/upload-image.jpg') }}" class="border" width="100%" alt="">
              </label>
            </div>
            <input
              type="file"
              id="images"
              name="images[]"
              class="form-control create-product-multiple-images"
              required
              multiple
              />
            @error('images')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="title" class="form-label">Title Product</label>
            <input
              type="text"
              id="title"
              name="title"
              class="form-control"
              value="{{ old('title') }}"
              required
              placeholder="Enter title product" />
            @error('title')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="product_category_id" class="form-label">Category</label>
            <select required class="product-category-select2 form-control" name="product_category_id">
              <option value="">Select Category</option>
              @foreach ($categories as $item)
                @if (old('product_category_id') === $item->id)
                  <option value="{{$item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{$item->id }}">{{ $item->name }}</option>  
                @endif
              @endforeach
            </select>
            @error('product_category_id')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="price" class="form-label">Price</label>
            <input
              type="number"
              id="price"
              name="price"
              class="form-control"
              value="{{ old('price') }}"
              required
              placeholder="Enter price product" />
            @error('price')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="col">
            <label for="stock" class="form-label">Stock</label>
            <input
              type="number"
              id="stock"
              name="stock"
              class="form-control"
              value="{{ old('stock') }}"
              required
              placeholder="Enter stock product" />
            @error('stock')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="create_description" class="form-label">Description</label>
            <textarea required name="description" id="create_description" class="rte-editor">{{ old('description') }}</textarea>
            @error('description')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

{{-- Detail Product --}}
<div class="modal fade" id="detailProductModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content">      
      <div class="modal-header">
        <h5 class="modal-title" id="detailProductModalTitle">Detail Product</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="" class="form-label">Thumbnail</label>
            <div class="d-block mb-3">
              <img src="{{ asset('assets/img/upload-image.jpg') }}" id="detail-thumbnail" class="create-product-preview-img border" width="300" alt="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="" class="form-label">Product Images</label>
            <div class="row multiple-preview-images mb-3" id="detail-product-images">
              <div class="col-3">
                <img src="{{ asset('assets/img/upload-image.jpg') }}" class="border" width="100%" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="" class="form-label">Title Product</label>
            <input
              type="text"
              id="detail-title"
              class="form-control"
              readonly/>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="" class="form-label">Category</label>
            <input
              type="text"
              id="detail-category-product"
              class="form-control"
              readonly/>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="" class="form-label">Price</label>
            <input
              type="text"
              id="detail-price"
              class="form-control"
              readonly/>
          </div>
          <div class="col">
            <label for="" class="form-label">Stock</label>
            <input
              type="text"
              id="detail-stock"              
              class="form-control"              
              readonly/>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="" class="form-label">Description</label>
            <textarea id="detail_description" class="rte-editor"></textarea>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Edit Product --}}
<div class="modal fade" id="editProductModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" action="" id="edit_product_form" method="post" enctype="multipart/form-data">
      @csrf
      @method("PUT")
      <input type="hidden" id="edit_product_id" name="product_id">
      <input type="hidden" class="image_deleted" name="image_deleted">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductModalTitle">Edit Product</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="edit_thumbnail" class="form-label">Thumbnail</label>
            <label for="edit_thumbnail" class="d-block mb-3">
              <img id="edit_thumbnail_img" src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-product-preview-img border" width="300" alt="">
            </label>
            <input
              type="file"  
              id="edit_thumbnail"            
              name="thumbnail_img"
              class="form-control edit-product-input"
              />
            @error('thumbnail_img')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="edit_product_images" class="form-label">Product Images (Upload multiple images)</label>
            <div class="row edit-multiple-preview-images mb-3">
              <label for="edit_product_images" class="col-3">
                <img src="{{ asset('assets/img/upload-image.jpg') }}" class="border" width="100%" alt="">
              </label>
            </div>
            <label for="edit_product_images" class="form-label">Preview New Images :</label>
            <div class="row edit-multiple-preview-images-new mb-3">
              <label for="edit_product_images" class="col-3">
                <img src="{{ asset('assets/img/upload-image.jpg') }}" class="border" width="100%" alt="">
              </label>
            </div>
            <input
              type="file"              
              name="images[]"
              id="edit_product_images"
              class="form-control edit-product-multiple-images"
              multiple
              />
            @error('images')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="edit_title" class="form-label">Title Product</label>
            <input
              type="text"
              id="edit_title"
              name="title"
              class="form-control"
              required
              placeholder="Enter title product" />
            @error('title')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="product_category_id" class="form-label">Category</label>
            <select id="edit_category_product" required class="product-category-select2 form-control" name="product_category_id">              
            </select>
            @error('product_category_id')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="edit_price" class="form-label">Price</label>
            <input
              type="number"
              id="edit_price"
              name="price"
              class="form-control"
              required
              placeholder="Enter price product" />
            @error('price')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="col">
            <label for="edit_stock" class="form-label">Stock</label>
            <input
              type="number"
              id="edit_stock"
              name="stock"
              class="form-control"
              required
              placeholder="Enter stock product" />
            @error('stock')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="edit_description" class="form-label">Description</label>
            <textarea required name="description" id="edit_description" class="rte-editor"></textarea>
            @error('description')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

{{-- Delete Product --}}
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteProductModalTitle">Delete Product</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">  
        <p>Do you really want to delete this data? This process cannot be
          undone.</p>      
      </div>
      <form action="" method="POST" id="delete_product_form" class="modal-footer d-flex justify-content-center">
        @csrf
        @method("DELETE")
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-primary">Delete</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script>
    let editor1 = new RichTextEditor("#create_description");
    let editor2 = new RichTextEditor("#edit_description");
    let editor3 = new RichTextEditor("#detail_description");
    
    $(document).ready(function() {
      $('.product-category-select2').select2({
        dropdownParent: $("#createProductModal")
      });

      $(".detail-product-data").on("click", function() {          
        $.ajax({
            type: "GET",
            url: `/admin/products/${$(this).closest('.table-body').find('.product_id').val()}`,              
            dataType: "json",
            success: function({product, categories}){
              $("#detail-thumbnail").attr("src", `/uploads/products/thumbnails/${product.thumbnail_img}`)
              $("#detail-title").val(product.title)
              $("#detail-category-product").val(product.product_category.name)
              $("#detail-price").val(rupiah(product.price))
              $("#detail-stock").val(product.stock)

              editor3.setReadOnly(true);    
              editor3.setHTMLCode(product.description)          

              $("#detail-product-images").html('')
              for(let i = 0; i < product.product_images.length; i++) {
                $("#detail-product-images").append(`
                  <div class="col-3 mb-4">
                    <img src="/uploads/products/images/${product.product_images[i].image}" class="border" width="100%" alt="">
                  </div>
                `)            
              }
            }
        })
      })

      $(".edit-product-data").on("click", function() { 
        const product_id = $(this).closest('.table-body').find('.product_id').val()     
        $.ajax({
          type: "GET",
          url: `/admin/products/${product_id}`,
          dataType: "json",
          success: function({product, categories}){            
            $("#edit_product_form").attr("action", `/admin/products/${product_id}`)
            $("#edit_thumbnail_img").attr("src", `/uploads/products/thumbnails/${product.thumbnail_img}`)
            $("#edit_product_id").val(product.id)
            $("#edit_title").val(product.title)            
            $("#edit_price").val(product.price)
            $("#edit_stock").val(product.stock)
            editor2.setHTMLCode(product.description)
            
            categories.forEach(category => {
              if(category.id == product.product_category.id) {
                $("#edit_category_product").append(`
                  <option value="${category.id}" selected>
                      ${category.name}
                  </option>
              `)
              } else {
                $("#edit_category_product").append(`
                  <option value="${category.id}">
                      ${category.name}
                  </option>
              `)
              }
            });
                            
            $(".edit-multiple-preview-images").html('')
            for(let i = 0; i < product.product_images.length; i++) {
              $(".edit-multiple-preview-images").append(`
                <div class="col-3 mb-4 position-relative">
                  <i class="bx bx-x position-absolute text-dark fa-lg delete-img-icon" data-id="${product.product_images[i].id}" style="right: 15px; cursor: pointer;"></i>
                  <img src="/uploads/products/images/${product.product_images[i].image}" class="border" width="100%" alt="">
                </div>
              `)            
            }

            $(".delete-img-icon").on('click', function() {
              $(this).parent().remove()

              let oldValue = $(".image_deleted").val()
              let arr = oldValue === "" ? [] : oldValue.split(',');
              arr.push($(this).data('id'));
              let newValue = arr.join(',');

              $(".image_deleted").val(newValue)

              console.log($(".image_deleted").val())
            })
          }
        })
      })

      $(".delete-product-data").on("click", function() { 
        const product_id = $(this).closest('.table-body').find('.product_id').val()     
        $.ajax({
          type: "GET",
          url: `/admin/products/${product_id}`,
          dataType: "json",
          success: function({product}){            
            console.log(product)
            $("#delete_product_form").attr("action", `/admin/products/${product.id}`)
          }
        })
      })
    })

    previewImg("create-product-input", "create-product-preview-img")
    previewImg("edit-product-input", "edit-product-preview-img")
    previewMultipleImages("create-product-multiple-images", "multiple-preview-images")
    previewMultipleImages("edit-product-multiple-images", "edit-multiple-preview-images-new")
    
  </script>
@endpush