@extends('frontend.layouts.layout')

@section('title', 'My Orders - PetNet')

@push('styles')
<style>
/* ========================================
   MY ORDERS PAGE STYLES
======================================== */
.orders-wrapper {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    min-height: 100vh;
    padding: 40px 0;
}

.orders-header {
    background: white;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    border: 1px solid #f0f2f5;
    position: relative;
    overflow: hidden;
}

.orders-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.orders-header h2 {
    color: #2c3e50;
    margin-bottom: 10px;
    font-size: 28px;
    font-weight: 700;
}

.orders-header p {
    color: #6c757d;
    margin: 0;
    font-size: 16px;
}

.order-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
    border: 1px solid #f0f2f5;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.order-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #fe5716, #ff7a3d);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.order-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(254, 87, 22, 0.15);
}

.order-card:hover::before {
    opacity: 1;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f1f3f4;
}

.order-number {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
}

.order-date {
    color: #6c757d;
    font-size: 14px;
}

.order-status {
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.order-status.pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.order-status.confirmed {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.order-status.processing {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.order-status.shipped {
    background: #cce7ff;
    color: #004085;
    border: 1px solid #b3d9ff;
}

.order-status.delivered {
    background: #d1f2eb;
    color: #00695c;
    border: 1px solid #a7f3d0;
}

.order-status.cancelled {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.payment-status {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-left: 10px;
}

.payment-status.pending {
    background: #fff3cd;
    color: #856404;
}

.payment-status.paid {
    background: #d1f2eb;
    color: #00695c;
}

.payment-status.failed {
    background: #f8d7da;
    color: #721c24;
}

.order-items {
    margin: 15px 0;
}

.order-item {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f8f9fa;
}

.order-item:last-child {
    border-bottom: none;
}

.order-item-image {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 15px;
    border: 1px solid #e9ecef;
}

.order-item-details h6 {
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-size: 14px;
    font-weight: 600;
}

.order-item-details .item-info {
    color: #6c757d;
    font-size: 12px;
}

.order-item-price {
    margin-left: auto;
    color: #fe5716;
    font-weight: 700;
    font-size: 14px;
}

.order-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px solid #f1f3f4;
}

.order-total {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
}

.order-total .amount {
    color: #fe5716;
}

/* Coupon Display Styles */
.coupon-info {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
    padding: 6px 12px;
    border-radius: 20px;
    border: 1px solid #c3e6cb;
    font-size: 12px;
    font-weight: 600;
}

.coupon-info i {
    font-size: 11px;
}

.discount-applied {
    font-weight: 700;
    color: #28a745 !important;
}

.order-actions {
    display: flex;
    gap: 10px;
}

.btn-order {
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-view {
    background: linear-gradient(45deg, #fe5716, #ff7a3d);
    color: white;
}

.btn-view:hover {
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(254, 87, 22, 0.3);
    text-decoration: none;
}

.btn-track {
    background: transparent;
    color: #fe5716;
    border: 1px solid #fe5716;
}

.btn-track:hover {
    background: #fe5716;
    color: white;
    text-decoration: none;
}

.empty-orders {
    text-align: center;
    padding: 80px 40px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    margin: 50px 0;
    border: 1px solid #f0f2f5;
}

.empty-orders-icon {
    font-size: 100px;
    color: #e9ecef;
    margin-bottom: 30px;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.empty-orders h3 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 32px;
    font-weight: 700;
}

.empty-orders p {
    color: #6c757d;
    margin-bottom: 40px;
    font-size: 18px;
    line-height: 1.6;
}

.btn-shop {
    background: linear-gradient(45deg, #fe5716, #ff7a3d);
    color: white;
    padding: 15px 40px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(254, 87, 22, 0.2);
}

.btn-shop:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.4);
    text-decoration: none;
}

/* Pagination */
.pagination {
    justify-content: center;
    margin-top: 40px;
}

.pagination .page-link {
    color: #fe5716;
    border-color: #fe5716;
    margin: 0 2px;
    border-radius: 8px;
}

.pagination .page-link:hover {
    background: #fe5716;
    border-color: #fe5716;
    color: white;
}

.pagination .page-item.active .page-link {
    background: #fe5716;
    border-color: #fe5716;
}

/* Responsive Design */
@media (max-width: 768px) {
    .orders-wrapper {
        padding: 20px 0;
    }
    
    .orders-header,
    .order-card {
        padding: 20px;
        margin-bottom: 15px;
    }
    
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .order-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .order-actions {
        width: 100%;
        justify-content: center;
    }
    
    .order-item-image {
        width: 40px;
        height: 40px;
    }
    
    .empty-orders {
        padding: 60px 20px;
    }
    
    .empty-orders-icon {
        font-size: 80px;
    }
    
    .empty-orders h3 {
        font-size: 28px;
    }
    
    .empty-orders p {
        font-size: 16px;
    }
}

/* Animation enhancements */
.order-card {
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
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
                    <h2>My Orders</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">My Orders</li>
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

<section class="gap orders-wrapper">
    <div class="container">
        <!-- Orders Header -->
        <div class="orders-header">
            <h2>My Orders</h2>
            <p>Track and manage all your orders from PetNet</p>
        </div>

        @if($orders->count() > 0)
            <!-- Orders List -->
            @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-number">Order #{{ $order->order_number }}</div>
                        <div class="order-date">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</div>
                    </div>
                    <div>
                        <span class="order-status {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        <span class="payment-status {{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                </div>

                <div class="order-items">
                    @foreach($order->orderItems->take(3) as $item)
                    <div class="order-item">
                        @if($item->item_type === 'cooked_food' && $item->cookedFood)
                            {{-- Cooked Food Item --}}
                            <img src="{{ $item->cookedFood->image ? asset('storage/' . $item->cookedFood->image) : asset('assets/img/product-placeholder.jpg') }}" 
                                 alt="{{ $item->cookedFood->name }}" class="order-item-image">
                            <div class="order-item-details">
                                <h6>{{ $item->cookedFood->name }} <span class="badge bg-success ms-1">Cooked Food</span></h6>
                                <div class="item-info">Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 2) }}</div>
                            </div>
                        @elseif($item->product)
                            {{-- Regular Product Item --}}
                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/img/product-placeholder.jpg') }}" 
                                 alt="{{ $item->product->name }}" class="order-item-image">
                            <div class="order-item-details">
                                <h6>{{ $item->product->name }} <span class="badge bg-primary ms-1">Product</span></h6>
                                <div class="item-info">Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 2) }}</div>
                            </div>
                        @else
                            {{-- Fallback for items with no valid product/cooked food --}}
                            <img src="{{ asset('assets/img/product-placeholder.jpg') }}" 
                                 alt="Unknown Item" class="order-item-image">
                            <div class="order-item-details">
                                <h6>Unknown Item <span class="badge bg-warning ms-1">Error</span></h6>
                                <div class="item-info">Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 2) }}</div>
                            </div>
                        @endif
                        <div class="order-item-price">₹{{ number_format($item->total, 2) }}</div>
                    </div>
                    @endforeach
                    
                    @if($order->orderItems->count() > 3)
                    <div class="text-muted text-center py-2">
                        <small>+ {{ $order->orderItems->count() - 3 }} more items</small>
                    </div>
                    @endif
                </div>

                <div class="order-footer">
                    @if($order->coupon_code && $order->discount_amount > 0)
                    <div class="coupon-info mb-2">
                        <i class="fas fa-tag text-success me-1"></i>
                        <span class="text-success">{{ $order->coupon_code }}</span>
                        <span class="text-success">(-₹{{ number_format($order->discount_amount, 2) }})</span>
                    </div>
                    @endif
                    <div class="order-total">
                        Total: <span class="amount">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="order-actions">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn-order btn-view">
                            <i class="fas fa-eye me-1"></i>View Details
                        </a>
                        @if(in_array($order->status, ['confirmed', 'processing', 'shipped']))
                        <a href="{{ route('orders.show', $order->id) }}" class="btn-order btn-track">
                            <i class="fas fa-truck me-1"></i>Track Order
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            {{ $orders->links() }}
        @else
            <!-- Empty State -->
            <div class="empty-orders">
                <div class="empty-orders-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>No Orders Yet!</h3>
                <p>You haven't placed any orders yet. Start shopping to see your orders here.</p>
                <a href="{{ route('products.index') }}" class="btn-shop">
                    <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
