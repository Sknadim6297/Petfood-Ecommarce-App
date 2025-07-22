@extends('admin.layouts.app')

@section('page-title', 'Coupon Details')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Coupon Details: {{ $coupon->code }}</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Coupons
                    </a>
                </div>
            </div>
            <div class="card-body">
                
                <!-- Coupon Preview -->
                <div class="card bg-gradient-primary text-white mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="mb-1">{{ $coupon->code }}</h4>
                                <p class="mb-1">
                                    @if($coupon->discount_type === 'percentage')
                                        Get {{ $coupon->discount }}% off your order
                                    @else
                                        Get ₹{{ number_format($coupon->discount, 2) }} off your order
                                    @endif
                                </p>
                                <small class="opacity-75">
                                    @if($coupon->min_order_amount > 0)
                                        Minimum order: ₹{{ number_format($coupon->min_order_amount, 2) }}
                                    @else
                                        No minimum order required
                                    @endif
                                </small>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="badge bg-light text-dark fs-5">
                                    {{ $coupon->discount_amount }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coupon Information -->
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Coupon Code:</th>
                                <td><strong class="text-primary">{{ $coupon->code }}</strong></td>
                            </tr>
                            <tr>
                                <th>Discount Type:</th>
                                <td>
                                    <span class="badge {{ $coupon->discount_type === 'percentage' ? 'bg-info' : 'bg-warning' }}">
                                        {{ ucfirst($coupon->discount_type) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Discount Amount:</th>
                                <td class="fw-bold text-success">{{ $coupon->discount_amount }}</td>
                            </tr>
                            <tr>
                                <th>Min. Order Amount:</th>
                                <td>₹{{ number_format($coupon->min_order_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    {!! $coupon->status_badge !!}
                                    @if(!$coupon->is_valid && $coupon->status === 'active')
                                        <small class="text-muted ms-2">(Expired)</small>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Start Date:</th>
                                <td>{{ $coupon->formatted_start_date }}</td>
                            </tr>
                            <tr>
                                <th>End Date:</th>
                                <td>{{ $coupon->formatted_end_date }}</td>
                            </tr>
                            <tr>
                                <th>Usage Limit:</th>
                                <td>
                                    @if($coupon->usage_limit)
                                        {{ number_format($coupon->usage_limit) }} times
                                    @else
                                        <span class="text-muted">Unlimited</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Times Used:</th>
                                <td>
                                    <strong>{{ number_format($coupon->used_count) }}</strong>
                                    @if($coupon->usage_limit)
                                        / {{ number_format($coupon->usage_limit) }}
                                        <div class="progress mt-1" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" 
                                                 style="width: {{ ($coupon->used_count / $coupon->usage_limit) * 100 }}%">
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Valid:</th>
                                <td>
                                    @if($coupon->is_valid)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Yes
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i>No
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Description -->
                @if($coupon->description)
                <div class="mt-4">
                    <h6>Description</h6>
                    <div class="bg-light p-3 rounded">
                        {{ $coupon->description }}
                    </div>
                </div>
                @endif

                <!-- Usage Statistics -->
                @if($coupon->usage_limit)
                <div class="mt-4">
                    <h6>Usage Statistics</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4 class="mb-0">{{ $coupon->usage_limit }}</h4>
                                    <small>Total Limit</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4 class="mb-0">{{ $coupon->used_count }}</h4>
                                    <small>Times Used</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h4 class="mb-0">{{ $coupon->usage_limit - $coupon->used_count }}</h4>
                                    <small>Remaining</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Coupon Validity Check -->
                <div class="mt-4">
                    <h6>Coupon Validity</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded">
                                @if($coupon->status === 'active')
                                    <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                                    <p class="mb-0"><small>Status: Active</small></p>
                                @else
                                    <i class="fas fa-times-circle text-danger fa-2x mb-2"></i>
                                    <p class="mb-0"><small>Status: Inactive</small></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded">
                                @if($coupon->start_date <= now())
                                    <i class="fas fa-calendar-check text-success fa-2x mb-2"></i>
                                    <p class="mb-0"><small>Start Date: Valid</small></p>
                                @else
                                    <i class="fas fa-calendar-times text-warning fa-2x mb-2"></i>
                                    <p class="mb-0"><small>Not Started Yet</small></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded">
                                @if($coupon->end_date >= now())
                                    <i class="fas fa-calendar-check text-success fa-2x mb-2"></i>
                                    <p class="mb-0"><small>End Date: Valid</small></p>
                                @else
                                    <i class="fas fa-calendar-times text-danger fa-2x mb-2"></i>
                                    <p class="mb-0"><small>Expired</small></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded">
                                @if(!$coupon->usage_limit || $coupon->used_count < $coupon->usage_limit)
                                    <i class="fas fa-infinity text-success fa-2x mb-2"></i>
                                    <p class="mb-0"><small>Usage: Available</small></p>
                                @else
                                    <i class="fas fa-ban text-danger fa-2x mb-2"></i>
                                    <p class="mb-0"><small>Usage Limit Reached</small></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="mt-4">
                    <h6>Metadata</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <strong>Created:</strong> {{ $coupon->created_at->format('M d, Y h:i A') }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">
                                <strong>Last Updated:</strong> {{ $coupon->updated_at->format('M d, Y h:i A') }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>Edit Coupon
                        </a>
                        
                        <button class="btn btn-{{ $coupon->status === 'active' ? 'warning' : 'success' }}" 
                                onclick="toggleStatus({{ $coupon->id }})">
                            <i class="fas fa-{{ $coupon->status === 'active' ? 'pause' : 'play' }} me-1"></i>
                            {{ $coupon->status === 'active' ? 'Deactivate' : 'Activate' }}
                        </button>
                        
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this coupon? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(couponId) {
    if (confirm('Are you sure you want to toggle the status of this coupon?')) {
        fetch(`{{ url('admin/coupons') }}/${couponId}/toggle-status`, {
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
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            showToast('An error occurred while updating the coupon status.', 'error');
        });
    }
}
</script>
@endpush
