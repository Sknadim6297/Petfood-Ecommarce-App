@extends('admin.layouts.app')

@section('title', 'Image Library')
@section('page-title', 'Image Library')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">🖼️ Image Library</h2>
            <p class="text-muted mb-0">Manage your media files and images</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-danger" id="bulkDeleteBtn" style="display: none;">
                <i class="fas fa-trash"></i> Delete Selected
            </button>
            <a href="{{ route('admin.content.image-library.create') }}" class="btn btn-primary">
                <i class="fas fa-upload"></i> Upload Files
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Total Files</h6>
                        <h2 class="fw-bold mb-0">{{ $images->total() }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-file fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-success text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Images</h6>
                        <h2 class="fw-bold mb-0">{{ \App\Models\ImageLibrary::where('mime_type', 'like', 'image/%')->count() }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-image fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-warning text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Active Files</h6>
                        <h2 class="fw-bold mb-0">{{ \App\Models\ImageLibrary::where('status', true)->count() }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-check-circle fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-info text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Total Size</h6>
                        <h2 class="fw-bold mb-0">{{ number_format(\App\Models\ImageLibrary::sum('size') / (1024 * 1024), 1) }}MB</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-hdd fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.content.image-library.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-dark">🔍 Search Files</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search by title or filename..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">📊 Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">📁 File Type</label>
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="image" {{ request('type') === 'image' ? 'selected' : '' }}>Images</option>
                        <option value="document" {{ request('type') === 'document' ? 'selected' : '' }}>Documents</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">🔄 Sort By</label>
                    <select name="sort_by" class="form-select">
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Date Upload</option>
                        <option value="title" {{ request('sort_by') === 'title' ? 'selected' : '' }}>Title</option>
                        <option value="size" {{ request('sort_by') === 'size' ? 'selected' : '' }}>File Size</option>
                        <option value="original_name" {{ request('sort_by') === 'original_name' ? 'selected' : '' }}>Filename</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('admin.content.image-library.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Images Grid -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold text-dark">🗂️ Media Files</h5>
                <div class="d-flex align-items-center gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll">Select All</label>
                    </div>
                    <span class="badge bg-light text-dark border">{{ $images->total() }} files</span>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            @if($images->count() > 0)
                <div class="row g-3">
                    @foreach($images as $image)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="image-card card h-100 border-0 shadow-sm position-relative" data-id="{{ $image->id }}">
                                <!-- Selection Checkbox -->
                                <div class="position-absolute top-0 start-0 p-2 z-3">
                                    <div class="form-check">
                                        <input class="form-check-input file-checkbox" type="checkbox" value="{{ $image->id }}">
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="position-absolute top-0 end-0 p-2 z-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="{{ $image->id }}" 
                                               {{ $image->status ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <!-- Image/File Preview -->
                                <div class="image-preview bg-light d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;">
                                    @if(str_starts_with($image->mime_type, 'image/'))
                                        <img src="{{ asset($image->path) }}" alt="{{ $image->title }}" 
                                             class="img-fluid" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                                    @else
                                        <div class="text-center">
                                            @switch(true)
                                                @case(str_contains($image->mime_type, 'pdf'))
                                                    <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                    @break
                                                @case(str_contains($image->mime_type, 'word'))
                                                    <i class="fas fa-file-word fa-3x text-primary"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-file fa-3x text-muted"></i>
                                            @endswitch
                                            <div class="mt-2 small text-muted">{{ strtoupper(pathinfo($image->original_name, PATHINFO_EXTENSION)) }}</div>
                                        </div>
                                    @endif
                                </div>

                                <!-- File Info -->
                                <div class="card-body p-2">
                                    <h6 class="card-title mb-1 text-truncate" title="{{ $image->title }}">{{ $image->title }}</h6>
                                    <div class="file-meta">
                                        <small class="text-muted d-block">{{ $image->formatted_size }}</small>
                                        @if($image->width && $image->height)
                                            <small class="text-muted d-block">{{ $image->dimensions }}</small>
                                        @endif
                                        <small class="text-muted d-block">{{ $image->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="card-footer bg-white border-0 p-2">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.content.image-library.show', $image) }}" 
                                           class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.content.image-library.edit', $image) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.content.image-library.download', $image) }}" 
                                           class="btn btn-sm btn-outline-success" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <form action="{{ route('admin.content.image-library.destroy', $image) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn" 
                                                    title="Delete" onclick="confirmDelete(event, 'file')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="pagination-info">
                        <span class="text-muted">
                            Showing {{ $images->firstItem() }} to {{ $images->lastItem() }} of {{ $images->total() }} files
                        </span>
                    </div>
                    <nav>
                        {{ $images->links() }}
                    </nav>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-images fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-3">No files found</h5>
                    <p class="text-muted mb-4">Upload your first file to get started.</p>
                    <a href="{{ route('admin.content.image-library.create') }}" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Files
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, var(--pet-orange), #e55a4f);
}

.bg-gradient-success {
    background: linear-gradient(135deg, var(--pet-green), #16a085);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, var(--pet-yellow), #f39c12);
}

.bg-gradient-info {
    background: linear-gradient(135deg, var(--pet-blue), #3498db);
}

.image-card {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.image-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.image-preview {
    border-radius: 12px 12px 0 0;
}

.status-toggle {
    transform: scale(0.9);
}

.file-checkbox {
    transform: scale(1.1);
}

.image-card.selected {
    border: 2px solid var(--pet-orange);
    box-shadow: 0 0 0 0.2rem rgba(250, 68, 29, 0.25);
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const fileCheckboxes = document.querySelectorAll('.file-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        fileCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            toggleCardSelection(checkbox);
        });
        toggleBulkDeleteButton();
    });

    // Individual checkbox functionality
    fileCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            toggleCardSelection(this);
            toggleBulkDeleteButton();
            
            // Update select all checkbox
            const checkedCount = document.querySelectorAll('.file-checkbox:checked').length;
            selectAllCheckbox.checked = checkedCount === fileCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < fileCheckboxes.length;
        });
    });

    // Toggle card selection visual
    function toggleCardSelection(checkbox) {
        const card = checkbox.closest('.image-card');
        if (checkbox.checked) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    }

    // Toggle bulk delete button visibility
    function toggleBulkDeleteButton() {
        const checkedCount = document.querySelectorAll('.file-checkbox:checked').length;
        if (checkedCount > 0) {
            bulkDeleteBtn.style.display = 'block';
            bulkDeleteBtn.innerHTML = `<i class="fas fa-trash"></i> Delete Selected (${checkedCount})`;
        } else {
            bulkDeleteBtn.style.display = 'none';
        }
    }

    // Bulk delete functionality
    bulkDeleteBtn.addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.file-checkbox:checked'))
                                .map(checkbox => checkbox.value);
        
        if (selectedIds.length === 0) {
            showToast('Please select files to delete', 'warning');
            return;
        }

        if (confirm(`Are you sure you want to delete ${selectedIds.length} selected file(s)?`)) {
            fetch('{{ route("admin.content.image-library.bulk-delete") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ ids: selectedIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    // Remove selected cards from DOM
                    selectedIds.forEach(id => {
                        const card = document.querySelector(`[data-id="${id}"]`);
                        if (card) card.remove();
                    });
                    // Reset UI
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                    toggleBulkDeleteButton();
                } else {
                    showToast('Failed to delete files', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred', 'error');
            });
        }
    });

    // Status toggle functionality
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const imageId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/admin/content/image-library/${imageId}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                } else {
                    showToast('Failed to update status', 'error');
                    this.checked = !isActive; // Revert the toggle
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred', 'error');
                this.checked = !isActive; // Revert the toggle
            });
        });
    });
});
</script>
@endpush
