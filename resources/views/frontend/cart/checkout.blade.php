@extends('frontend.layouts.layout')

@section('title', 'Checkout - PetNet')

@push('styles')
<style>
/* ========================================
   CHECKOUT PAGE STYLES - MODERN DESIGN
======================================== */

/* Main Container Styles */
.checkout-wrapper {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    min-height: 100vh;
    padding: 40px 0;
}

/* ========================================
   BILLING/ADDRESS SECTION
======================================== */
.billing-details {
    background: #ffffff;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    border: 1px solid #f0f2f5;
    position: relative;
    overflow: hidden;
}

.billing-details::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.billing-details h3 {
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 26px;
    font-weight: 700;
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 20px;
    position: relative;
}

.billing-details h3::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

/* ========================================
   ADDRESS CARDS
======================================== */
.address-card {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: #fafbfc;
    position: relative;
    overflow: hidden;
}

.address-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(254, 87, 22, 0.05), rgba(255, 122, 61, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.address-card:hover {
    border-color: #fe5716;
    background: #fff;
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(254, 87, 22, 0.15);
}

.address-card:hover::before {
    opacity: 1;
}

.address-card.selected {
    border-color: #fe5716;
    background: #fff;
    box-shadow: 0 12px 40px rgba(254, 87, 22, 0.2);
    transform: translateY(-2px);
}

.address-card.selected::before {
    opacity: 1;
}

.address-card .address-name {
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 12px;
    font-size: 18px;
    position: relative;
    z-index: 2;
}

.address-card .address-details {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.6;
    position: relative;
    z-index: 2;
}

.address-card .address-details div {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.address-card .address-details i {
    color: #fe5716;
    width: 18px;
    margin-right: 10px;
}

.address-card .address-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, #fe5716, #ff7a3d);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(254, 87, 22, 0.3);
    z-index: 3;
}

/* ========================================
   PAYMENT METHODS SECTION
======================================== */
.payment-methods {
    background: #ffffff;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    border: 1px solid #f0f2f5;
    position: relative;
    overflow: hidden;
}

.payment-methods::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.payment-methods h3 {
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 26px;
    font-weight: 700;
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 20px;
    position: relative;
}

.payment-methods h3::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.payment-method {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    background: #fafbfc;
    position: relative;
    overflow: hidden;
}

.payment-method::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(254, 87, 22, 0.05), rgba(255, 122, 61, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.payment-method:hover {
    border-color: #fe5716;
    background: #fff;
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(254, 87, 22, 0.15);
}

.payment-method:hover::before {
    opacity: 1;
}

.payment-method.selected {
    border-color: #fe5716;
    background: #fff;
    box-shadow: 0 12px 40px rgba(254, 87, 22, 0.2);
    transform: translateY(-2px);
}

.payment-method.selected::before {
    opacity: 1;
}

.payment-method.selected::after {
    content: '✓';
    position: absolute;
    top: 15px;
    right: 20px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fe5716, #ff7a3d);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
    box-shadow: 0 4px 15px rgba(254, 87, 22, 0.3);
}

.payment-method .payment-icon {
    font-size: 40px;
    color: #fe5716;
    margin-right: 20px;
    width: 60px;
    text-align: center;
    position: relative;
    z-index: 2;
}

.payment-method .payment-info {
    position: relative;
    z-index: 2;
}

.payment-method .payment-info h6 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 8px;
    font-size: 18px;
}

.payment-method .payment-info p {
    color: #6c757d;
    margin: 0;
    font-size: 14px;
    line-height: 1.5;
}

/* ========================================
   ORDER SUMMARY SECTION
======================================== */
.order-summary-box {
    background: #ffffff;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    position: sticky;
    top: 100px;
    border: 1px solid #f0f2f5;
    overflow: hidden;
    position: relative;
}

.order-summary-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.order-summary-box h4 {
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 24px;
    font-weight: 700;
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 20px;
    position: relative;
}

.order-summary-box h4::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

/* ========================================
   ORDER ITEMS
======================================== */
.order-item {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #f1f3f4;
    transition: all 0.3s ease;
}

.order-item:hover {
    background: rgba(254, 87, 22, 0.02);
    margin: 0 -15px;
    padding: 20px 15px;
    border-radius: 8px;
}

.order-item:last-child {
    border-bottom: none;
}

.order-item-image {
    width: 70px;
    height: 70px;
    border-radius: 10px;
    object-fit: cover;
    margin-right: 15px;
    border: 2px solid #f1f3f4;
    transition: all 0.3s ease;
}

.order-item:hover .order-item-image {
    border-color: #fe5716;
    transform: scale(1.05);
}

.order-item-details h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 15px;
    line-height: 1.4;
}

