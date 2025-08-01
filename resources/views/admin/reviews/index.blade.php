@extends('admin.layouts.app')

@section('title', 'Reviews Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Reviews Management</h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">{{ $reviews->total() }} Total Reviews</span>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.reviews.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">All Reviews</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="">All Products</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="rating">Rating</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="">All Ratings</option>
                                    @for($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                            {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="search">Search</label>
                                <input type="text" name="search" id="search" class="form-control" 
                                       placeholder="Search by name, email, or comment" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-1">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                    </form>

                    <!-- Bulk Actions -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="button" class="btn btn-success btn-sm" onclick="bulkApprove()">
                                <i class="fas fa-check"></i> Bulk Approve
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="bulkDelete()">
                                <i class="fas fa-trash"></i> Bulk Delete
                            </button>
                        </div>
                    </div>

                    <!-- Reviews Table -->
                    <form id="bulk-form">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>Product</th>
                                        <th>Reviewer</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reviews as $review)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="review_ids[]" value="{{ $review->id }}" class="review-checkbox">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($review->product->image)
                                                    <img src="{{ asset('storage/' . $review->product->image) }}" 
                                                         alt="{{ $review->product->name }}" 
                                                         class="img-thumbnail mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ Str::limit($review->product->name, 30) }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $review->product->sku }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $review->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $review->email }}</small>
                                                @if($review->user)
                                                    <br>
                                                    <span class="badge badge-info">Registered User</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-muted"></i>
                                                    @endif
                                                @endfor
                                                <br>
                                                <small class="text-muted">{{ $review->rating }}/5</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="max-width: 200px;">
                                                {{ Str::limit($review->comment, 100) }}
                                                @if(strlen($review->comment) > 100)
                                                    <a href="{{ route('admin.reviews.show', $review) }}" class="text-primary">
                                                        <small>Read more...</small>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($review->is_approved)
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $review->created_at->format('M d, Y') }}</small>
                                            <br>
                                            <small class="text-muted">{{ $review->created_at->format('h:i A') }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.reviews.show', $review) }}" 
                                                   class="btn btn-info btn-sm" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @if($review->is_approved)
                                                    <button type="button" 
                                                            class="btn btn-warning btn-sm approve-reject-btn" 
                                                            data-url="{{ route('admin.reviews.reject', $review) }}"
                                                            data-action="reject"
                                                            title="Reject Review">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @else
                                                    <button type="button" 
                                                            class="btn btn-success btn-sm approve-reject-btn" 
                                                            data-url="{{ route('admin.reviews.approve', $review) }}"
                                                            data-action="approve"
                                                            title="Approve Review">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @endif
                                                
                                                <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this review?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Review">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-star fa-3x mb-3"></i>
                                                <h5>No Reviews Found</h5>
                                                <p>No reviews match your current filters.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            Showing {{ $reviews->firstItem() ?? 0 }} to {{ $reviews->lastItem() ?? 0 }} of {{ $reviews->total() }} results
                        </div>
                        <div>
                            {{ $reviews->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Check if jQuery is loaded
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded! Admin functionality may not work.');
        alert('JavaScript Error: jQuery is missing. Please refresh the page.');
        return;
    }
    
    console.log('jQuery loaded successfully. Version:', jQuery.fn.jquery);
    console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));
    
    // Setup AJAX CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Handle approve/reject buttons with AJAX
    $('.approve-reject-btn').on('click', function(e) {
        e.preventDefault();
        
        const btn = $(this);
        const url = btn.data('url');
        const action = btn.data('action');
        const actionText = action === 'approve' ? 'approve' : 'reject';
        
        console.log('Button clicked:', action, 'URL:', url);
        
        if (confirm(`Are you sure you want to ${actionText} this review?`)) {
            // Show loading state
            const originalHtml = btn.html();
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            
            // Make AJAX request
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'POST'
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                success: function(response) {
                    console.log('Success response:', response);
                    
                    // Show success message
                    if (response.message) {
                        const alertDiv = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            '<i class="fas fa-check-circle me-2"></i>' + response.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                            '</div>');
                        $('.card-body').prepend(alertDiv);
                        
                        // Auto-dismiss after 3 seconds
                        setTimeout(() => alertDiv.alert('close'), 3000);
                    }
                    
                    // Reload page to show updated status
                    setTimeout(() => window.location.reload(), 1000);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {
                        xhr: xhr,
                        status: status,
                        error: error,
                        responseText: xhr.responseText,
                        responseJSON: xhr.responseJSON
                    });
                    
                    let errorMessage = 'Something went wrong';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.status === 419) {
                        errorMessage = 'CSRF token mismatch. Please refresh the page and try again.';
                    } else if (xhr.status === 404) {
                        errorMessage = 'Review not found or URL is incorrect.';
                    } else if (xhr.status === 500) {
                        errorMessage = 'Server error occurred. Please try again.';
                    } else if (xhr.responseText) {
                        errorMessage = 'Server error: ' + xhr.status;
                    }
                    
                    const alertDiv = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<i class="fas fa-exclamation-circle me-2"></i>Error: ' + errorMessage +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                        '</div>');
                    $('.card-body').prepend(alertDiv);
                    
                    btn.prop('disabled', false).html(originalHtml);
                }
            });
        }
    });
    
    // Handle legacy form submissions (fallback)
    $('.approve-reject-form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const action = form.data('action');
        const actionText = action === 'approve' ? 'approve' : 'reject';
        
        if (confirm(`Are you sure you want to ${actionText} this review?`)) {
            // Show loading state
            const submitBtn = form.find('button[type="submit"]');
            const originalHtml = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            
            // Submit form via AJAX to prevent URL issues
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Show success message
                    if (response.message) {
                        // Create a simple alert or you can use a toast
                        const alertDiv = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            response.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                            '</div>');
                        $('.card-body').prepend(alertDiv);
                        
                        // Auto-dismiss after 3 seconds
                        setTimeout(() => alertDiv.alert('close'), 3000);
                    }
                    
                    // Reload page to show updated status
                    setTimeout(() => window.location.reload(), 1000);
                },
                error: function(xhr, status, error) {
                    let errorMessage = 'Something went wrong';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    alert('Error: ' + errorMessage);
                    submitBtn.prop('disabled', false).html(originalHtml);
                }
            });
        }
    });
    
    // Select all checkbox functionality
    $('#select-all').change(function() {
        $('.review-checkbox').prop('checked', $(this).prop('checked'));
    });

    // Update select all when individual checkboxes change
    $('.review-checkbox').change(function() {
        if ($('.review-checkbox:checked').length === $('.review-checkbox').length) {
            $('#select-all').prop('checked', true);
        } else {
            $('#select-all').prop('checked', false);
        }
    });
});

