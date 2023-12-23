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

@include('partials.modal-product')
@endsection

@push('js')
<script src="{{ asset('assets/js/custom/products.js') }}"></script>
@endpush