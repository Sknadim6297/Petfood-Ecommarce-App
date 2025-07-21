@extends('admin.layouts.app')

@section('title', 'View Image')
@section('page-title', 'View Image')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">🖼️ View Image</h2>
            <p class="text-muted mb-0">Image details and information</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.content.image-library.edit', $image) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Image
            </a>
            <a href="{{ route('admin.content.image-library.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Library
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Image Preview -->
        <div class="col-lg-8">
            <!-- Main Image Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="image-preview-container mb-3">
                        <img src="{{ asset($image->path) }}" 
                             alt="{{ $image->alt_text }}" 
                             class="img-fluid rounded shadow-sm main-image">
                    </div>
                    
                    <div class="image-actions">
                        <button type="button" class="btn btn-outline-primary me-2" onclick="downloadImage()">
                            <i class="fas fa-download"></i> Download
                        </button>
                        <button type="button" class="btn btn-outline-secondary me-2" onclick="copyImageUrl()">
                            <i class="fas fa-copy"></i> Copy URL
                        </button>
                        <button type="button" class="btn btn-outline-info" onclick="viewFullScreen()">
                            <i class="fas fa-expand"></i> Full Screen
                        </button>
                    </div>
                </div>
            </div>

            <!-- Image Details -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📝 Description & Alt Text</h5>
                </div>
                <div class="card-body">
                    @if($image->description)
                    <div class="mb-3">
                        <label class="fw-semibold text-dark mb-2">📖 Description:</label>
                        <p class="text-muted">{{ $image->description }}</p>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="fw-semibold text-dark mb-2">🏷️ Alt Text:</label>
                        <p class="text-muted">{{ $image->alt_text ?: 'No alt text provided' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">⚡ Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.content.image-library.edit', $image) }}" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Image
                        </a>
                        <button type="button" class="btn btn-outline-primary" onclick="downloadImage()">
                            <i class="fas fa-download"></i> Download
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="copyImageUrl()">
                            <i class="fas fa-copy"></i> Copy URL
                        </button>
                        <form action="{{ route('admin.content.image-library.destroy', $image) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash"></i> Delete Image
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Image Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📋 Image Information</h5>
                </div>
                <div class="card-body">
                    <div class="info-item mb-3">
                        <label class="fw-semibold text-dark">📁 File Name:</label>
                        <p class="mb-0 text-muted small">{{ $image->original_name }}</p>
                    </div>

                    <div class="info-item mb-3">
                        <label class="fw-semibold text-dark">📂 File Type:</label>
                        <span class="badge badge-info">{{ strtoupper($image->file_type) }}</span>
                    </div>

                    <div class="info-item mb-3">
                        <label class="fw-semibold text-dark">📏 Dimensions:</label>
                        <p class="mb-0">{{ $image->width ?? 'N/A' }} × {{ $image->height ?? 'N/A' }} px</p>
                    </div>

                    <div class="info-item mb-3">
                        <label class="fw-semibold text-dark">💾 File Size:</label>
                        <p class="mb-0">{{ formatBytes($image->file_size) }}</p>
                    </div>

                    <div class="info-item mb-3">
                        <label class="fw-semibold text-dark">🔗 File Path:</label>
                        <p class="mb-0 text-muted small word-break">{{ $image->path }}</p>
                    </div>

                    <div class="info-item mb-3">
                        <label class="fw-semibold text-dark">🌐 Public URL:</label>
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control form-control-sm" 
                                   id="imageUrl" 
                                   value="{{ asset($image->path) }}" 
                                   readonly>
                            <button class="btn btn-sm btn-outline-secondary" type="button" onclick="copyImageUrl()">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    <div class="info-item mb-3">
                        <label class="fw-semibold text-dark">👤 Uploaded by:</label>
                        <p class="mb-0">{{ $image->user->name ?? 'Admin' }}</p>
                    </div>
                </div>
            </div>

            <!-- Usage Statistics -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📊 Usage & Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Downloads:</span>
                            <span class="fw-semibold">{{ $image->download_count ?? 0 }}</span>
                        </div>
                    </div>
                    
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Views:</span>
                            <span class="fw-semibold">{{ $image->views_count ?? 0 }}</span>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Uploaded:</span>
                            <span class="fw-semibold">{{ $image->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Last Updated:</span>
                            <span class="fw-semibold">{{ $image->updated_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Full Screen Modal -->
<div class="modal fade" id="fullScreenModal" tabindex="-1" role="dialog" aria-labelledby="fullScreenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="fullScreenModalLabel">{{ $image->original_name }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="{{ asset($image->path) }}" 
                     alt="{{ $image->alt_text }}" 
                     class="img-fluid">
            </div>
        </div>
    </div>
</div>

<style>
.main-image {
    max-height: 600px;
    width: auto;
    object-fit: contain;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.image-preview-container {
    background: #f8fafc;
    border-radius: 12px;
    padding: 2rem;
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.info-item {
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item label {
    display: block;
    margin-bottom: 4px;
}

.stat-item {
    padding: 8px 0;
}

.word-break {
    word-break: break-all;
}

.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-info {
    background-color: #3b82f6;
    color: white;
}

.image-actions .btn {
    margin: 0 4px;
}

.modal-xl {
    max-width: 95vw;
}

.modal-body img {
    max-height: 80vh;
    width: auto;
}

@media (max-width: 768px) {
    .main-image {
        max-height: 400px;
    }
    
    .image-preview-container {
        padding: 1rem;
    }
    
    .image-actions .btn {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }
}
</style>

@php
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }
    
    return round($bytes, $precision) . ' ' . $units[$i];
}
@endphp
@endsection

@push('scripts')
<script>
function downloadImage() {
    const link = document.createElement('a');
    link.href = '{{ asset($image->path) }}';
    link.download = '{{ $image->original_name }}';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Track download
    fetch(`/admin/content/image-library/{{ $image->id }}/download`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
    
    showToast('Image downloaded successfully', 'success');
}

function copyImageUrl() {
    const urlInput = document.getElementById('imageUrl');
    urlInput.select();
    urlInput.setSelectionRange(0, 99999);
    
    try {
        document.execCommand('copy');
        showToast('Image URL copied to clipboard', 'success');
    } catch (err) {
        // Fallback for modern browsers
        navigator.clipboard.writeText(urlInput.value).then(function() {
            showToast('Image URL copied to clipboard', 'success');
        }).catch(function(err) {
            showToast('Failed to copy URL', 'error');
        });
    }
}

function viewFullScreen() {
    const modal = new bootstrap.Modal(document.getElementById('fullScreenModal'));
    modal.show();
}

// Track view
document.addEventListener('DOMContentLoaded', function() {
    fetch(`/admin/content/image-library/{{ $image->id }}/view`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
});
</script>
@endpush
