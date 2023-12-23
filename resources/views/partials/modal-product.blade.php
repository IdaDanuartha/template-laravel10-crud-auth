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