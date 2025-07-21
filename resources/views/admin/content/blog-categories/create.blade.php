@extends('admin.layouts.app')

@section('title', 'Create Blog Category')
@section('page-title', 'Create Blog Category')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">➕ Create Blog Category</h2>
            <p class="text-muted mb-0">Add a new category to organize your blog content</p>
        </div>
        <div>
            <a href="{{ route('admin.content.blog-categories.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📝 Category Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.content.blog-categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold text-dark">
                                    🏷️ Category Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sort_order" class="form-label fw-semibold text-dark">
                                    🔢 Sort Order
                                </label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Lower numbers appear first</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold text-dark">
                                📝 Description
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="Enter category description...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold text-dark">
                                🖼️ Category Image
                            </label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Recommended size: 300x300px. Max size: 2MB</small>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <div class="border rounded p-3 bg-light">
                                    <p class="mb-2 fw-semibold text-dark">Image Preview:</p>
                                    <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                       {{ old('status', 1) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="status">
                                    ✅ Active Status
                                </label>
                                <small class="d-block text-muted">When enabled, this category will be visible to users</small>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Category
                            </button>
                            <a href="{{ route('admin.content.blog-categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">💡 Tips</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex">
                                <span class="me-3">🎯</span>
                                <div>
                                    <h6 class="mb-1">Choose a Clear Name</h6>
                                    <p class="mb-0 text-muted small">Use descriptive names that clearly indicate the category content.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex">
                                <span class="me-3">📊</span>
                                <div>
                                    <h6 class="mb-1">Sort Order</h6>
                                    <p class="mb-0 text-muted small">Lower numbers will display first in category lists.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex">
                                <span class="me-3">🖼️</span>
                                <div>
                                    <h6 class="mb-1">Category Image</h6>
                                    <p class="mb-0 text-muted small">Add an attractive image to make your category more appealing.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex">
                                <span class="me-3">✅</span>
                                <div>
                                    <h6 class="mb-1">Status Control</h6>
                                    <p class="mb-0 text-muted small">Toggle the status to control category visibility.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 15px;
}

.form-control:focus {
    border-color: var(--pet-orange);
    box-shadow: 0 0 0 0.2rem rgba(250, 68, 29, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, var(--pet-orange), #e55a4f);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #e55a4f, var(--pet-orange));
    transform: translateY(-1px);
}

.form-check-input:checked {
    background-color: var(--pet-orange);
    border-color: var(--pet-orange);
}

.list-group-item {
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: rgba(250, 68, 29, 0.05);
    border-radius: 8px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Auto-generate slug from name (optional enhancement)
    const nameInput = document.getElementById('name');
    nameInput.addEventListener('input', function() {
        // You can add slug generation logic here if needed
    });
});
</script>
@endsection
