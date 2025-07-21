@extends('admin.layouts.app')

@section('title', 'Manage Blogs')
@section('page-title', 'Manage Blogs')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">📝 Manage Blogs</h2>
            <p class="text-muted mb-0">Create and manage your blog posts</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.content.blogs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Blog Post
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Total Blog Posts</h6>
                        <h2 class="fw-bold mb-0">{{ $blogs->total() }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-blog fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-success text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Published Posts</h6>
                        <h2 class="fw-bold mb-0">{{ \App\Models\Blog::where('status', true)->whereNotNull('published_at')->count() }}</h2>
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
                        <h6 class="text-white-50 mb-2">Draft Posts</h6>
                        <h2 class="fw-bold mb-0">{{ \App\Models\Blog::where('status', false)->orWhereNull('published_at')->count() }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-file-alt fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient-info text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 mb-2">Total Views</h6>
                        <h2 class="fw-bold mb-0">{{ \App\Models\Blog::sum('views_count') }}</h2>
                    </div>
                    <div class="ms-3">
                        <div class="icon-circle bg-white bg-opacity-20">
                            <i class="fas fa-eye fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.content.blogs.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-dark">🔍 Search Blog Posts</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search by title or content..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">📊 Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Published</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">📂 Category</label>
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">⭐ Featured</label>
                    <select name="featured" class="form-select">
                        <option value="">All Posts</option>
                        <option value="yes" {{ request('featured') === 'yes' ? 'selected' : '' }}>Featured</option>
                        <option value="no" {{ request('featured') === 'no' ? 'selected' : '' }}>Not Featured</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">🔄 Sort By</label>
                    <select name="sort_by" class="form-select">
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Date Created</option>
                        <option value="title" {{ request('sort_by') === 'title' ? 'selected' : '' }}>Title</option>
                        <option value="views_count" {{ request('sort_by') === 'views_count' ? 'selected' : '' }}>Views</option>
                        <option value="published_at" {{ request('sort_by') === 'published_at' ? 'selected' : '' }}>Published Date</option>
                    </select>
                </div>

                <div class="col-md-1">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i>
                        </button>
                        <a href="{{ route('admin.content.blogs.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Blog Posts Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold text-dark">📝 Blog Posts</h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark border">{{ $blogs->total() }} total</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($blogs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 text-dark fw-semibold">Sl No.</th>
                                <th class="border-0 text-dark fw-semibold">Status</th>
                                <th class="border-0 text-dark fw-semibold">Image</th>
                                <th class="border-0 text-dark fw-semibold">Title</th>
                                <th class="border-0 text-dark fw-semibold">Description</th>
                                <th class="border-0 text-dark fw-semibold text-center">No. Of Views</th>
                                <th class="border-0 text-dark fw-semibold">Added Date</th>
                                <th class="border-0 text-dark fw-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $index => $blog)
                                <tr class="border-bottom">
                                    <td>
                                        <span class="fw-semibold text-muted">
                                            {{ $blogs->firstItem() + $index }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-toggle" type="checkbox" 
                                                       data-id="{{ $blog->id }}" 
                                                       {{ $blog->status ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {!! $blog->status_badge !!}
                                                </label>
                                            </div>
                                            @if($blog->featured)
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                                    <i class="fas fa-star"></i> Featured
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="blog-image">
                                            @if($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" 
                                                     class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="blog-info">
                                            <h6 class="mb-1 fw-semibold text-dark">{{ Str::limit($blog->title, 40) }}</h6>
                                            <div class="d-flex align-items-center gap-2 text-muted small">
                                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                                                    {{ $blog->category->name }}
                                                </span>
                                                <span>by {{ $blog->user->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-muted">{{ Str::limit($blog->description, 80) }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="fw-bold text-dark">{{ number_format($blog->views_count) }}</span>
                                            <small class="text-muted">views</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <div class="fw-semibold text-dark">{{ $blog->created_at->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ $blog->created_at->format('h:i A') }}</small>
                                            @if($blog->published_at)
                                                <div class="text-success small">
                                                    <i class="fas fa-check-circle"></i> Published
                                                </div>
                                            @else
                                                <div class="text-warning small">
                                                    <i class="fas fa-clock"></i> Draft
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.content.blogs.show', $blog) }}" 
                                               class="btn btn-sm btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.content.blogs.edit', $blog) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-primary featured-toggle" 
                                                    data-id="{{ $blog->id }}" title="Toggle Featured">
                                                <i class="fas fa-star {{ $blog->featured ? 'text-warning' : '' }}"></i>
                                            </button>
                                            <form action="{{ route('admin.content.blogs.destroy', $blog) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-btn" 
                                                        title="Delete" onclick="confirmDelete(event, 'blog post')">
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
                            Showing {{ $blogs->firstItem() }} to {{ $blogs->lastItem() }} of {{ $blogs->total() }} results
                        </span>
                    </div>
                    <nav>
                        {{ $blogs->links() }}
                    </nav>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-blog fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-3">No blog posts found</h5>
                    <p class="text-muted mb-4">Get started by creating your first blog post.</p>
                    <a href="{{ route('admin.content.blogs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Blog Post
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

.featured-toggle:hover {
    background-color: var(--pet-yellow);
    border-color: var(--pet-yellow);
    color: white;
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle functionality
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const blogId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/admin/content/blogs/${blogId}/toggle-status`, {
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

    // Featured toggle functionality
    document.querySelectorAll('.featured-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const blogId = this.dataset.id;
            const starIcon = this.querySelector('i');
            
            fetch(`/admin/content/blogs/${blogId}/toggle-featured`, {
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
                    // Update the star icon
                    if (data.featured) {
                        starIcon.classList.add('text-warning');
                    } else {
                        starIcon.classList.remove('text-warning');
                    }
                } else {
                    showToast('Failed to update featured status', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred', 'error');
            });
        });
    });
});
</script>
@endpush
