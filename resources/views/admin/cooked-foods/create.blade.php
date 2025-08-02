@extends('admin.layouts.app')

@section('title', 'Add New Cooked Food Item')
@section('page-title', 'Add New Cooked Food Item')

@push('styles')
<style>
    .form-section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }
    
    .form-section h5 {
        color: #374151;
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 0.75rem;
        margin-bottom: 1.5rem;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 1.5px solid #e2e8f0;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #fa441d;
        box-shadow: 0 0 0 0.2rem rgba(250, 68, 29, 0.25);
    }
    
    .image-preview {
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        background-color: #fafbfc;
    }
    
    .image-preview:hover {
        border-color: #fa441d;
        background-color: #fff8f5;
    }
    
    .image-preview.has-image {
        border-style: solid;
        border-color: #10b981;
        background-color: #f0fdf4;
    }
    
    .preview-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .category-option {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }
    
    .category-option:hover {
        border-color: #fa441d;
        background-color: #fff8f5;
    }
    
    .category-option.selected {
        border-color: #fa441d;
        background-color: #fa441d;
        color: white;
    }
    
    .category-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .slug-preview {
        font-family: 'Poppins', monospace;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #64748b;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0">Add New Cooked Food Item</h2>
                <p class="text-muted mb-0">Create a new cooked food item for your menu</p>
            </div>
            <a href="{{ route('admin.cooked-foods.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>

        <form action="{{ route('admin.cooked-foods.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-lg-8">
                    <!-- Basic Information -->
                    <div class="form-section">
                        <h5><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Item Name *</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Enter item name"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="slug-preview" id="slugPreview"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">URL Slug</label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug" 
                                           value="{{ old('slug') }}" 
                                           placeholder="Auto-generated from name">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Leave empty to auto-generate from name</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Item Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Describe your cooked food item..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Category Selection -->
                    <div class="form-section">
                        <h5><i class="fas fa-tags me-2"></i>Item Category *</h5>
                        
                        <div class="category-grid">
                            @php
                                $categoryIcons = [
                                    'fish' => 'fas fa-fish',
                                    'chicken' => 'fas fa-drumstick-bite',
                                    'meat' => 'fas fa-hamburger',
                                    'egg' => 'fas fa-egg',
                                    'other' => 'fas fa-utensils'
                                ];
                            @endphp
                            
                            @foreach(\App\Models\CookedFood::getCategories() as $key => $label)
                                <div class="category-option" data-category="{{ $key }}">
                                    <i class="category-icon {{ $categoryIcons[$key] ?? 'fas fa-utensils' }}"></i>
                                    <div class="fw-bold">{{ $label }}</div>
                                </div>
                            @endforeach
                        </div>
                        
                        <input type="hidden" name="category" id="selectedCategory" value="{{ old('category') }}">
                        @error('category')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Price Details -->
                    <div class="form-section">
                        <h5><i class="fas fa-rupee-sign me-2"></i>Price Details</h5>
                        
                        <div class="mb-3">
                            <label for="price" class="form-label">Price (₹) *</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price') }}" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="0.00"
                                       required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Upload Item Image -->
                    <div class="form-section">
                        <h5><i class="fas fa-image me-2"></i>Upload Item Image</h5>
                        
                        <div class="image-preview" id="imagePreview" onclick="document.getElementById('image').click()">
                            <div id="previewContent">
                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">Click to upload image</h6>
                                <p class="text-muted mb-0">JPG, PNG, GIF up to 2MB</p>
                            </div>
                        </div>
                        
                        <input type="file" 
                               class="form-control d-none @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*">
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-section">
                        <h5><i class="fas fa-toggle-on me-2"></i>Status</h5>
                        
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="form-section">
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('admin.cooked-foods.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Create Item
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const slugPreview = document.getElementById('slugPreview');
    
    nameInput.addEventListener('input', function() {
        if (!slugInput.value) {
            const slug = generateSlug(this.value);
            slugPreview.textContent = slug ? `URL: /cooked-foods/${slug}` : '';
        }
    });
    
    slugInput.addEventListener('input', function() {
        const slug = this.value || generateSlug(nameInput.value);
        slugPreview.textContent = slug ? `URL: /cooked-foods/${slug}` : '';
    });
    
    function generateSlug(text) {
        return text.toLowerCase()
                  .trim()
                  .replace(/[^\w\s-]/g, '')
                  .replace(/[\s_-]+/g, '-')
                  .replace(/^-+|-+$/g, '');
    }
    
    // Category selection
    const categoryOptions = document.querySelectorAll('.category-option');
    const selectedCategoryInput = document.getElementById('selectedCategory');
    
    categoryOptions.forEach(option => {
        option.addEventListener('click', function() {
            categoryOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            selectedCategoryInput.value = this.dataset.category;
        });
    });
    
    // Pre-select category if old value exists
    if (selectedCategoryInput.value) {
        const preSelectedOption = document.querySelector(`[data-category="${selectedCategoryInput.value}"]`);
        if (preSelectedOption) {
            preSelectedOption.classList.add('selected');
        }
    }
    
    // Image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewContent = document.getElementById('previewContent');
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.classList.add('has-image');
                previewContent.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="preview-image">
                    <div class="mt-2">
                        <small class="text-muted">${file.name}</small>
                        <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeImage()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }
    });
    
    window.removeImage = function() {
        imageInput.value = '';
        imagePreview.classList.remove('has-image');
        previewContent.innerHTML = `
            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
            <h6 class="text-muted">Click to upload image</h6>
            <p class="text-muted mb-0">JPG, PNG, GIF up to 2MB</p>
        `;
    };
});
</script>
@endpush
