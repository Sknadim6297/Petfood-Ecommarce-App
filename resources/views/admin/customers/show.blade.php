@extends('admin.layouts.app')

@section('title', 'Customer Details - ' . $customer->name)

@push('styles')
<style>
/* ========================================
   CUSTOMER DETAIL STYLES
======================================== */
.customer-detail-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.customer-header {
    background: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-left: 4px solid #fe5716;
}

.customer-header-content {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-bottom: 20px;
}

.customer-large-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(45deg, #fe5716, #ff7a3d);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 32px;
    flex-shrink: 0;
}

.customer-header-info h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 5px;
    font-size: 28px;
}

.customer-email {
    color: #6c757d;
    font-size: 16px;
    margin-bottom: 5px;
}

.customer-joined {
    color: #8b9dc3;
    font-size: 14px;
}

.customer-actions {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.btn-customer-action {
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-toggle-status {
    background: #28a745;
    color: white;
}

.btn-toggle-status.inactive {
    background: #dc3545;
}

.btn-toggle-status:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn-back {
    background: #6c757d;
    color: white;
}

.btn-back:hover {
    background: #5a6268;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.customer-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.customer-stat-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    border-left: 4px solid #fe5716;
    transition: all 0.3s ease;
}

.customer-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    font-size: 24px;
    color: #fe5716;
    margin-bottom: 10px;
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
    font-family: 'DynaPuff', cursive;
}

.stat-label {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
}

.customer-content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

.customer-section {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.section-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: between;
    align-items: center;
}

.section-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 18px;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-content {
    padding: 25px;
}

/* Recent Orders */
.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f1f3f4;
}

.order-item:last-child {
    border-bottom: none;
}

.order-info h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 14px;
}

.order-date {
    color: #6c757d;
    font-size: 12px;
}

.order-amount {
    color: #fe5716;
    font-weight: 700;
    font-size: 16px;
}

.order-status {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 5px;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-processing {
    background: #cff4fc;
    color: #055160;
}

.status-shipped {
    background: #d1ecf1;
    color: #0c5460;
}

.status-delivered {
    background: #d1f2eb;
    color: #155724;
}

.status-cancelled {
    background: #f8d7da;
    color: #721c24;
}

/* Recent Wishlist */
.wishlist-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f1f3f4;
}

.wishlist-item:last-child {
    border-bottom: none;
}

.wishlist-image {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
    background: #f8f9fa;
}

.wishlist-info h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 14px;
}

.wishlist-price {
    color: #fe5716;
    font-weight: 600;
    font-size: 14px;
}

.wishlist-date {
    color: #6c757d;
    font-size: 11px;
    margin-top: 3px;
}

/* Customer Information */
.info-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    color: #6c757d;
    font-weight: 500;
    font-size: 14px;
}

.info-value {
    color: #2c3e50;
    font-weight: 600;
    font-size: 14px;
}

