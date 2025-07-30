@extends('frontend.layouts.layout')

@section('title', 'Order Details - PetNet')

@push('styles')
<style>
/* ========================================
   ORDER DETAILS PAGE STYLES
======================================== */
.order-details-wrapper {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    min-height: 100vh;
    padding: 40px 0;
}

.order-details-card {
    background: white;
    border-radius: 15px;
    padding: 35px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    border: 1px solid #f0f2f5;
    position: relative;
    overflow: hidden;
}

.order-details-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.order-title h2 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 5px;
    font-size: 28px;
}

.order-meta {
    color: #6c757d;
    font-size: 14px;
}

.order-status-badge {
    text-align: right;
}

.status-badge {
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
    margin-bottom: 10px;
}

.status-badge.pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-badge.confirmed {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.status-badge.processing {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-badge.shipped {
    background: #cce7ff;
    color: #004085;
    border: 1px solid #b3d9ff;
}

.status-badge.delivered {
    background: #d1f2eb;
    color: #00695c;
    border: 1px solid #a7f3d0;
}

.status-badge.cancelled {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.payment-badge {
    padding: 6px 15px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.payment-badge.pending {
    background: #fff3cd;
    color: #856404;
}

.payment-badge.paid {
    background: #d1f2eb;
    color: #00695c;
}

.payment-badge.failed {
    background: #f8d7da;
    color: #721c24;
}

/* Order Progress Tracker */
.order-progress {
    margin: 30px 0;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.progress-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 20px;
    font-size: 18px;
}

.progress-tracker {
    display: flex;
    justify-content: space-between;
    position: relative;
    margin: 20px 0;
}

.progress-tracker::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e9ecef;
    z-index: 1;
}

.progress-step {
    flex: 1;
    text-align: center;
    position: relative;
    z-index: 2;
}

.progress-step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.progress-step.completed .progress-step-icon {
    background: linear-gradient(45deg, #28a745, #34d058);
    color: white;
}

.progress-step.current .progress-step-icon {
    background: linear-gradient(45deg, #fe5716, #ff7a3d);
    color: white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(254, 87, 22, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(254, 87, 22, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(254, 87, 22, 0);
    }
}

.progress-step-label {
    font-size: 12px;
    color: #6c757d;
    font-weight: 500;
}

.progress-step.completed .progress-step-label,
.progress-step.current .progress-step-label {
    color: #2c3e50;
    font-weight: 600;
}

/* Order Items Section */
.order-items-section {
    margin: 30px 0;
}

.section-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f8f9fa;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.order-item {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #f1f3f4;
    transition: all 0.3s ease;
}

.order-item:last-child {
    border-bottom: none;
}

.order-item:hover {
    background: rgba(254, 87, 22, 0.02);
    margin: 0 -15px;
    padding: 20px 15px;
    border-radius: 8px;
}

.order-item-image {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    object-fit: cover;
    margin-right: 20px;
    border: 2px solid #f1f3f4;
    transition: all 0.3s ease;
}

.order-item:hover .order-item-image {
    border-color: #fe5716;
    transform: scale(1.05);
}

.order-item-details {
    flex: 1;
}

.order-item-details h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 16px;
    line-height: 1.4;
}

.item-meta {
    color: #6c757d;
    font-size: 14px;
    margin-bottom: 5px;
}

.item-description {
    color: #8b9dc3;
    font-size: 13px;
    line-height: 1.4;
}

.order-item-pricing {
    text-align: right;
    min-width: 120px;
}

.item-price {
    color: #fe5716;
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 5px;
}

.item-total {
    color: #2c3e50;
    font-weight: 700;
    font-size: 18px;
}

/* Order Summary */
.order-summary {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    margin: 30px 0;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    color: #495057;
}

.summary-row.total {
    font-weight: 700;
    font-size: 18px;
    color: #2c3e50;
    border-top: 2px solid #e9ecef;
    margin-top: 15px;
    padding-top: 15px;
}

.summary-row.total .amount {
    color: #fe5716;
}

/* Coupon Display Styles for Frontend Show Page */
.summary-row.discount {
    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #c3e6cb;
    margin: 5px 0;
}

.summary-row.discount span {
    color: #28a745 !important;
    font-weight: 600;
}

.summary-row.discount i {
    margin-right: 5px;
}

/* Shipping & Billing */
.address-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin: 30px 0;
}

.address-card {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.address-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 16px;
}

.address-content {
    color: #6c757d;
    line-height: 1.6;
}

.address-content strong {
    color: #2c3e50;
    display: block;
    margin-bottom: 5px;
}

/* Action Buttons */
.order-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    justify-content: center;
}

.btn-action {
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 14px;
}

.btn-primary {
    background: linear-gradient(45deg, #fe5716, #ff7a3d);
    color: white;
    box-shadow: 0 4px 15px rgba(254, 87, 22, 0.2);
}

.btn-primary:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.4);
    text-decoration: none;
}

.btn-secondary {
    background: transparent;
    color: #6c757d;
    border: 1px solid #6c757d;
}

.btn-secondary:hover {
    background: #6c757d;
    color: white;
    text-decoration: none;
}

.btn-outline {
    background: transparent;
    color: #fe5716;
    border: 1px solid #fe5716;
}

.btn-outline:hover {
    background: #fe5716;
    color: white;
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .order-details-wrapper {
        padding: 20px 0;
    }
    
    .order-details-card {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .order-status-badge {
        text-align: left;
    }
    
    .progress-tracker {
        flex-direction: column;
        gap: 20px;
    }
    
    .progress-tracker::before {
        display: none;
    }
    
    .address-section {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .order-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .order-item-image {
        width: 60px;
        height: 60px;
        margin-right: 0;
    }
    
    .order-item-pricing {
        text-align: left;
        width: 100%;
    }
    
    .order-actions {
        flex-direction: column;
        gap: 10px;
    }
    
    .btn-action {
        text-align: center;
    }
}

/* Animation enhancements */
.order-details-card {
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.order-item {
    animation: slideInLeft 0.6s ease-out;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>
@endpush

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Order Details</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="{{ route('orders.index') }}">My Orders</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img">
                    <div class="banner-img-1">
                        <svg width="260" height="260" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="{{ asset('assets/img/banner-img-1.jpg') }}" alt="banner">
                    </div>
                    <div class="banner-img-2">
                        <svg width="320" height="320" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="{{ asset('assets/img/banner-img-2.jpg') }}" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-2">
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-4">
</section>

<section class="gap order-details-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Order Header -->
                <div class="order-details-card">
                    <div class="order-header">
                        <div class="order-title">
                            <h2>Order #{{ $order->order_number }}</h2>
                            <div class="order-meta">
                                Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                            </div>
                        </div>
                        <div class="order-status-badge">
                            <div class="status-badge {{ $order->status }}">{{ ucfirst($order->status) }}</div>
                            <div class="payment-badge {{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</div>
                        </div>
                    </div>

                    <!-- Order Progress Tracker -->
                    <div class="order-progress">
                        <div class="progress-title">Order Progress</div>
                        <div class="progress-tracker">
                            <div class="progress-step {{ in_array($order->status, ['pending', 'confirmed', 'processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                <div class="progress-step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="progress-step-label">Order Placed</div>
                            </div>
                            <div class="progress-step {{ in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered']) ? 'completed' : ($order->status == 'pending' ? 'current' : '') }}">
                                <div class="progress-step-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div class="progress-step-label">Confirmed</div>
                            </div>
                            <div class="progress-step {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'completed' : ($order->status == 'confirmed' ? 'current' : '') }}">
                                <div class="progress-step-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <div class="progress-step-label">Processing</div>
                            </div>
                            <div class="progress-step {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : ($order->status == 'processing' ? 'current' : '') }}">
                                <div class="progress-step-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="progress-step-label">Shipped</div>
                            </div>
                            <div class="progress-step {{ $order->status == 'delivered' ? 'completed' : ($order->status == 'shipped' ? 'current' : '') }}">
                                <div class="progress-step-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="progress-step-label">Delivered</div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="order-items-section">
                        <h3 class="section-title">Order Items</h3>
                        @foreach($order->orderItems as $item)
                        <div class="order-item">
                            @if($item->item_type === 'cooked_food' && $item->cookedFood)
                                {{-- Cooked Food Item --}}
                                <img src="{{ $item->cookedFood->image ? asset('storage/' . $item->cookedFood->image) : asset('assets/img/product-placeholder.jpg') }}" 
                                     alt="{{ $item->cookedFood->name }}" class="order-item-image">
                                <div class="order-item-details">
                                    <h6>{{ $item->cookedFood->name }} <span class="badge bg-success ms-2">Cooked Food</span></h6>
                                    <div class="item-meta">
                                        <strong>Quantity:</strong> {{ $item->quantity }}
                                    </div>
                                    <div class="item-meta">
                                        <strong>Unit Price:</strong> ₹{{ number_format($item->price, 2) }}
                                    </div>
                                    @if($item->cookedFood->description)
                                    <div class="item-description">{{ $item->cookedFood->description }}</div>
                                    @endif
                                </div>
                            @elseif($item->product)
                                {{-- Regular Product Item --}}
                                <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/img/product-placeholder.jpg') }}" 
                                     alt="{{ $item->product->name }}" class="order-item-image">
                                <div class="order-item-details">
                                    <h6>{{ $item->product->name }} <span class="badge bg-primary ms-2">Product</span></h6>
                                    <div class="item-meta">
                                        <strong>Quantity:</strong> {{ $item->quantity }}
                                    </div>
                                    <div class="item-meta">
                                        <strong>Unit Price:</strong> ₹{{ number_format($item->price, 2) }}
                                    </div>
                                    @if($item->product->short_description)
                                    <div class="item-description">{{ $item->product->short_description }}</div>
                                    @endif
                                </div>
                            @else
                                {{-- Fallback for items with no valid product/cooked food --}}
                                <img src="{{ asset('assets/img/product-placeholder.jpg') }}" 
                                     alt="Unknown Item" class="order-item-image">
                                <div class="order-item-details">
                                    <h6>Unknown Item <span class="badge bg-warning ms-2">Error</span></h6>
                                    <div class="item-meta">
                                        <strong>Quantity:</strong> {{ $item->quantity }}
                                    </div>
                                    <div class="item-meta">
                                        <strong>Unit Price:</strong> ₹{{ number_format($item->price, 2) }}
                                    </div>
                                    <div class="item-description">This item could not be loaded properly.</div>
                                </div>
                            @endif
                            <div class="order-item-pricing">
                                <div class="item-total">₹{{ number_format($item->total, 2) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary">
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->coupon_code && $order->discount_amount > 0)
                        <div class="summary-row discount">
                            <span class="text-success">
                                <i class="fas fa-tag me-1"></i>Coupon ({{ $order->coupon_code }}):
                            </span>
                            <span class="text-success">-₹{{ number_format($order->discount_amount, 2) }}</span>
                        </div>
                        @endif
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span>{{ $order->shipping_amount == 0 ? 'Free' : '₹' . number_format($order->shipping_amount, 2) }}</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span class="amount">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="address-section">
                        <div class="address-card">
                            <div class="address-title">
                                <i class="fas fa-shipping-fast me-2"></i>Shipping Address
                            </div>
                            <div class="address-content">
                                {{ $order->shipping_address }}<br>
                                <strong>Phone:</strong> {{ $order->phone }}<br>
                                <strong>Email:</strong> {{ $order->email }}
                            </div>
                        </div>
                        <div class="address-card">
                            <div class="address-title">
                                <i class="fas fa-credit-card me-2"></i>Payment Information
                            </div>
                            <div class="address-content">
                                <strong>Payment Method:</strong> {{ $order->payment_method == 'cash_on_delivery' ? 'Cash on Delivery' : 'Online Payment' }}<br>
                                <strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}<br>
                                @if($order->payment_method == 'cash_on_delivery')
                                <small class="text-muted">Pay when your order is delivered</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($order->order_notes)
                    <div class="order-items-section">
                        <h3 class="section-title">Order Notes</h3>
                        <div class="address-card">
                            <div class="address-content">
                                {{ $order->order_notes }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="order-actions">
                        <a href="{{ route('orders.index') }}" class="btn-action btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Orders
                        </a>
                        @if($order->status == 'delivered')
                        <a href="#" class="btn-action btn-outline">
                            <i class="fas fa-star me-2"></i>Rate & Review
                        </a>
                        @endif
                        @if(in_array($order->status, ['pending', 'confirmed']))
                        <a href="#" class="btn-action btn-secondary" onclick="alert('Contact support to cancel order')">
                            <i class="fas fa-times me-2"></i>Cancel Order
                        </a>
                        @endif
                        <a href="{{ route('home') }}" class="btn-action btn-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
