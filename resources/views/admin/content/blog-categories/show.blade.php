@extends('admin.layouts.app')

@section('title', 'View Blog Category')
@section('page-title', 'View Blog Category')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">👁️ View Blog Category</h2>
            <p class="text-muted mb-0">Category details and associated blogs</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.content.blog-categories.edit', $blogCategory) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Category
            </a>
            <a href="{{ route('admin.content.blog-categories.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Category Details -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📝 Category Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="detail-item mb-3">
                                <label class="fw-semibold text-dark">📂 Category Name:</label>
                                <p class="mb-0">{{ $blogCategory->name }}</p>
                            </div>

                            <div class="detail-item mb-3">
                                <label class="fw-semibold text-dark">🔗 Slug:</label>
                                <p class="mb-0 text-muted">{{ $blogCategory->slug }}</p>
                            </div>

                            @if($blogCategory->description)
                            <div class="detail-item mb-3">
                                <label class="fw-semibold text-dark">📄 Description:</label>
                                <p class="mb-0">{{ $blogCategory->description }}</p>
                            </div>
                            @endif

                            <div class="detail-item mb-3">
                                <label class="fw-semibold text-dark">✅ Status:</label>
                                <span class="badge badge-{{ $blogCategory->status ? 'success' : 'secondary' }}">
                                    {{ $blogCategory->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <div class="detail-item mb-3">
                                <label class="fw-semibold text-dark">🔢 Sort Order:</label>
                                <p class="mb-0">{{ $blogCategory->sort_order ?? 0 }}</p>
                            </div>
                        </div>

                        @if($blogCategory->image)
                        <div class="col-md-4">
                            <div class="category-image text-center">
                                <label class="fw-semibold text-dark d-block mb-2">🖼️ Category Image:</label>
                                <img src="{{ asset($blogCategory->image) }}" alt="{{ $blogCategory->name }}" 
                                     class="img-thumbnail" style="max-width: 100%; max-height: 200px;">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Associated Blogs -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold text-dark">📚 Associated Blogs ({{ $blogCategory->blogs->count() }})</h5>
                    <a href="{{ route('admin.content.blogs.create') }}?category={{ $blogCategory->id }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus"></i> Add Blog
                    </a>
                </div>
                <div class="card-body">
                    @if($blogCategory->blogs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Published</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogCategory->blogs as $blog)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($blog->image)
                                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" 
                                                         class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ Str::limit($blog->title, 40) }}</h6>
                                                    <small class="text-muted">{{ Str::limit($blog->description, 60) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $blog->status ? 'success' : 'secondary' }}">
                                                {{ $blog->status ? 'Published' : 'Draft' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($blog->featured)
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-star"></i> Featured
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $blog->published_at->format('M j, Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.content.blogs.show', $blog) }}" 
                                                   class="btn btn-outline-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.content.blogs.edit', $blog) }}" 
                                                   class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-blog text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">No blogs in this category</h5>
                            <p class="text-muted">Create your first blog post for this category.</p>
                            <a href="{{ route('admin.content.blogs.create') }}?category={{ $blogCategory->id }}" 
                               class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Blog Post
                            </a>
                        </div>
                    @endif
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
                        <a href="{{ route('admin.content.blog-categories.edit', $blogCategory) }}" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Category
                        </a>
                        <a href="{{ route('admin.content.blogs.create') }}?category={{ $blogCategory->id }}" 
                           class="btn btn-success">
                            <i class="fas fa-plus"></i> Add New Blog
                        </a>
                        <button type="button" class="btn btn-{{ $blogCategory->status ? 'warning' : 'success' }}" 
                                onclick="toggleStatus({{ $blogCategory->id }})">
                            <i class="fas fa-{{ $blogCategory->status ? 'pause' : 'play' }}"></i> 
                            {{ $blogCategory->status ? 'Deactivate' : 'Activate' }}
                        </button>
                        <form action="{{ route('admin.content.blog-categories.destroy', $blogCategory) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash"></i> Delete Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Category Statistics -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📊 Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Total Blogs:</span>
                            <span class="fw-semibold text-primary">{{ $blogCategory->blogs->count() }}</span>
                        </div>
                    </div>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Published Blogs:</span>
                            <span class="fw-semibold text-success">{{ $blogCategory->blogs->where('status', true)->count() }}</span>
                        </div>
                    </div>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Draft Blogs:</span>
                            <span class="fw-semibold text-warning">{{ $blogCategory->blogs->where('status', false)->count() }}</span>
                        </div>
                    </div>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Featured Blogs:</span>
                            <span class="fw-semibold text-info">{{ $blogCategory->blogs->where('featured', true)->count() }}</span>
                        </div>
                    </div>
                    <hr>
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
.detail-item {
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item label {
    display: block;
    margin-bottom: 4px;
}

.stat-item {
    padding: 8px 0;
}

.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-success {
    background-color: #10b981;
    color: white;
}

.badge-secondary {
    background-color: #6b7280;
    color: white;
}

.badge-warning {
    background-color: #f59e0b;
    color: white;
}

.badge-info {
    background-color: #3b82f6;
    color: white;
}
</style>
@endsection

@push('scripts')
<script>
function toggleStatus(categoryId) {
    fetch(`/admin/content/blog-categories/${categoryId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showToast('Failed to update status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred', 'error');
    });
}
</script>
@endpush
