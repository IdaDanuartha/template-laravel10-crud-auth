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
        @foreach ($products as $item)
          <tr>
            <td>              
              <span class="fw-medium">{{ $item->title }}</span>
            </td>
            <td>{{ $item->product_category->name }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->stock }}</td>            
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('products.edit', $item->id) }}"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item" href="#"
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

<div class="modal fade" id="createProductModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content">
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
            <label for="title" class="form-label">Title Product</label>
            <input
              type="text"
              id="title"
              name="title"
              class="form-control"
              placeholder="Enter title product" />
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="product_category_id" class="form-label">Category</label>
            <select class="product-category-select2 form-control" name="product_category_id">
              <option value="AL">Alabama</option>                
              <option value="WY">Wyoming</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="price" class="form-label">Price</label>
            <input
              type="number"
              id="price"
              name="price"
              class="form-control"
              placeholder="Enter price product" />
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input
              type="number"
              id="stock"
              name="stock"
              class="form-control"
              placeholder="Enter stock product" />
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="create_description" class="form-label">Description</label>
            <textarea name="description" id="create_description" class="rte-editor"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </form>
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
    });
  </script>
@endpush