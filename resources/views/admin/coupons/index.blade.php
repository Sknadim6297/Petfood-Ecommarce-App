@extends('admin.layouts.app')

@section('page-title', 'Manage Coupons')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">All Coupons</h5>
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add New Coupon
                </a>
            </div>
            <div class="card-body">
                <!-- Search and Filter Section -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('admin.coupons.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" 
                                       placeholder="Search coupons..." value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form method="GET" action="{{ route('admin.coupons.index') }}">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select class="form-select" name="status" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form method="GET" action="{{ route('admin.coupons.index') }}">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="status" value="{{ request('status') }}">
                            <select class="form-select" name="discount_type" onchange="this.form.submit()">
                                <option value="">All Types</option>
                                <option value="percentage" {{ request('discount_type') === 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ request('discount_type') === 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-times me-1"></i>Clear
                        </a>
                    </div>
                </div>

                <!-- Coupons Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Sl. No.</th>
                                <th>Code</th>
                                <th>Discount Type</th>
                                <th>Discount</th>
                                <th>Min. Order Amount</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $index => $coupon)
                                <tr>
                                    <td>{{ $coupons->firstItem() + $index }}</td>
                                    <td>
                                        <strong class="text-primary">{{ $coupon->code }}</strong>
                                        @if($coupon->usage_limit)
                                            <br>
                                            <small class="text-muted">
                                                Used: {{ $coupon->used_count }}/{{ $coupon->usage_limit }}
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $coupon->discount_type === 'percentage' ? 'bg-info' : 'bg-warning' }}">
                                            {{ ucfirst($coupon->discount_type) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-success">
                                        {{ $coupon->discount_amount }}
                                    </td>
                                    <td>₹{{ number_format($coupon->min_order_amount, 2) }}</td>
                                    <td>{{ $coupon->formatted_start_date }}</td>
                                    <td>{{ $coupon->formatted_end_date }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            {!! $coupon->status_badge !!}
                                            @if(!$coupon->is_valid && $coupon->status === 'active')
                                                <small class="text-muted">(Expired)</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.coupons.show', $coupon) }}" 
                                               class="btn btn-sm btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.coupons.edit', $coupon) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-{{ $coupon->status === 'active' ? 'warning' : 'success' }}" 
                                                    onclick="toggleStatus({{ $coupon->id }})" title="Toggle Status">
                                                <i class="fas fa-{{ $coupon->status === 'active' ? 'pause' : 'play' }}"></i>
                                            </button>
                                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this coupon?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">No coupons found</h5>
                                            <p class="text-muted">Start by creating your first coupon.</p>
                                            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i>Add New Coupon
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($coupons->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="pagination-info">
                            Showing {{ $coupons->firstItem() }} to {{ $coupons->lastItem() }} of {{ $coupons->total() }} results
                        </div>
                        {{ $coupons->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ \App\Models\Coupon::count() }}</h4>
                        <p class="mb-0">Total Coupons</p>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-ticket-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ \App\Models\Coupon::active()->count() }}</h4>
                        <p class="mb-0">Active Coupons</p>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ \App\Models\Coupon::valid()->count() }}</h4>
                        <p class="mb-0">Valid Coupons</p>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ \App\Models\Coupon::where('status', 'inactive')->count() }}</h4>
                        <p class="mb-0">Inactive Coupons</p>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-pause-circle fa-2x"></i>
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