function bulkApprove() {
    if (typeof $ === 'undefined') {
        alert('jQuery is not loaded. Please refresh the page.');
        return;
    }
    
    const selected = $('.review-checkbox:checked').map(function() {
        return $(this).val();
    }).get();

    if (selected.length === 0) {
        alert('Please select at least one review to approve.');
        return;
    }

    if (confirm(`Are you sure you want to approve ${selected.length} review(s)?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.reviews.bulk-approve") }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        selected.forEach(function(id) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'review_ids[]';
            input.value = id;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
}

function bulkDelete() {
    if (typeof $ === 'undefined') {
        alert('jQuery is not loaded. Please refresh the page.');
        return;
    }
    
    const selected = $('.review-checkbox:checked').map(function() {
        return $(this).val();
    }).get();

    if (selected.length === 0) {
        alert('Please select at least one review to delete.');
        return;
    }

    if (confirm(`Are you sure you want to delete ${selected.length} review(s)? This action cannot be undone.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.reviews.bulk-delete") }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        selected.forEach(function(id) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'review_ids[]';
            input.value = id;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<script>
// Test function for debugging
function testAjaxConnection() {
    console.log('Testing AJAX connection...');
    
    $.ajax({
        url: '{{ route("admin.reviews.index") }}',
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        success: function(response) {
            console.log('AJAX test successful:', response);
        },
        error: function(xhr, status, error) {
            console.error('AJAX test failed:', {
                xhr: xhr,
                status: status,
                error: error,
                responseText: xhr.responseText
            });
        }
    });
}

// Add test button for debugging (temporary)
$(document).ready(function() {
    if (window.location.search.includes('debug=1')) {
        $('<button class="btn btn-info btn-sm" onclick="testAjaxConnection()">Test AJAX</button>')
            .appendTo('.card-tools');
    }
});
</script>
@endsection
