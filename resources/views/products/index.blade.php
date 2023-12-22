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
      <tbody class="table-border-bottom-0 table-body">
        @foreach ($products as $item)
          <input type="hidden" class="product_id" value="{{ $item->id }}">
          <tr>
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
        @endforeach
      </tbody>
    </table>
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
            <textarea class="form-control" id="detail-description" readonly rows="10" cols="30"></textarea>
          </div>
        </div>
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
      <form action="{{ route('products.destroy', 5) }}" method="POST" class="modal-footer d-flex justify-content-center">
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
    
    $(document).ready(function() {
      $('.product-category-select2').select2({
        dropdownParent: $("#createProductModal")
      });

      // Get Achievement Data
      $(".detail-product-data").on("click", function() {          
          $.ajax({
              type: "GET",
              url: `/admin/products/${$(this).closest('.table-body').find('.product_id').val()}`,              
              dataType: "json",
              success: function({data}){
                console.log(data)
                $("#detail-thumbnail").attr("src", `/uploads/products/thumbnails/${data.thumbnail_img}`)
                $("#detail-title").val(data.title)
                $("#detail-category-product").val(data.product_category.name)
                $("#detail-price").val(rupiah(data.price))
                $("#detail-stock").val(data.stock)
                $("#detail-description").html($(data.description).text())

                $("#detail-product-images").html('')
                for(let i = 0; i < data.product_images.length; i++) {
                  $("#detail-product-images").append(`
                    <div class="col-3 mb-4">
                      <img src="/uploads/products/images/${data.product_images[i].image}" class="border" width="100%" alt="">
                    </div>
                  `)            
                }
              }
          });
      })

      // $(".edit-achievement-data").on("click", function() {          
      //     $.ajax({
      //         type: "POST",
      //         url: '/admin/about/achievement/detail',
      //         data: {
      //           "achievement_id": $(this).closest('.table-body').find('.achievement_id').val(),
      //         },
      //         dataType: "json",
      //         success: function(response){
      //           $("#edit-achievement-form").attr("action", `/admin/about/achievement/${response.achievement.id}`)
      //           $("#edit-achievement-img").attr("src", `/uploads/about/achievements/${response.achievement.achievement_img}`)
      //           $("#edit-achievement-title-en").val(response.achievement.title_achievement_en)
      //           $("#edit-achievement-title-id").val(response.achievement.title_achievement_id)
      //           $("#edit-achievement-count").val(response.achievement.count)
      //         }
      //     });
      // })

      // $(".delete-achievement-data").on("click", function() {          
      //     $.ajax({
      //         type: "POST",
      //         url: '/admin/about/achievement/detail',
      //         data: {
      //           "achievement_id": $(this).closest('.table-body').find('.achievement_id').val(),
      //         },
      //         dataType: "json",
      //         success: function(response){
      //           $("#delete-achievement-form").attr("action", `/admin/about/achievement/${response.achievement.id}`)
      //           $("#delete-achievement-title").html(response.achievement.title_achievement_en)
      //           $("#delete-achievement-count").html(response.achievement.count)
      //         }
      //     });
      // })   
    });

    previewImg("create-product-input", "create-product-preview-img")
    previewMultipleImages("create-product-multiple-images", "multiple-preview-images")
    
  </script>
@endpush