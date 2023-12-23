@extends('layouts.main')

@section('main')
<div class="card">
  <div class="d-flex justify-content-between align-items-center">
    <h5 class="card-header">Categories</h5>
    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
    data-bs-target="#createCategoryModal">Create New Category</button>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>          
          <th>Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($categories as $item)        
          <tr class="table-body">
            <input type="hidden" class="category_id" value="{{ $item->id }}">
            <td>              
              <span class="fw-medium">{{ $item->name }}</span>
            </td>                    
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item detail-category-data" href="#" data-bs-toggle="modal"
                  data-bs-target="#detailCategoryModal"
                    ><i class="bx bx-file me-1"></i> Detail</a
                  >
                  <a class="dropdown-item edit-category-data" data-bs-toggle="modal"
                  data-bs-target="#editCategoryModal"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item delete-category-data" href="#" data-bs-toggle="modal"
                  data-bs-target="#deleteCategoryModal"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                  >
                </div>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Category not found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="mx-3">
      {{ $categories->links() }}
    </div>
  </div>
</div>

@include('partials.modal-category')
@endsection

@push('js')
<script src="{{ asset('assets/js/custom/categories.js') }}"></script>
@endpush