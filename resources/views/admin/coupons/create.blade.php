@extends('admin.layouts.app')

@section('page-title', 'Add New Coupon')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Add New Coupon Code</h5>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Coupons
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.coupons.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Coupon Code -->
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Coupon Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                   id="code" name="code" value="{{ old('code') }}" 
                                   placeholder="e.g., SAVE20, WELCOME10" style="text-transform: uppercase;">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Enter a unique coupon code (letters and numbers only)</small>
                        </div>

                        <!-- Discount Type -->
                        <div class="col-md-6 mb-3">
                            <label for="discount_type" class="form-label">Discount Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('discount_type') is-invalid @enderror" 
                                    id="discount_type" name="discount_type" onchange="updateDiscountPlaceholder()">
                                <option value="">Select Discount Type</option>
                                <option value="percentage" {{ old('discount_type') === 'percentage' ? 'selected' : '' }}>
                                    Percentage (%)
                                </option>
                                <option value="fixed" {{ old('discount_type') === 'fixed' ? 'selected' : '' }}>
                                    Fixed Amount ($)
                                </option>
                            </select>
                            @error('discount_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Discount -->
                        <div class="col-md-6 mb-3">
                            <label for="discount" class="form-label">Discount <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="discount-symbol">%</span>
                                <input type="number" class="form-control @error('discount') is-invalid @enderror" 
                                       id="discount" name="discount" value="{{ old('discount') }}" 
                                       placeholder="Enter discount amount" step="0.01" min="0">
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted" id="discount-help">
                                Enter the discount amount
                            </small>
                        </div>

                        <!-- Min Order Amount -->
                        <div class="col-md-6 mb-3">
                            <label for="min_order_amount" class="form-label">Min. Order Amount <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" class="form-control @error('min_order_amount') is-invalid @enderror" 
                                       id="min_order_amount" name="min_order_amount" value="{{ old('min_order_amount', '0') }}" 
                                       placeholder="0.00" step="0.01" min="0">
                                @error('min_order_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Minimum order amount required to use this coupon</small>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Start Date -->
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                   id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" 
                                   min="{{ date('Y-m-d') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                   id="end_date" name="end_date" value="{{ old('end_date') }}" 
                                   min="{{ date('Y-m-d') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Usage Limit -->
                        <div class="col-md-6 mb-3">
                            <label for="usage_limit" class="form-label">Usage Limit (Optional)</label>
                            <input type="number" class="form-control @error('usage_limit') is-invalid @enderror" 
                                   id="usage_limit" name="usage_limit" value="{{ old('usage_limit') }}" 
                                   placeholder="Leave empty for unlimited" min="1">
                            @error('usage_limit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Maximum number of times this coupon can be used</small>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" 
                                  placeholder="Enter a description for this coupon...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preview Section -->
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h6 class="card-title">Coupon Preview</h6>
                            <div class="coupon-preview border rounded p-3 bg-white">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 class="mb-1 text-primary" id="preview-code">COUPON_CODE</h5>
                                        <p class="mb-1" id="preview-discount">Get discount on your order</p>
                                        <small class="text-muted" id="preview-conditions">Conditions apply</small>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="badge bg-primary fs-6" id="preview-amount">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Create Coupon
                        </button>
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize preview
    updatePreview();
    
    // Add event listeners
    document.getElementById('code').addEventListener('input', updatePreview);
    document.getElementById('discount_type').addEventListener('change', function() {
        updateDiscountPlaceholder();
        updatePreview();
    });
    document.getElementById('discount').addEventListener('input', updatePreview);
    document.getElementById('min_order_amount').addEventListener('input', updatePreview);
    
    // Auto-convert code to uppercase
    document.getElementById('code').addEventListener('input', function(e) {
        e.target.value = e.target.value.toUpperCase();
    });
    
    // Set minimum end date when start date changes
    document.getElementById('start_date').addEventListener('change', function() {
        const startDate = this.value;
        const endDateInput = document.getElementById('end_date');
        endDateInput.min = startDate;
        
        if (endDateInput.value && endDateInput.value < startDate) {
            endDateInput.value = startDate;
        }
    });
});

function updateDiscountPlaceholder() {
    const discountType = document.getElementById('discount_type').value;
    const discountSymbol = document.getElementById('discount-symbol');
    const discountInput = document.getElementById('discount');
    const discountHelp = document.getElementById('discount-help');
    
    if (discountType === 'percentage') {
        discountSymbol.textContent = '%';
        discountInput.placeholder = 'e.g., 20';
        discountInput.max = '100';
        discountHelp.textContent = 'Enter percentage discount (0-100%)';
    } else if (discountType === 'fixed') {
        discountSymbol.textContent = '₹';
        discountInput.placeholder = 'e.g., 500.00';
        discountInput.removeAttribute('max');
        discountHelp.textContent = 'Enter fixed discount amount in rupees';
    } else {
        discountSymbol.textContent = '';
        discountInput.placeholder = 'Enter discount amount';
        discountInput.removeAttribute('max');
        discountHelp.textContent = 'Enter the discount amount';
    }
}

function updatePreview() {
    const code = document.getElementById('code').value || 'COUPON_CODE';
    const discountType = document.getElementById('discount_type').value;
    const discount = document.getElementById('discount').value;
    const minOrder = document.getElementById('min_order_amount').value || '0';
    
    // Update preview elements
    document.getElementById('preview-code').textContent = code;
    
    let discountText = 'Get discount on your order';
    let amountText = '--';
    
    if (discount && discountType) {
        if (discountType === 'percentage') {
            discountText = `Get ${discount}% off your order`;
            amountText = `${discount}% OFF`;
        } else if (discountType === 'fixed') {
            discountText = `Get ₹${discount} off your order`;
            amountText = `₹${discount} OFF`;
        }
    }
    
    document.getElementById('preview-discount').textContent = discountText;
    document.getElementById('preview-amount').textContent = amountText;
    
    const conditions = minOrder > 0 ? `Minimum order: ₹${minOrder}` : 'No minimum order required';
    document.getElementById('preview-conditions').textContent = conditions;
}
</script>
@endpush
