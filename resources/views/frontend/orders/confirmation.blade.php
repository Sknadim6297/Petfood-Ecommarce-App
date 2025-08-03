@extends('frontend.layouts.layout')

@section('title', 'Order Confirmation - PetNet')

@push('styles')
<style>
.confirmation-container {
    padding: 50px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}
.confirmation-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.1);
    text-align: center;
    margin-bottom: 30px;
}
.success-icon {
    font-size: 100px;
    color: #28a745;
    margin-bottom: 30px;
    animation: bounceIn 1s ease-in-out;
}
@keyframes bounceIn {
    0% { transform: scale(0.3); opacity: 0; }
    50% { transform: scale(1.05); }
    70% { transform: scale(0.9); }
    100% { transform: scale(1); opacity: 1; }
}
.order-details {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}
.order-header {
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 20px;
    margin-bottom: 25px;
}
.status-badge {
    background: linear-gradient(45deg, #28a745, #34d058);
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.order-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f8f9fa;
}
.order-item:last-child {
    border-bottom: none;
}
.item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 10px;
    margin-right: 20px;
}
.order-total {
    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
    border-radius: 15px;
    padding: 20px;
    margin-top: 20px;
}

/* Coupon Display Styles */
.coupon-info {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
    padding: 8px 16px;
    border-radius: 25px;
    border: 1px solid #c3e6cb;
    font-size: 14px;
    font-weight: 600;
    color: #28a745;
}

.coupon-info i {
    font-size: 13px;
}

.discount-applied {
    font-weight: 700;
    color: #28a745 !important;
}
.btn-continue {
    background: linear-gradient(45deg, #fa441d, #ff6b3d);
    border: none;
    color: white;
    padding: 15px 40px;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.btn-continue:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
    color: white;
    text-decoration: none;
}
.timeline {
    position: relative;
    padding: 20px 0;
}
.timeline-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    position: relative;
}
.timeline-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #28a745, #34d058);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    margin-right: 20px;
    flex-shrink: 0;
}
.timeline-content h6 {
    margin: 0;
    font-weight: 600;
    color: #333;
}
.timeline-content small {
    color: #666;
}
</style>
@endpush

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Order Confirmation</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="{{ route('cart.index') }}">Cart</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Order Confirmation</li>
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

<div class="confirmation-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Message -->
                <div class="confirmation-card">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2 class="mb-3">Order Placed Successfully!</h2>
                    <p class="text-muted mb-4">Thank you for your order. We'll send you a confirmation email shortly.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn-continue">
                            <i class="fas fa-home me-2"></i>Continue Shopping
                        </a>
                        <a href="#" class="btn btn-outline-primary" style="border-radius: 30px; padding: 15px 30px;">
                            <i class="fas fa-file-pdf me-2"></i>Download Invoice
                        </a>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="order-details">
                    <div class="order-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="mb-2">Order #{{ $order->order_number }}</h3>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar me-2"></i>
                                    Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <span class="status-badge">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-box me-2 text-primary"></i>Order Items
                        </h5>
                        @foreach($order->orderItems as $item)
                        <div class="order-item">
                            @if($item->item_type === 'cooked_food' && $item->cookedFood)
                                {{-- Cooked Food Item --}}
                                <img src="{{ $item->cookedFood->image ? asset('storage/' . $item->cookedFood->image) : asset('assets/img/product-placeholder.jpg') }}" 
                                     alt="{{ $item->cookedFood->name }}" class="item-image">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->cookedFood->name }}</h6>
                                    <span class="badge bg-success mb-1">Cooked Food</span>
                                    <p class="text-muted mb-1">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-muted mb-0">Unit Price: ₹{{ number_format($item->price, 2) }}</p>
                                </div>
                            @elseif($item->product)
                                {{-- Regular Product Item --}}
                                <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/img/product-placeholder.jpg') }}" 
                                     alt="{{ $item->product->name }}" class="item-image">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <span class="badge bg-primary mb-1">Product</span>
                                    <p class="text-muted mb-1">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-muted mb-0">Unit Price: ₹{{ number_format($item->price, 2) }}</p>
                                </div>
                            @else
                                {{-- Fallback for items with no valid product/cooked food --}}
                                <img src="{{ asset('assets/img/product-placeholder.jpg') }}" 
                                     alt="Unknown Item" class="item-image">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Unknown Item</h6>
                                    <span class="badge bg-warning mb-1">Error</span>
                                    <p class="text-muted mb-1">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-muted mb-0">Unit Price: ₹{{ number_format($item->price, 2) }}</p>
                                </div>
                            @endif
                            <div class="text-end">
                                <h6 class="mb-0 text-primary">₹{{ number_format($item->total, 2) }}</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="order-total">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Subtotal:</h6>
                                @if($order->coupon_code && $order->discount_amount > 0)
                                <h6 class="text-success">
                                    <i class="fas fa-tag me-1"></i>Coupon ({{ $order->coupon_code }}):
                                </h6>
                                @endif
                                <h6>Shipping:</h6>
                                <h5 class="text-success">Total Amount:</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <h6>₹{{ number_format($order->subtotal, 2) }}</h6>
                                @if($order->coupon_code && $order->discount_amount > 0)
                                <h6 class="text-success">-₹{{ number_format($order->discount_amount, 2) }}</h6>
                                @endif
                                <h6>{{ $order->shipping_amount == 0 ? 'Free' : '₹' . number_format($order->shipping_amount, 2) }}</h6>
                                <h5 class="text-success">₹{{ number_format($order->total_amount, 2) }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Information -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">
                                <i class="fas fa-truck me-2 text-primary"></i>Delivery Address
                            </h5>
                            <div class="p-3 bg-light rounded">
                                <h6 class="mb-2">{{ $order->user->name }}</h6>
                                <p class="mb-1">{{ $order->shipping_address }}</p>
                                <p class="mb-0"><strong>Phone:</strong> {{ $order->phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">
                                <i class="fas fa-credit-card me-2 text-primary"></i>Payment Information
                            </h5>
                            <div class="p-3 bg-light rounded">
                                <p class="mb-2">
                                    <strong>Payment Method:</strong> 
                                    {{ $order->payment_method == 'cash_on_delivery' ? 'Cash on Delivery' : 'Online Payment' }}
                                </p>
                                <p class="mb-0">
                                    <strong>Payment Status:</strong> 
                                    <span class="badge {{ $order->payment_status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Timeline -->
                    <div class="mt-4">
                        <h5 class="mb-3">
                            <i class="fas fa-clock me-2 text-primary"></i>Order Timeline
                        </h5>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Order Placed</h6>
                                    <small>{{ $order->created_at->format('M d, Y \a\t g:i A') }}</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon" style="background: #ddd;">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Order Processing</h6>
                                    <small>We'll notify you when your order is being processed</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon" style="background: #ddd;">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Out for Delivery</h6>
                                    <small>We'll notify you when your order is out for delivery</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon" style="background: #ddd;">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Delivered</h6>
                                    <small>We'll notify you when your order is delivered</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($order->order_notes)
                    <div class="mt-4">
                        <h5 class="mb-3">
                            <i class="fas fa-sticky-note me-2 text-primary"></i>Order Notes
                        </h5>
                        <div class="p-3 bg-light rounded">
                            <p class="mb-0">{{ $order->order_notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