.status-indicator {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-active {
    background: #d1f2eb;
    color: #155724;
}

.status-inactive {
    background: #f8d7da;
    color: #721c24;
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 48px;
    color: #dee2e6;
    margin-bottom: 15px;
}

.empty-state h4 {
    color: #495057;
    margin-bottom: 8px;
    font-size: 16px;
}

.empty-state p {
    color: #6c757d;
    font-size: 14px;
    margin: 0;
}

/* Activity Timeline */
.activity-timeline {
    position: relative;
    padding-left: 30px;
}

.activity-timeline::before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.activity-item {
    position: relative;
    padding: 15px 0;
}

.activity-item::before {
    content: '';
    position: absolute;
    left: -34px;
    top: 20px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #fe5716;
    border: 2px solid white;
    box-shadow: 0 0 0 2px #e9ecef;
}

.activity-date {
    color: #6c757d;
    font-size: 11px;
    margin-bottom: 3px;
}

.activity-text {
    color: #2c3e50;
    font-size: 13px;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .customer-detail-wrapper {
        padding: 15px;
    }
    
    .customer-header {
        padding: 20px;
    }
    
    .customer-header-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .customer-large-avatar {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
    
    .customer-content-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .customer-stats-grid {
        grid-template-columns: 1fr;
    }
    
    .customer-actions {
        flex-direction: column;
        gap: 10px;
    }
    
    .order-item,
    .wishlist-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

/* Animation */
.customer-section {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@section('content')
<div class="customer-detail-wrapper">
    <!-- Customer Header -->
    <div class="customer-header">
        <div class="customer-header-content">
            <div class="customer-large-avatar">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
            </div>
            <div class="customer-header-info">
                <h1>{{ $customer->name }}</h1>
                <div class="customer-email">{{ $customer->email }}</div>
                @if($customer->phone)
                <div class="customer-email">{{ $customer->phone }}</div>
                @endif
                <div class="customer-joined">
                    Member since {{ $customer->created_at->format('F j, Y') }} 
                    ({{ $customer->created_at->diffForHumans() }})
                </div>
            </div>
        </div>
        
        <div class="customer-actions">
            <button class="btn-customer-action btn-toggle-status {{ $customer->is_active ? '' : 'inactive' }}" 
                    onclick="toggleCustomerStatus({{ $customer->id }})">
                <i class="fas fa-{{ $customer->is_active ? 'ban' : 'check' }} me-2"></i>
                {{ $customer->is_active ? 'Deactivate Customer' : 'Activate Customer' }}
            </button>
            
            <a href="{{ route('admin.customers.index') }}" class="btn-customer-action btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to Customers
            </a>
        </div>
    </div>

    <!-- Customer Statistics -->
    <div class="customer-stats-grid">
        <div class="customer-stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-number">{{ $customer->orders->count() }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        
        <div class="customer-stat-card">
            <div class="stat-icon">
                <i class="fas fa-rupee-sign"></i>
            </div>
            <div class="stat-number">₹{{ number_format($customer->orders->sum('total_amount'), 2) }}</div>
            <div class="stat-label">Total Spent</div>
        </div>
        
        <div class="customer-stat-card">
            <div class="stat-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div class="stat-number">{{ $customer->wishlists->count() }}</div>
            <div class="stat-label">Wishlist Items</div>
        </div>
        
        <div class="customer-stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-number">
                @if($customer->orders->count() > 0)
                    ₹{{ number_format($customer->orders->avg('total_amount'), 2) }}
                @else
                    ₹0.00
                @endif
            </div>
            <div class="stat-label">Average Order Value</div>
        </div>
    </div>

    <!-- Customer Content Grid -->
    <div class="customer-content-grid">
        <!-- Customer Information -->
        <div class="customer-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-user"></i>
                    Customer Information
                </h3>
            </div>
            <div class="section-content">
                <div class="info-row">
                    <span class="info-label">Full Name:</span>
                    <span class="info-value">{{ $customer->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email Address:</span>
                    <span class="info-value">{{ $customer->email }}</span>
                </div>
                @if($customer->phone)
                <div class="info-row">
                    <span class="info-label">Phone Number:</span>
                    <span class="info-value">{{ $customer->phone }}</span>
                </div>
                @endif
                <div class="info-row">
                    <span class="info-label">Registration Date:</span>
                    <span class="info-value">{{ $customer->created_at->format('M d, Y h:i A') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email Verified:</span>
                    <span class="info-value">
                        @if($customer->email_verified_at)
                            <span class="status-indicator status-active">Verified</span>
                        @else
                            <span class="status-indicator status-inactive">Not Verified</span>
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Account Status:</span>
                    <span class="info-value">
                        <span class="status-indicator {{ $customer->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $customer->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="customer-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-clock"></i>
                    Recent Activity
                </h3>
            </div>
            <div class="section-content">
                <div class="activity-timeline">
                    <div class="activity-item">
                        <div class="activity-date">{{ $customer->created_at->format('M d, Y') }}</div>
                        <div class="activity-text">Account created</div>
                    </div>
                    
                    @if($customer->email_verified_at)
                    <div class="activity-item">
                        <div class="activity-date">{{ $customer->email_verified_at->format('M d, Y') }}</div>
                        <div class="activity-text">Email verified</div>
                    </div>
                    @endif
                    
                    @foreach($customer->orders->take(3) as $order)
                    <div class="activity-item">
                        <div class="activity-date">{{ $order->created_at->format('M d, Y') }}</div>
                        <div class="activity-text">Placed order #{{ $order->id }} (₹{{ number_format($order->total_amount, 2) }})</div>
                    </div>
                    @endforeach
                    
                    @if($customer->orders->count() == 0 && $customer->wishlists->count() == 0)
                    <div class="empty-state">
                        <i class="fas fa-clock"></i>
                        <h4>No Activity Yet</h4>
                        <p>This customer hasn't placed any orders or added items to wishlist.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="customer-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-shopping-bag"></i>
                    Recent Orders ({{ $customer->orders->count() }})
                </h3>
            </div>
            <div class="section-content">
                @if($customer->orders->count() > 0)
                    @foreach($customer->orders->take(5) as $order)
                    <div class="order-item">
                        <div class="order-info">
                            <h6>Order #{{ $order->id }}</h6>
                            <div class="order-date">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                            <div class="order-status status-{{ strtolower($order->status) }}">
                                {{ $order->status }}
                            </div>
                        </div>
                        <div class="order-amount">₹{{ number_format($order->total_amount, 2) }}</div>
                    </div>
                    @endforeach
                @else
                <div class="empty-state">
                    <i class="fas fa-shopping-cart"></i>
                    <h4>No Orders Yet</h4>
                    <p>This customer hasn't placed any orders.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Wishlist Items -->
        <div class="customer-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-heart"></i>
                    Wishlist Items ({{ $customer->wishlists->count() }})
                </h3>
            </div>
            <div class="section-content">
                @if($customer->wishlists->count() > 0)
                    @foreach($customer->wishlists->take(5) as $wishlist)
                    <div class="wishlist-item">
                        <img src="{{ $wishlist->product->image ? asset('storage/' . $wishlist->product->image) : asset('images/default-product.png') }}" 
                             alt="{{ $wishlist->product->name }}" 
                             class="wishlist-image">
                        <div class="wishlist-info">
                            <h6>{{ $wishlist->product->name }}</h6>
                            <div class="wishlist-price">₹{{ number_format($wishlist->product->price, 2) }}</div>
                            <div class="wishlist-date">Added {{ $wishlist->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="empty-state">
                    <i class="fas fa-heart"></i>
                    <h4>No Wishlist Items</h4>
                    <p>This customer hasn't added any items to wishlist.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Toggle customer status
function toggleCustomerStatus(customerId) {
    const button = document.querySelector('.btn-toggle-status');
    const isActive = !button.classList.contains('inactive');
    const action = isActive ? 'deactivate' : 'activate';
    
    if (confirm(`Are you sure you want to ${action} this customer?`)) {
        fetch(`/admin/customers/${customerId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                location.reload();
            } else {
                showToast(data.message || 'Error updating customer status', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error updating customer status', 'error');
        });
    }
}
</script>
@endpush
