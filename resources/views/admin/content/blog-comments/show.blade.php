@extends('admin.layouts.app')

@section('title', 'Comment Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Comment Details</h3>
                    <a href="{{ route('admin.content.blog-comments.index') }}" class="btn btn-secondary">Back to Comments</a>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Comment Content</h5>
                                </div>
                                <div class="card-body">
                                    <p class="lead">{{ $comment->comment }}</p>
                                    
                                    <hr>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Status:</strong> {!! $comment->status_badge !!}
                                        </div>
                                        <div>
                                            @if($comment->is_approved)
                                                <button onclick="updateCommentStatus({{ $comment->id }}, 'reject')" class="btn btn-warning">Reject Comment</button>
                                            @else
                                                <button onclick="updateCommentStatus({{ $comment->id }}, 'approve')" class="btn btn-success">Approve Comment</button>
                                            @endif
                                            
                                            <form action="{{ route('admin.content.blog-comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete Comment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Author Information -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6>Author Information</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> {{ $comment->author_name }}</p>
                                    <p><strong>Email:</strong> {{ $comment->author_email }}</p>
                                    <p><strong>Type:</strong> 
                                        @if($comment->user)
                                            <span class="badge bg-info">Registered User</span>
                                        @else
                                            <span class="badge bg-secondary">Guest</span>
                                        @endif
                                    </p>
                                    @if($comment->user)
                                        <p><strong>User ID:</strong> {{ $comment->user->id }}</p>
                                        <p><strong>Joined:</strong> {{ $comment->user->created_at->format('M d, Y') }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Blog Post Information -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6>Blog Post Information</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Title:</strong> {{ $comment->blog->title }}</p>
                                    <p><strong>Category:</strong> {{ $comment->blog->category->name ?? 'Uncategorized' }}</p>
                                    <p><strong>Published:</strong> {{ $comment->blog->formatted_published_date }}</p>
                                    <a href="{{ route('blog.show', $comment->blog->slug) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Blog Post</a>
                                </div>
                            </div>
                            
                            <!-- Comment Metadata -->
                            <div class="card">
                                <div class="card-header">
                                    <h6>Comment Metadata</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Comment ID:</strong> {{ $comment->id }}</p>
                                    <p><strong>Posted:</strong> {{ $comment->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    @if($comment->approved_at)
                                        <p><strong>Approved:</strong> {{ $comment->approved_at->format('M d, Y \a\t g:i A') }}</p>
                                    @endif
                                    <p><strong>Last Updated:</strong> {{ $comment->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
