@extends('admin.layouts.app')

@section('title', 'View Blog Post')
@section('page-title', 'View Blog Post')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">👁️ View Blog Post</h2>
            <p class="text-muted mb-0">Blog post details and content</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.content.blogs.edit', $blog) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Post
            </a>
            <a href="{{ route('admin.content.blogs.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Posts
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Blog Content -->
        <div class="col-lg-8">
            <!-- Blog Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge badge-{{ $blog->status ? 'success' : 'secondary' }}">
                            {{ $blog->status ? 'Published' : 'Draft' }}
                        </span>
                        @if($blog->featured)
                            <span class="badge badge-warning">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                    </div>

                    <h1 class="fw-bold text-dark mb-3">{{ $blog->title }}</h1>
                    
                    <div class="blog-meta mb-4">
                        <div class="d-flex flex-wrap gap-3">
                            <div class="meta-item">
                                <i class="fas fa-folder text-primary"></i>
                                <span class="ms-1">{{ $blog->category->name }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-user text-primary"></i>
                                <span class="ms-1">{{ $blog->user->name ?? 'Admin' }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar text-primary"></i>
                                <span class="ms-1">{{ $blog->published_at->format('F j, Y') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-eye text-primary"></i>
                                <span class="ms-1">{{ $blog->views_count ?? 0 }} views</span>
                            </div>
                            @if($blog->comments_enabled)
                            <div class="meta-item">
                                <i class="fas fa-comments text-primary"></i>
                                <span class="ms-1">Comments Enabled</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($blog->image)
                    <div class="featured-image mb-4">
                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" 
                             class="img-fluid rounded shadow-sm">
                    </div>
                    @endif

                    <div class="blog-description mb-4">
                        <h5 class="fw-semibold text-dark mb-2">📖 Description</h5>
                        <p class="text-muted">{{ $blog->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Blog Content -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📝 Content</h5>
                </div>
                <div class="card-body">
                    <div class="blog-content">
                        {!! $blog->content !!}
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
                        <a href="{{ route('admin.content.blogs.edit', $blog) }}" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Post
                        </a>
                        <button type="button" class="btn btn-{{ $blog->status ? 'warning' : 'success' }}" 
                                onclick="toggleStatus({{ $blog->id }})">
                            <i class="fas fa-{{ $blog->status ? 'pause' : 'play' }}"></i> 
                            {{ $blog->status ? 'Unpublish' : 'Publish' }}
                        </button>
                        <button type="button" class="btn btn-{{ $blog->featured ? 'outline-warning' : 'warning' }}" 
                                onclick="toggleFeatured({{ $blog->id }})">
                            <i class="fas fa-star"></i> 
                            {{ $blog->featured ? 'Unfeature' : 'Feature' }}
                        </button>
                        <form action="{{ route('admin.content.blogs.destroy', $blog) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this blog post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash"></i> Delete Post
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Post Details -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📋 Post Details</h5>
                </div>
                <div class="card-body">
                    <div class="detail-item mb-3">
                        <label class="fw-semibold text-dark">🔗 Slug:</label>
                        <p class="mb-0 text-muted small">{{ $blog->slug }}</p>
                    </div>

                    <div class="detail-item mb-3">
                        <label class="fw-semibold text-dark">📂 Category:</label>
                        <p class="mb-0">
                            <a href="{{ route('admin.content.blog-categories.show', $blog->category) }}" 
                               class="text-decoration-none">
                                {{ $blog->category->name }}
                            </a>
                        </p>
                    </div>

                    <div class="detail-item mb-3">
                        <label class="fw-semibold text-dark">📅 Published:</label>
                        <p class="mb-0">{{ $blog->published_at->format('F j, Y g:i A') }}</p>
                    </div>

                    <div class="detail-item mb-3">
                        <label class="fw-semibold text-dark">✅ Status:</label>
                        <span class="badge badge-{{ $blog->status ? 'success' : 'secondary' }}">
                            {{ $blog->status ? 'Published' : 'Draft' }}
                        </span>
                    </div>

                    <div class="detail-item mb-3">
                        <label class="fw-semibold text-dark">⭐ Featured:</label>
                        <span class="badge badge-{{ $blog->featured ? 'warning' : 'secondary' }}">
                            {{ $blog->featured ? 'Yes' : 'No' }}
                        </span>
                    </div>

                    <div class="detail-item mb-3">
                        <label class="fw-semibold text-dark">💬 Comments:</label>
                        <span class="badge badge-{{ $blog->comments_enabled ? 'info' : 'secondary' }}">
                            {{ $blog->comments_enabled ? 'Enabled' : 'Disabled' }}
                        </span>
                    </div>

                    <div class="detail-item mb-3">
                        <label class="fw-semibold text-dark">👁️ Views:</label>
                        <p class="mb-0">{{ number_format($blog->views_count ?? 0) }}</p>
                    </div>
                </div>
            </div>

            <!-- Post Statistics -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">📊 Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Word Count:</span>
                            <span class="fw-semibold">{{ str_word_count(strip_tags($blog->content)) }}</span>
                        </div>
                    </div>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Reading Time:</span>
                            <span class="fw-semibold">{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min</span>
                        </div>
                    </div>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Character Count:</span>
                            <span class="fw-semibold">{{ strlen(strip_tags($blog->content)) }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Created:</span>
                            <span class="fw-semibold">{{ $blog->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Last Updated:</span>
                            <span class="fw-semibold">{{ $blog->updated_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.blog-meta .meta-item {
    color: #64748b;
    font-size: 0.875rem;
}

.blog-content {
    line-height: 1.8;
    font-size: 1rem;
}

.blog-content h1,
.blog-content h2,
.blog-content h3,
.blog-content h4,
.blog-content h5,
.blog-content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.blog-content h1 {
    font-size: 2rem;
}

.blog-content h2 {
    font-size: 1.75rem;
}

.blog-content h3 {
    font-size: 1.5rem;
}

.blog-content p {
    margin-bottom: 1.5rem;
}

.blog-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
}

.blog-content blockquote {
    border-left: 4px solid var(--primary-color);
    padding-left: 1.5rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #64748b;
}

.blog-content ul,
.blog-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.blog-content li {
    margin-bottom: 0.5rem;
}

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

.featured-image img {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: cover;
}
</style>
@endsection

@push('scripts')
<script>
function toggleStatus(blogId) {
    fetch(`/admin/content/blogs/${blogId}/toggle-status`, {
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

function toggleFeatured(blogId) {
    fetch(`/admin/content/blogs/${blogId}/toggle-featured`, {
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
            showToast('Failed to update featured status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred', 'error');
    });
}
</script>
@endpush
