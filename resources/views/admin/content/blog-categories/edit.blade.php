@extends('admin.layouts.app')

@section('title', 'Edit Blog Category')
@section('page-title', 'Edit Blog Category')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">✏️ Edit Blog Category</h2>
            <p class="text-muted mb-0">Update blog category information</p>
        </div>
        <a href="{{ route('admin.content.blog-categories.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Categories
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('admin.content.blog-categories.update', $blogCategory) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-semibold text-dark">📝 Category Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">
                                📂 Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $blogCategory->name) }}" 
                                   placeholder="Enter category name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">
                                📄 Description
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="Enter category description">{{ old('description', $blogCategory->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        @if($blogCategory->image)
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Current Image</label>
                            <div class="current-image">
                                <img src="{{ asset($blogCategory->image) }}" alt="{{ $blogCategory->name }}" 
                                     class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                            </div>
                        </div>
                        @endif

                        <!-- New Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold text-dark">
                                🖼️ Category Image
                            </label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                @if($blogCategory->image)
                                    Upload a new image to replace the current one
                                @else
                                    Upload an image for this category (optional)
                                @endif
                            </div>
                        </div>

                        <!-- Sort Order -->
                        <div class="mb-4">
                            <label for="sort_order" class="form-label fw-semibold text-dark">
                                🔢 Sort Order
                            </label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $blogCategory->sort_order ?? 0) }}" 
                                   min="0" placeholder="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                Lower numbers appear first
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.content.blog-categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Category
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Category Settings -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">⚙️ Category Settings</h5>
                </div>
                <div class="card-body">
                    <!-- Status -->
                    <div class="mb-3">
                        <input type="hidden" name="status" value="0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" 
                                   value="1" {{ old('status', $blogCategory->status) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold text-dark" for="status">
                                ✅ Active Status
                            </label>
                        </div>
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary"></i>
                            Enable to make this category visible
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Stats -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📊 Category Stats</h5>
                </div>
                <div class="card-body">
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Total Blogs:</span>
                            <span class="fw-semibold">{{ $blogCategory->blogs_count ?? 0 }}</span>
                        </div>
                    </div>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Created:</span>
                            <span class="fw-semibold">{{ $blogCategory->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Last Updated:</span>
                            <span class="fw-semibold">{{ $blogCategory->updated_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-item {
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
}

.stat-item:last-child {
    border-bottom: none;
}

.current-image {
    padding: 10px;
    border: 2px dashed #e2e8f0;
    border-radius: 8px;
    text-align: center;
    background: #f8fafc;
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview
    const imageInput = document.getElementById('image');
    
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Create or update preview
                let preview = document.querySelector('.image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.className = 'image-preview mt-3';
                    imageInput.parentNode.appendChild(preview);
                }
                preview.innerHTML = `
                    <div class="position-relative d-inline-block">
                        <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                        <small class="d-block text-muted mt-2">New image preview</small>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endpush
