@extends('frontend.layouts.layout')

@section('title', 'Order Confirmation - PetNet')

@push('styles')
<style>
/* ========================================
   ORDER CONFIRMATION PAGE STYLES
======================================== */
.order-confirmation {
    padding: 50px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.confirmation-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    text-align: center;
    margin-bottom: 30px;
    border: 1px solid #e9ecef;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, #28a745, #34d058);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    animation: checkmark 0.6s ease-in-out;
    box-shadow: 0 4px 20px rgba(40, 167, 69, 0.3);
}

.success-icon i {
    color: white !important;
    font-size: 36px;
}

@keyframes checkmark {
    0% { 
        transform: scale(0);
        opacity: 0;
    }
    50% { 
        transform: scale(1.2);
        opacity: 0.8;
    }
    100% { 
        transform: scale(1);
        opacity: 1;
    }
}

.confirmation-card h2 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 28px;
}

.confirmation-card .text-muted {
    color: #6c757d !important;
    font-size: 16px;
    line-height: 1.6;
}

.confirmation-card .row {
    margin-top: 30px;
}

.confirmation-card h5 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 16px;
}

.confirmation-card .fw-bold {
    font-weight: 700 !important;
    color: #2c3e50;
}

.confirmation-card .text-primary {
    color: #fe5716 !important;
    font-size: 18px;
}

.order-details {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.order-details h4 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
    position: relative;
}

.order-details h4::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.order-item {
    border-bottom: 1px solid #eee;
    padding: 20px 0;
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

.order-item img {
    border-radius: 8px !important;
    border: 2px solid #f1f3f4;
    transition: all 0.3s ease;
}

.order-item:hover img {
    border-color: #fe5716;
    transform: scale(1.05);
}

.order-item h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 16px;
}

.order-item .text-muted {
    color: #6c757d !important;
    font-size: 14px;
}

.order-item .fw-bold {
    color: #fe5716 !important;
    font-weight: 700 !important;
}

.btn-continue {
    background: linear-gradient(45deg, #fe5716, #ff6b3d);
    border: none;
    color: white !important;
    padding: 15px 40px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(254, 87, 22, 0.2);
}

.btn-continue:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.4);
    color: white !important;
    text-decoration: none;
}

.btn-continue:focus {
    color: white !important;
    text-decoration: none;
}

.payment-status {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 14px;
    display: inline-block;
}

.payment-status.pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.payment-status.paid {
    background: #d1edff;
    color: #0c5460;
    border: 1px solid #b8daff;
}

.alert {
    border-radius: 10px;
    padding: 15px 20px;
    border: none;
    margin-top: 20px;
}

.alert-info {
    background: linear-gradient(135deg, #e3f2fd, #f0f8ff);
    color: #1976d2;
    border-left: 4px solid #2196f3;
}

.table {
    margin-bottom: 0;
}

.table td {
    border: none;
    padding: 8px 0;
    color: #495057;
}

.table .fw-bold {
    font-weight: 700 !important;
    color: #2c3e50;
}

.table .border-top td {
    border-top: 2px solid #fe5716 !important;
    padding-top: 15px !important;
    font-size: 18px;
}

.btn-outline-primary {
    color: #fe5716;
    border-color: #fe5716;
    background: transparent;
    font-weight: 600;
    padding: 12px 30px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: #fe5716;
    border-color: #fe5716;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(254, 87, 22, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .confirmation-card {
        padding: 25px;
    }
    
    .order-details {
        padding: 20px;
    }
    
    .confirmation-card h2 {
        font-size: 24px;
    }
    
    .success-icon {
        width: 60px;
        height: 60px;
    }
    
    .success-icon i {
        font-size: 28px;
    }
    
    .btn-continue {
        padding: 12px 30px;
        font-size: 14px;
        margin-bottom: 15px;
        display: block;
        text-align: center;
    }
    
    .order-item {
        padding: 15px 0;
    }
    
    .order-item img {
        max-height: 50px !important;
    }
}

@media (max-width: 576px) {
    .confirmation-card .row .col-md-4 {
        margin-bottom: 20px;
    }
    
    .order-item .row .col-md-2,
    .order-item .row .col-md-6 {
        margin-bottom: 10px;
    }
}

/* Animation enhancements */
.confirmation-card,
.order-details {
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
<section class="order-confirmation">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Message -->
                <div class="confirmation-card">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h2 class="mb-3">Order Placed Successfully!</h2>
                    <p class="text-muted mb-4">Thank you for your order. We've received your order and will process it shortly.</p>
                    
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h5>Order Number</h5>
                            <p class="fw-bold text-primary">{{ $order->order_number }}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>Order Date</h5>
                            <p class="fw-bold">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>Payment Status</h5>
                            <span class="payment-status {{ $order->payment_status }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                    
                    @if($order->payment_method === 'cash_on_delivery')
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            You have selected Cash on Delivery. Please keep the exact amount ready when your order arrives.
                        </div>
                    @endif
                </div>

                <!-- Order Details -->
                <div class="order-details">
                    <h4 class="mb-4">Order Details</h4>
                    
                    <!-- Order Items -->
                    <div class="order-items mb-4">
                        @foreach($order->orderItems as $item)
                        <div class="order-item">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/img/product-placeholder.jpg') }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="img-fluid rounded" style="max-height: 60px;">
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                </div>
                                <div class="col-md-2">
                                    <span class="fw-bold">₹{{ number_format($item->price, 2) }}</span>
                                </div>
                                <div class="col-md-2 text-end">
                                    <span class="fw-bold">₹{{ number_format($item->total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Shipping Address</h6>
                            <p class="text-muted">{{ $order->shipping_address }}</p>
                            <p class="text-muted"><i class="fas fa-phone me-1"></i>{{ $order->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Subtotal:</td>
                                    <td class="text-end">₹{{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                @if($order->coupon_code && $order->discount_amount > 0)
                                <tr style="color: #28a745;">
                                    <td>Discount ({{ $order->coupon_code }}):</td>
                                    <td class="text-end">-₹{{ number_format($order->discount_amount, 2) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Shipping:</td>
                                    <td class="text-end">
                                        {{ $order->shipping_amount == 0 ? 'Free' : '₹' . number_format($order->shipping_amount, 2) }}
                                    </td>
                                </tr>
                                <tr class="fw-bold border-top">
                                    <td>Total:</td>
                                    <td class="text-end">₹{{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($order->order_notes)
                    <div class="mt-4">
                        <h6>Order Notes</h6>
                        <p class="text-muted">{{ $order->order_notes }}</p>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="btn-continue me-3">
                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                    </a>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-list me-2"></i>View All Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
