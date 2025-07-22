@extends('admin.layouts.app')

@section('title', 'Blog Comments Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Blog Comments</h3>
                </div>
                
                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('admin.content.blog-comments.index') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search comments..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.content.blog-comments.index') }}" class="btn {{ !request('status') ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                                <a href="{{ route('admin.content.blog-comments.index', ['status' => 'pending']) }}" class="btn {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">Pending</a>
                                <a href="{{ route('admin.content.blog-comments.index', ['status' => 'approved']) }}" class="btn {{ request('status') == 'approved' ? 'btn-success' : 'btn-outline-success' }}">Approved</a>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($comments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Blog Post</th>
                                        <th>Author</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>
                                            <a href="{{ route('blog.show', $comment->blog->slug) }}" target="_blank" class="text-decoration-none">
                                                {{ Str::limit($comment->blog->title, 30) }}
                                            </a>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $comment->author_name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $comment->author_email }}</small>
                                                @if($comment->user)
                                                    <br><small class="badge bg-info">Registered User</small>
                                                @else
                                                    <br><small class="badge bg-secondary">Guest</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($comment->comment, 50) }}</td>
                                        <td>{!! $comment->status_badge !!}</td>
                                        <td>{{ $comment->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.content.blog-comments.show', $comment) }}" class="btn btn-sm btn-info">View</a>
                                                
                                                @if($comment->is_approved)
                                                    <button onclick="updateCommentStatus({{ $comment->id }}, 'reject')" class="btn btn-sm btn-warning">Reject</button>
                                                @else
                                                    <button onclick="updateCommentStatus({{ $comment->id }}, 'approve')" class="btn btn-sm btn-success">Approve</button>
                                                @endif
                                                
                                                <form action="{{ route('admin.content.blog-comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $comments->links() }}
                    @else
                        <div class="text-center py-5">
                            <h5>No comments found</h5>
                            <p class="text-muted">Comments will appear here once users start commenting on blog posts.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateCommentStatus(commentId, action) {
    if (!confirm(`Are you sure you want to ${action} this comment?`)) {
        return;
    }

    fetch(`/admin/content/blog-comments/${commentId}/${action}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}
</script>
@endsection
