@extends('admin.layouts.app')

@section('title', 'Create Blog Post')
@section('page-title', 'Create Blog Post')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">✍️ Create Blog Post</h2>
            <p class="text-muted mb-0">Write and publish a new blog post</p>
        </div>
        <a href="{{ route('admin.content.blogs.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Posts
        </a>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <form action="{{ route('admin.content.blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf
                
                <!-- Basic Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-semibold text-dark">📝 Post Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark">
                                📄 Post Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="Enter an engaging title for your blog post" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                Keep it under 60 characters for better SEO
                            </div>
                        </div>

                        <!-- Slug -->
                        <div class="mb-4">
                            <label for="slug" class="form-label fw-semibold text-dark">
                                🔗 URL Slug <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">{{ url('/blog/') }}/</span>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" value="{{ old('slug') }}" 
                                       placeholder="post-url-slug" required>
                                <button type="button" class="btn btn-outline-secondary" id="generateSlug" title="Generate from title">
                                    <i class="fas fa-magic"></i>
                                </button>
                            </div>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description (Excerpt) -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">
                                📖 Description <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Write a brief summary of your blog post..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                This will be shown in blog listings and social media shares
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="form-label fw-semibold text-dark">
                                📝 Content <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="15" 
                                      placeholder="Write your blog content here..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                You can use HTML tags for formatting
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-semibold text-dark">🖼️ Featured Image</h5>
                    </div>
                    <div class="card-body">
                        <div class="image-upload-container">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div class="image-preview mt-3 d-none" id="imagePreview">
                                <div class="position-relative d-inline-block">
                                    <img src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle" 
                                            id="removeImage" style="transform: translate(50%, -50%);">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary"></i>
                            Upload a compelling featured image for your blog post
                        </div>
                    </div>
                </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Post Settings -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">⚙️ Post Settings</h5>
                </div>
                <div class="card-body">
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="blog_category_id" class="form-label fw-semibold text-dark">
                            📂 Category <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('blog_category_id') is-invalid @enderror" 
                                id="blog_category_id" name="blog_category_id" required form="blogForm">
                            <option value="">Select a category</option>
                            @foreach(\App\Models\BlogCategory::where('status', true)->orderBy('name')->get() as $category)
                                <option value="{{ $category->id }}" {{ old('blog_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('blog_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary"></i>
                            Please select a category for this blog post
                        </div>
                    </div>

                    <!-- Status and Featured -->
                    <div class="mb-3">
                        <input type="hidden" name="status" value="0" form="blogForm">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" 
                                   value="1" {{ old('status', true) ? 'checked' : '' }} form="blogForm">
                            <label class="form-check-label fw-semibold text-dark" for="status">
                                📄 Published Status
                            </label>
                        </div>
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary"></i>
                            Check to publish immediately, uncheck to save as draft
                        </div>
                    </div>

                    <!-- Featured -->
                    <div class="mb-3">
                        <input type="hidden" name="featured" value="0" form="blogForm">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" 
                                   value="1" {{ old('featured') ? 'checked' : '' }} form="blogForm">
                            <label class="form-check-label fw-semibold text-dark" for="featured">
                                ⭐ Featured Post
                            </label>
                        </div>
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary"></i>
                            Featured posts appear prominently on the blog
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="mb-3">
                        <input type="hidden" name="comments_enabled" value="0" form="blogForm">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="comments_enabled" name="comments_enabled" 
                                   value="1" {{ old('comments_enabled', true) ? 'checked' : '' }} form="blogForm">
                            <label class="form-check-label fw-semibold text-dark" for="comments_enabled">
                                💬 Allow Comments
                            </label>
                        </div>
                    </div>

                    <!-- Published Date -->
                    <div class="mb-3">
                        <label for="published_at" class="form-label fw-semibold text-dark">
                            📅 Publish Date
                        </label>
                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                               id="published_at" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" form="blogForm">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary"></i>
                            Leave empty to publish immediately
                        </div>
                    </div>
                </div>
            </div>

                <!-- Form Actions -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.content.blogs.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary" form="blogForm">
                                    <i class="fas fa-save"></i> Create Post
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Writing Tips -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">✍️ Writing Tips</h5>
                </div>
                <div class="card-body">
                    <div class="tip-item mb-3">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-eye text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Engaging Headlines</h6>
                                <small class="text-muted">Create titles that grab attention and include keywords</small>
                            </div>
                        </div>
                    </div>

                    <div class="tip-item mb-3">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-paragraph text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Structure Content</h6>
                                <small class="text-muted">Use headings, bullet points, and short paragraphs</small>
                            </div>
                        </div>
                    </div>

                    <div class="tip-item mb-3">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-image text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Visual Appeal</h6>
                                <small class="text-muted">Add images to break up text and illustrate points</small>
                            </div>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-search text-info"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">SEO Optimization</h6>
                                <small class="text-muted">Include relevant keywords naturally in your content</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.tip-item {
    padding: 12px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.tip-item:hover {
    background-color: rgba(250, 68, 29, 0.05);
}

.image-upload-container {
    position: relative;
}

#content {
    font-family: 'Georgia', serif;
    line-height: 1.6;
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const generateSlugBtn = document.getElementById('generateSlug');
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const removeImageBtn = document.getElementById('removeImage');

    // Auto-generate slug from title
    titleInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.dataset.autoGenerated) {
            generateSlug();
        }
    });

    // Generate slug button
    generateSlugBtn.addEventListener('click', generateSlug);

    function generateSlug() {
        const title = titleInput.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single
            .trim('-'); // Remove leading/trailing hyphens
        
        slugInput.value = slug;
        slugInput.dataset.autoGenerated = 'true';
    }

    // Manual slug editing
    slugInput.addEventListener('input', function() {
        this.dataset.autoGenerated = 'false';
        // Clean up slug input
        this.value = this.value.toLowerCase()
            .replace(/[^a-z0-9-]/g, '')
            .replace(/-+/g, '-');
    });

    // Image preview
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.querySelector('img').src = e.target.result;
                imagePreview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove image
    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreview.classList.add('d-none');
    });

    // Auto-populate excerpt from content
    const contentInput = document.getElementById('content');
    const descriptionInput = document.getElementById('description');
    
    contentInput.addEventListener('blur', function() {
        if (!descriptionInput.value && this.value) {
            // Extract first 150 characters and strip HTML
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = this.value;
            const textContent = tempDiv.textContent || tempDiv.innerText || '';
            descriptionInput.value = textContent.substring(0, 150) + '...';
        }
    });

    // Form validation
    document.getElementById('blogForm').addEventListener('submit', function(e) {
        const title = titleInput.value.trim();
        const content = contentInput.value.trim();
        const description = descriptionInput.value.trim();
        const category = document.getElementById('blog_category_id').value;

        console.log('Form submission values:', {
            title: title,
            content: content,
            description: description,
            category: category
        });

        if (!title) {
            e.preventDefault();
            showToast('Please enter a blog title', 'error');
            titleInput.focus();
            return;
        }

        if (!description) {
            e.preventDefault();
            showToast('Please enter a blog description', 'error');
            descriptionInput.focus();
            return;
        }

        if (!content) {
            e.preventDefault();
            showToast('Please enter blog content', 'error');
            contentInput.focus();
            return;
        }

        if (!category) {
            e.preventDefault();
            showToast('Please select a category', 'error');
            document.getElementById('blog_category_id').focus();
            return;
        }

        // Show loading state
        const submitBtn = e.submitter;
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';
        submitBtn.disabled = true;

        // Reset button after 10 seconds (in case of server error)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 10000);
    });
});
</script>
@endpush