.order-item-details .item-qty {
    color: #6c757d;
    font-size: 13px;
    font-weight: 500;
}

.order-item-price {
    margin-left: auto;
    color: #fe5716;
    font-weight: 700;
    font-size: 18px;
}

/* ========================================
   ORDER TOTALS
======================================== */
.order-totals {
    margin-top: 30px;
    padding-top: 25px;
    border-top: 2px solid #f8f9fa;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    color: #2c3e50;
    font-size: 16px;
}

.total-row span:first-child {
    font-weight: 500;
}

.total-row span:last-child {
    font-weight: 600;
}

.total-row.final-total {
    font-weight: 700;
    font-size: 20px;
    color: #fe5716;
    border-top: 2px solid #f1f3f4;
    margin-top: 20px;
    padding-top: 20px;
    background: linear-gradient(135deg, rgba(254, 87, 22, 0.05), rgba(255, 122, 61, 0.05));
    margin: 20px -15px 0;
    padding: 20px 15px;
    border-radius: 10px;
}

/* ========================================
   BUTTONS - MATCHING CART PAGE STYLE
======================================== */
.button {
    background-color: #fe5716;
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.button:hover {
    background-color: #e84d0f;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.3);
}

.button:disabled {
    opacity: 0.6;
    transform: none;
    cursor: not-allowed;
    box-shadow: none;
}

.btn-add-address {
    background-color: #fe5716;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    cursor: pointer;
    width: auto;
}

.btn-add-address:hover {
    background-color: #e84d0f;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.3);
}

/* ========================================
   FORM ELEMENTS
======================================== */
.form-group {
    margin-bottom: 25px;
}

.form-group label {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #fafbfc;
}

.form-control:focus {
    border-color: #fe5716;
    outline: none;
    box-shadow: 0 0 0 4px rgba(254, 87, 22, 0.1);
    background: #fff;
    transform: translateY(-1px);
}

.form-control::placeholder {
    color: #adb5bd;
    font-style: italic;
}

/* ========================================
   ORDER NOTES SECTION
======================================== */
.order-notes-section {
    background: #ffffff;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    border: 1px solid #f0f2f5;
    position: relative;
    overflow: hidden;
}

.order-notes-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.order-notes-section h3 {
    color: #2c3e50;
    margin-bottom: 25px;
    font-size: 22px;
    font-weight: 700;
    position: relative;
}

.order-notes-section textarea {
    width: 100%;
    padding: 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    resize: vertical;
    min-height: 120px;
    font-size: 14px;
    font-family: inherit;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #fafbfc;
}

.order-notes-section textarea:focus {
    border-color: #fe5716;
    outline: none;
    box-shadow: 0 0 0 4px rgba(254, 87, 22, 0.1);
    background: #fff;
}

.order-notes-section textarea::placeholder {
    color: #adb5bd;
    font-style: italic;
}

/* ========================================
   EMPTY CART SECTION
======================================== */
.empty-cart-section {
    text-align: center;
    padding: 80px 40px;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    margin: 50px 0;
    border: 1px solid #f0f2f5;
}

.empty-cart-icon {
    font-size: 100px;
    color: #e9ecef;
    margin-bottom: 30px;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.empty-cart-section h3 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 32px;
    font-weight: 700;
}

.empty-cart-section p {
    color: #6c757d;
    margin-bottom: 40px;
    font-size: 18px;
    line-height: 1.6;
}

/* ========================================
   MODAL STYLES
======================================== */
.modal-content {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.modal-header {
    background: linear-gradient(135deg, #fe5716 0%, #ff7a3d 100%);
    color: white;
    border: none;
    padding: 25px 35px;
}

.modal-title {
    font-weight: 700;
    font-size: 20px;
}

.modal-body {
    padding: 35px;
    background: #fafbfc;
}

.modal-footer {
    border: none;
    padding: 25px 35px;
    background: #f8f9fa;
}

.btn-secondary {
    background: #6c757d;
    border: none;
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-1px);
    color: white;
}

/* ========================================
   RESPONSIVE DESIGN
======================================== */
@media (max-width: 768px) {
    .checkout-wrapper {
        padding: 20px 0;
    }
    
    .billing-details, 
    .payment-methods, 
    .order-summary-box, 
    .order-notes-section {
        padding: 25px 20px;
        margin-bottom: 20px;
    }
    
    .order-summary-box {
        position: static;
        margin-top: 30px;
    }
    
    .address-card,
    .payment-method {
        padding: 20px;
    }
    
    .payment-method {
        flex-direction: column;
        text-align: center;
    }
    
    .payment-method .payment-icon {
        margin-right: 0;
        margin-bottom: 15px;
        font-size: 50px;
    }
    
    .order-item {
        padding: 15px 0;
    }
    
    .order-item-image {
        width: 60px;
        height: 60px;
    }
    
    .button {
        padding: 16px 25px;
        font-size: 16px;
    }
    
    .total-row.final-total {
        font-size: 18px;
    }
    
    .empty-cart-section {
        padding: 60px 20px;
    }
    
    .empty-cart-icon {
        font-size: 80px;
    }
    
    .empty-cart-section h3 {
        font-size: 28px;
    }
    
    .empty-cart-section p {
        font-size: 16px;
    }
}

@media (max-width: 576px) {
    .billing-details h3,
    .payment-methods h3,
    .order-summary-box h4 {
        font-size: 20px;
    }
    
    .address-card .address-name {
        font-size: 16px;
    }
    
    .payment-method .payment-info h6 {
        font-size: 16px;
    }
    
    .modal-body,
    .modal-header,
    .modal-footer {
        padding: 20px;
    }
}

/* ========================================
   ANIMATION ENHANCEMENTS
======================================== */
.address-card,
.payment-method,
.order-item {
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

.billing-details,
.payment-methods,
.order-notes-section,
.order-summary-box {
    animation: fadeInScale 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Loading state animations */
.button:disabled {
    position: relative;
}

.button:disabled::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
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
                    <h2>Checkout</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="{{ route('cart.index') }}">Cart</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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

<section class="gap checkout-wrapper">
    <div class="container">
        @if(empty($cartItems) || count($cartItems) == 0)
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="empty-cart-section">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3>Your cart is empty!</h3>
                        <p>Add some amazing pet products to your cart before proceeding to checkout.</p>
                        <a href="{{ route('home') }}" class="button" style="width: auto; display: inline-block;">
                            <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <form id="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3>Shipping Address</h3>
                                <button type="button" class="btn btn-add-address" data-bs-toggle="modal" data-bs-target="#addressModal">
                                    <i class="fas fa-plus me-2"></i>Add New Address
                                </button>
                            </div>
                            
                            <div id="addresses-container">
                                @forelse($addresses as $address)
                                    <div class="address-card" data-address-id="{{ $address->id }}">
                                        @if($address->is_default)
                                            <div class="address-badge">Default</div>
                                        @endif
                                        <div class="address-name">{{ $address->name }}</div>
                                        <div class="address-details">
                                            <div><i class="fas fa-map-marker-alt me-2"></i>{{ $address->address_line_1 }}@if($address->address_line_2), {{ $address->address_line_2 }}@endif</div>
                                            <div><i class="fas fa-city me-2"></i>{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</div>
                                            <div><i class="fas fa-phone me-2"></i>{{ $address->phone }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="fas fa-map-marker-alt text-muted" style="font-size: 48px; margin-bottom: 20px;"></i>
                                        <p class="text-muted">No addresses found. Please add a shipping address to continue.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="payment-methods">
                            <h3>Payment Method</h3>
                            <div class="payment-method selected" data-payment="cod">
                                <div class="payment-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="payment-info">
                                    <h6>Cash on Delivery</h6>
                                    <p>Pay when your order is delivered to your doorstep</p>
                                </div>
                            </div>
                            
                            <!-- Hide online payment for now
                            <div class="payment-method" data-payment="online">
                                <div class="payment-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="payment-info">
                                    <h6>Online Payment</h6>
                                    <p>Pay securely online with your credit/debit card</p>
                                </div>
                            </div>
                            -->
                        </div>

                        <!-- Order Notes -->
                        <div class="order-notes-section">
                            <h3>Order Notes</h3>
                            <textarea name="order_notes" placeholder="Special instructions for your order, delivery preferences, or notes for our team..."></textarea>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <!-- Order Summary -->
                        <div class="order-summary-box">
                            <h4>Order Summary</h4>
                            
                            <!-- Cart Items -->
                            <div class="order-items">
                                @foreach($cartItems as $item)
                                <div class="order-item">
                                    <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('assets/img/product-placeholder.jpg') }}" 
                                         alt="{{ $item['name'] }}" class="order-item-image">
                                    <div class="order-item-details">
                                        <h6>{{ $item['name'] }}</h6>
                                        <div class="item-qty">Qty: {{ $item['quantity'] }}</div>
                                    </div>
                                    <div class="order-item-price">₹{{ number_format($item['total'], 2) }}</div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Order Totals -->
                            <div class="order-totals">
                                <div class="total-row">
                                    <span>Subtotal:</span>
                                    <span>₹{{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="total-row">
                                    <span>Shipping:</span>
                                    <span>{{ $shipping == 0 ? 'Free' : '₹' . number_format($shipping, 2) }}</span>
                                </div>
                                <div class="total-row">
                                    <span>Tax:</span>
                                    <span>₹0.00</span>
                                </div>
                                <div class="total-row final-total">
                                    <span>Total:</span>
                                    <span>₹{{ number_format($finalTotal, 2) }}</span>
                                </div>
                            </div>

                            <!-- Hidden Form Fields -->
                            <input type="hidden" name="payment_method" id="payment_method" value="">
                            <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="">

                            <!-- Place Order Button -->
                            <button type="submit" class="button" id="place-order-btn" disabled>
                                <i class="fas fa-lock me-2"></i>Place Order
                            </button>
                            
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Your payment information is secure and encrypted
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
</section>

<!-- Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">
                    <i class="fas fa-plus me-2"></i>Add New Shipping Address
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="address-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control" required placeholder="Enter your full name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" name="phone" class="form-control" required placeholder="Enter your phone number">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Address Line 1 *</label>
                                <input type="text" name="address_line_1" class="form-control" required placeholder="House/Flat number, Building name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Address Line 2</label>
                                <input type="text" name="address_line_2" class="form-control" placeholder="Area, Street, Sector, Village (Optional)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-control" required placeholder="Enter city">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">State *</label>
                                <input type="text" name="state" class="form-control" required placeholder="Enter state">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Postal Code *</label>
                                <input type="text" name="postal_code" class="form-control" required placeholder="Enter postal code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Country *</label>
                                <input type="text" name="country" class="form-control" value="India" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check" style="margin-top: 32px;">
                                    <input type="checkbox" name="is_default" class="form-check-input" value="1" id="defaultAddress">
                                    <label class="form-check-label" for="defaultAddress">Set as default address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="shipping">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" form="address-form" class="btn btn-add-address">
                    <i class="fas fa-save me-2"></i>Save Address
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    let selectedAddress = null;
    let selectedPayment = null;

    // Address Selection
    $(document).on('click', '.address-card', function() {
        $('.address-card').removeClass('selected');
        $(this).addClass('selected');
        selectedAddress = $(this).data('address-id');
        $('#shipping_address_id').val(selectedAddress);
        updateOrderButton();
    });

    // Payment Method Selection
    $(document).on('click', '.payment-method', function() {
        $('.payment-method').removeClass('selected');
        $(this).addClass('selected');
        selectedPayment = $(this).data('payment');
        $('#payment_method').val(selectedPayment);
        updateOrderButton();
    });

    // Update Order Button State
    function updateOrderButton() {
        const $btn = $('#place-order-btn');
        if (selectedAddress && selectedPayment) {
            $btn.prop('disabled', false);
        } else {
            $btn.prop('disabled', true);
        }
    }

    // Address Form Submission
    $('#address-form').on('submit', function(e) {
        e.preventDefault();
        
        const $btn = $(this).find('button[type="submit"]');
        const originalText = $btn.html();
        
        // Show loading state
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');
        
        // Get form data
        const formData = new FormData(this);
        
        // Send AJAX request to save address
        $.ajax({
            url: '{{ route("addresses.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Create new address card
                    const address = response.address;
                    const newAddressCard = `
                        <div class="address-card" data-address-id="${address.id}">
                            ${address.is_default ? '<div class="address-badge">Default</div>' : ''}
                            <div class="address-name">${address.name}</div>
                            <div class="address-details">
                                <div><i class="fas fa-map-marker-alt me-2"></i>${address.address_line_1}${address.address_line_2 ? ', ' + address.address_line_2 : ''}</div>
                                <div><i class="fas fa-city me-2"></i>${address.city}, ${address.state} ${address.postal_code}</div>
                                <div><i class="fas fa-phone me-2"></i>${address.phone}</div>
                            </div>
                        </div>
                    `;
                    
                    // Remove "no addresses" message if it exists
                    $('#addresses-container .text-center').remove();
                    
                    // Add the new address card
                    $('#addresses-container').append(newAddressCard);
                    
                    // Reset form and close modal
                    $('#address-form')[0].reset();
                    $('#addressModal').modal('hide');
                    
                    // Show success message
                    showNotification('Address added successfully!', 'success');
                } else {
                    showNotification(response.message || 'Error adding address', 'error');
                }
            },
            error: function(xhr) {
                let message = 'Error adding address. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = Object.values(xhr.responseJSON.errors);
                    message = errors.flat().join(', ');
                }
                showNotification(message, 'error');
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Checkout Form Submission
    $('#checkout-form').on('submit', function(e) {
        e.preventDefault();
        
        const $btn = $('#place-order-btn');
        const originalText = $btn.html();
        
        // Validate selections
        if (!selectedAddress) {
            showNotification('Please select a shipping address', 'error');
            return;
        }
        
        if (!selectedPayment) {
            showNotification('Please select a payment method', 'error');
            return;
        }
        
        // Show loading state
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Processing Order...');
        
        // Prepare form data
        const formData = new FormData(this);
        formData.append('shipping_address_id', selectedAddress);
        formData.append('payment_method', selectedPayment);
        
        // Send AJAX request to process order
        $.ajax({
            url: '{{ route("checkout.process") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    showNotification('Order placed successfully! Redirecting...', 'success');
                    
                    // Redirect to order confirmation or success page
                    setTimeout(() => {
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        } else {
                            window.location.href = '{{ route("orders.index") }}';
                        }
                    }, 2000);
                } else {
                    showNotification(response.message || 'Error processing order', 'error');
                    $btn.prop('disabled', false).html(originalText);
                }
            },
            error: function(xhr) {
                let message = 'Error processing order. Please try again.';
                if (xhr.status === 401) {
                    message = 'Please login to place your order';
                    setTimeout(() => {
                        window.location.href = '{{ route("login") }}';
                    }, 2000);
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = Object.values(xhr.responseJSON.errors);
                    message = errors.flat().join(', ');
                }
                showNotification(message, 'error');
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Notification function
    function showNotification(message, type = 'info') {
        const alertClass = type === 'success' ? 'alert-success' : type === 'error' ? 'alert-danger' : 'alert-info';
        const icon = type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle';
        
        const notification = $(`
            <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
                <i class="fas fa-${icon} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);
        
        $('body').append(notification);
        
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            notification.alert('close');
        }, 5000);
    }

    // Auto-select first address and COD payment method
    setTimeout(() => {
        const $firstAddress = $('.address-card').first();
        const $codPayment = $('.payment-method[data-payment="cod"]');
        
        if ($firstAddress.length) {
            $firstAddress.click();
        }
        
        // Auto-select COD since it's the only option
        if ($codPayment.length) {
            $codPayment.click();
        }
    }, 100);
});
</script>
@endpush
@endsection
