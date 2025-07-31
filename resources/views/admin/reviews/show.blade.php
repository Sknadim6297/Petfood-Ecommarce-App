@extends('admin.layouts.app')

@section('title', 'Review Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Review Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Reviews
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Product Information -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Product Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        @if($review->product->image)
                                            <img src="{{ asset('storage/' . $review->product->image) }}" 
                                                 alt="{{ $review->product->name }}" 
                                                 class="img-thumbnail mr-3" style="width: 100px; height: 100px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <h6>{{ $review->product->name }}</h6>
                                            <p class="text-muted mb-1">SKU: {{ $review->product->sku }}</p>
                                            <p class="text-muted mb-1">Category: {{ $review->product->category->name }}</p>
                                            @if($review->product->brand)
                                                <p class="text-muted mb-1">Brand: {{ $review->product->brand->name }}</p>
                                            @endif
                                            <p class="text-muted">Price: ₹{{ number_format($review->product->price, 2) }}</p>
                                            <a href="{{ route('admin.products.show', $review->product) }}" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> View Product
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviewer Information -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Reviewer Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Name:</strong></td>
                                            <td>{{ $review->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>{{ $review->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>User Account:</strong></td>
                                            <td>
                                                @if($review->user)
                                                    <span class="badge badge-success">Registered User</span>
                                                    <br>
                                                    <small class="text-muted">User ID: {{ $review->user->id }}</small>
                                                @else
                                                    <span class="badge badge-secondary">Guest User</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Rating:</strong></td>
                                            <td>
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-muted"></i>
                                                        @endif
                                                    @endfor
                                                    <span class="ml-2">{{ $review->rating }}/5</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($review->is_approved)
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-warning">Pending Approval</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Submitted:</strong></td>
                                            <td>
                                                {{ $review->created_at->format('F d, Y \a\t h:i A') }}
                                                <br>
                                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Review Comment -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Review Comment</h5>
                                </div>
                                <div class="card-body">
                                    <div class="bg-light p-3 rounded">
                                        {{ $review->comment }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group" role="group">
                                        @if($review->is_approved)
                                            <form action="{{ route('admin.reviews.reject', $review) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to reject this review?')">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-times"></i> Reject Review
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.reviews.approve', $review) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to approve this review?')">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check"></i> Approve Review
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                              method="POST" class="d-inline ml-2" 
                                              onsubmit="return confirm('Are you sure you want to delete this review? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Delete Review
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Other Reviews for this Product -->
                    @if($review->product->reviews()->count() > 1)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Other Reviews for this Product</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Reviewer</th>
                                                    <th>Rating</th>
                                                    <th>Comment</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($review->product->reviews()->where('id', '!=', $review->id)->latest()->limit(5)->get() as $otherReview)
                                                <tr>
                                                    <td>{{ $otherReview->name }}</td>
                                                    <td>
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $otherReview->rating)
                                                                <i class="fas fa-star text-warning"></i>
                                                            @else
                                                                <i class="far fa-star text-muted"></i>
                                                            @endif
                                                        @endfor
                                                    </td>
                                                    <td>{{ Str::limit($otherReview->comment, 50) }}</td>
                                                    <td>
                                                        @if($otherReview->is_approved)
                                                            <span class="badge badge-success">Approved</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $otherReview->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.reviews.show', $otherReview) }}" 
                                                           class="btn btn-sm btn-outline-primary">View</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($review->product->reviews()->count() > 6)
                                        <div class="text-center mt-3">
                                            <a href="{{ route('admin.reviews.index', ['product_id' => $review->product->id]) }}" 
                                               class="btn btn-outline-primary">
                                                View All Reviews for this Product
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
