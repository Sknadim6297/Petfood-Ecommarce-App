@extends('admin.layouts.app')

@section('title', 'Blog Categories')
@section('page-title', 'Blog Categories')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">🗂️ Blog Categories</h2>
            <p class="text-muted mb-0">Manage your blog categories and organize content</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.content.blog-categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Total Categories</h6>
                        <h2 class="fw-bold mb-0">{{ $categories->total() }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-folder fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-success text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Active Categories</h6>
                        <h2 class="fw-bold mb-0">{{ \App\Models\BlogCategory::where('status', true)->count() }}</h2>
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
            <div class="card border-0 shadow-sm h-100 bg-gradient-warning text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Inactive Categories</h6>
                        <h2 class="fw-bold mb-0">{{ \App\Models\BlogCategory::where('status', false)->count() }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-pause-circle fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-info text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Total Blog Posts</h6>
                        <h2 class="fw-bold mb-0">{{ \App\Models\Blog::count() }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-blog fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.content.blog-categories.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-dark">🔍 Search Categories</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search by name or description..." value="{{ request('search') }}">
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
                    <label class="form-label fw-semibold text-dark">🔄 Sort By</label>
                    <select name="sort_by" class="form-select">
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Date Created</option>
                        <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>Name</option>
                        <option value="sort_order" {{ request('sort_by') === 'sort_order' ? 'selected' : '' }}>Sort Order</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">📈 Order</label>
                    <select name="sort_order" class="form-select">
                        <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="asc" {{ request('sort_order') === 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('admin.content.blog-categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold text-dark">📂 Categories List</h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark border">{{ $categories->total() }} total</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 text-dark fw-semibold">Status</th>
                                <th class="border-0 text-dark fw-semibold">Category</th>
                                <th class="border-0 text-dark fw-semibold text-center">Blog Count</th>
                                <th class="border-0 text-dark fw-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr class="border-bottom">
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" 
                                                   data-id="{{ $category->id }}" 
                                                   {{ $category->status ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                {!! $category->status_badge !!}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="category-image me-3">
                                                @if($category->image)
                                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" 
                                                         class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-folder text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-semibold text-dark">{{ $category->name }}</h6>
                                                @if($category->description)
                                                    <p class="mb-0 text-muted small">{{ Str::limit($category->description, 60) }}</p>
                                                @endif
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-alt"></i> {{ $category->created_at->format('M d, Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                                            {{ $category->blogs_count ?? 0 }} posts
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.content.blog-categories.show', $category) }}" 
                                               class="btn btn-sm btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.content.blog-categories.edit', $category) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.content.blog-categories.destroy', $category) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-btn" 
                                                        title="Delete" onclick="confirmDelete(event, 'category')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <div class="pagination-info">
                        <span class="text-muted">
                            Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
                        </span>
                    </div>
                    <nav>
                        {{ $categories->links() }}
                    </nav>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-folder fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-3">No blog categories found</h5>
                    <p class="text-muted mb-4">Get started by creating your first blog category.</p>
                    <a href="{{ route('admin.content.blog-categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Category
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

.table tbody tr:hover {
    background-color: rgba(250, 68, 29, 0.05);
}

.status-toggle {
    transform: scale(1.2);
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle functionality
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const categoryId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/admin/content/blog-categories/${categoryId}/toggle-status`, {
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
                    // Update the badge
                    const badge = this.parentElement.querySelector('.badge');
                    if (data.status) {
                        badge.className = 'badge bg-success';
                        badge.textContent = 'Active';
                    } else {
                        badge.className = 'badge bg-danger';
                        badge.textContent = 'Inactive';
                    }
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
