{{-- Create Category --}}
<div class="modal fade" id="createCategoryModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" action="{{ route('categories.store') }}" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="createCategoryModalTitle">Create New Category</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input
              type="text"
              id="name"
              name="name"
              class="form-control"
              value="{{ old('name') }}"
              required
              placeholder="Enter name category" />
            @error('name')
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

{{-- Detail Category --}}
<div class="modal fade" id="detailCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content">      
      <div class="modal-header">
        <h5 class="modal-title" id="detailCategoryModalTitle">Detail Category</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">      
        <div class="row">
          <div class="col mb-3">
            <label for="" class="form-label">Category Name</label>
            <input
              type="text"
              id="detail-name"
              class="form-control"
              readonly/>
          </div>
        </div>        
      </div>
    </form>
  </div>
</div>

{{-- Edit Category --}}
<div class="modal fade" id="editCategoryModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" action="" id="edit_category_form" method="post">
      @csrf
      @method("PUT")
      <input type="hidden" id="edit_category_id" name="category_id">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalTitle">Edit Category</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="edit-name" class="form-label">Category Name</label>
            <input
              type="text"
              id="edit-name"
              name="name"
              class="form-control"
              required
              placeholder="Enter name category" />
            @error('name')
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

{{-- Delete Category --}}
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCategoryModalTitle">Delete Category</h5>
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
      <form action="" method="POST" id="delete_category_form" class="modal-footer d-flex justify-content-center">
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