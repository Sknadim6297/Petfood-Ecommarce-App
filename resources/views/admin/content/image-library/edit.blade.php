@extends('admin.layouts.app')

@section('title', 'Edit File - ' . $image->title)
@section('page-title', 'Edit File')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">✏️ Edit File</h2>
            <p class="text-muted mb-0">Update file information and metadata</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.content.image-library.download', $image) }}" class="btn btn-outline-success">
                <i class="fas fa-download"></i> Download
            </a>
            <a href="{{ route('admin.content.image-library.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Library
            </a>
        </div>
    </div>

    <div class="row">
        <!-- File Preview -->
        <div class="col-lg-5">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">🖼️ File Preview</h5>
                </div>
                <div class="card-body text-center">
                    @if(str_starts_with($image->mime_type, 'image/'))
                        <img src="{{ asset($image->path) }}" alt="{{ $image->title }}" 
                             class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                    @else
                        <div class="py-5">
                            @switch(true)
                                @case(str_contains($image->mime_type, 'pdf'))
                                    <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                                    @break
                                @case(str_contains($image->mime_type, 'word'))
                                    <i class="fas fa-file-word fa-5x text-primary mb-3"></i>
                                    @break
                                @case(str_contains($image->mime_type, 'excel'))
                                    <i class="fas fa-file-excel fa-5x text-success mb-3"></i>
                                    @break
                                @case(str_contains($image->mime_type, 'powerpoint'))
                                    <i class="fas fa-file-powerpoint fa-5x text-warning mb-3"></i>
                                    @break
                                @default
                                    <i class="fas fa-file fa-5x text-muted mb-3"></i>
                            @endswitch
                            <h5 class="text-muted">{{ strtoupper(pathinfo($image->original_name, PATHINFO_EXTENSION)) }} File</h5>
                        </div>
                    @endif
                </div>
            </div>

            <!-- File Information -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📊 File Information</h5>
                </div>
                <div class="card-body">
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between">
                            <strong class="text-dark">Original Name:</strong>
                            <span class="text-muted">{{ $image->original_name }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between">
                            <strong class="text-dark">File Size:</strong>
                            <span class="text-muted">{{ $image->formatted_size }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between">
                            <strong class="text-dark">MIME Type:</strong>
                            <span class="text-muted">{{ $image->mime_type }}</span>
                        </div>
                    </div>

                    @if($image->width && $image->height)
                        <div class="info-item mb-3">
                            <div class="d-flex justify-content-between">
                                <strong class="text-dark">Dimensions:</strong>
                                <span class="text-muted">{{ $image->dimensions }}</span>
                            </div>
                        </div>
                    @endif
                    
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between">
                            <strong class="text-dark">Uploaded:</strong>
                            <span class="text-muted">{{ $image->created_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between">
                            <strong class="text-dark">Uploaded By:</strong>
                            <span class="text-muted">{{ $image->user->name ?? 'Unknown' }}</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="d-flex justify-content-between">
                            <strong class="text-dark">Status:</strong>
                            <span class="badge {{ $image->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $image->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">✏️ Edit File Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.content.image-library.update', $image) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark">
                                📄 Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $image->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                A descriptive title for this file
                            </div>
                        </div>

                        <!-- Alt Text (for images) -->
                        @if(str_starts_with($image->mime_type, 'image/'))
                            <div class="mb-4">
                                <label for="alt_text" class="form-label fw-semibold text-dark">
                                    🏷️ Alt Text
                                </label>
                                <input type="text" class="form-control @error('alt_text') is-invalid @enderror" 
                                       id="alt_text" name="alt_text" value="{{ old('alt_text', $image->alt_text) }}" 
                                       placeholder="Describe what's in the image">
                                @error('alt_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle text-primary"></i>
                                    Important for accessibility and SEO
                                </div>
                            </div>
                        @endif

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">
                                📝 Description
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="Add a detailed description of this file">{{ old('description', $image->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label for="tags" class="form-label fw-semibold text-dark">
                                🏷️ Tags
                            </label>
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                   id="tags" name="tags" value="{{ old('tags', $image->tags) }}" 
                                   placeholder="tag1, tag2, tag3">
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                Separate tags with commas to help organize your files
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" 
                                       value="1" {{ old('status', $image->status) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="status">
                                    ✅ Active Status
                                </label>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                Inactive files won't be visible in the public gallery
                            </div>
                        </div>

                        <!-- Copy URL Section -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                🔗 File URL
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="fileUrl" 
                                       value="{{ asset($image->path) }}" readonly>
                                <button type="button" class="btn btn-outline-primary" id="copyUrlBtn">
                                    <i class="fas fa-copy"></i> Copy
                                </button>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle text-primary"></i>
                                Use this URL to embed the file in your content
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <form action="{{ route('admin.content.image-library.destroy', $image) }}" 
                                      method="POST" class="d-inline" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(event, 'file')">
                                        <i class="fas fa-trash"></i> Delete File
                                    </button>
                                </form>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.content.image-library.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update File
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Usage Information -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📈 Usage Information</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="usage-stat">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-eye fa-2x text-primary"></i>
                                </div>
                                <h4 class="fw-bold text-dark">{{ $image->views ?? 0 }}</h4>
                                <p class="text-muted mb-0">Views</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="usage-stat">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-download fa-2x text-success"></i>
                                </div>
                                <h4 class="fw-bold text-dark">{{ $image->downloads ?? 0 }}</h4>
                                <p class="text-muted mb-0">Downloads</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="usage-stat">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-calendar fa-2x text-info"></i>
                                </div>
                                <h4 class="fw-bold text-dark">{{ $image->created_at->diffForHumans() }}</h4>
                                <p class="text-muted mb-0">Uploaded</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-item {
    padding: 8px 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    border-bottom: none;
}

.usage-stat {
    padding: 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.usage-stat:hover {
    background-color: rgba(250, 68, 29, 0.05);
    transform: translateY(-2px);
}

.stat-icon {
    opacity: 0.8;
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyUrlBtn = document.getElementById('copyUrlBtn');
    const fileUrl = document.getElementById('fileUrl');

    // Copy URL functionality
    copyUrlBtn.addEventListener('click', function() {
        fileUrl.select();
        fileUrl.setSelectionRange(0, 99999); // For mobile devices
        
        navigator.clipboard.writeText(fileUrl.value).then(() => {
            // Update button state
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Copied!';
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-success');
            
            // Reset after 2 seconds
            setTimeout(() => {
                this.innerHTML = originalHTML;
                this.classList.remove('btn-success');
                this.classList.add('btn-outline-primary');
            }, 2000);
            
            showToast('File URL copied to clipboard!', 'success');
        }).catch(() => {
            // Fallback for older browsers
            document.execCommand('copy');
            showToast('File URL copied to clipboard!', 'success');
        });
    });

    // Form validation
    document.getElementById('editForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();

        if (!title) {
            e.preventDefault();
            showToast('Please enter a title for the file', 'error');
            document.getElementById('title').focus();
            return;
        }

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
        submitBtn.disabled = true;

        // Reset button after 5 seconds (in case of server error)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    });
});

// Delete confirmation
function confirmDelete(event, type) {
    event.preventDefault();
    
    if (confirm(`Are you sure you want to delete this ${type}? This action cannot be undone.`)) {
        // Show loading state
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
        btn.disabled = true;
        
        // Submit the form
        event.target.closest('form').submit();
    }
}
</script>
@endpush
