@extends('frontend.layouts.layout')

@section('title', 'Payment - PetNet')

@push('styles')
<style>
.payment-container {
    padding: 50px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}
.payment-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}
.payment-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 30px 0;
}
.payment-option {
    border: 2px solid #e0e0e0;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}
.payment-option:hover {
    border-color: #fa441d;
    box-shadow: 0 4px 15px rgba(250, 68, 29, 0.1);
    transform: translateY(-2px);
}
.payment-option.selected {
    border-color: #fa441d;
    background: linear-gradient(135deg, #fff8f5 0%, #fff 100%);
    box-shadow: 0 6px 20px rgba(250, 68, 29, 0.15);
}
.payment-option img {
    height: 40px;
    margin-bottom: 15px;
}
.payment-option h6 {
    margin-bottom: 10px;
    font-weight: 600;
}
.btn-pay-now {
    background: linear-gradient(45deg, #28a745, #34d058);
    border: none;
    color: white;
    padding: 18px 40px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 16px;
    width: 100%;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.btn-pay-now:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    color: white;
}
.btn-pay-now:disabled {
    background: #6c757d;
    cursor: not-allowed;
}
.order-summary {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
}
.security-info {
    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    margin-top: 20px;
}
.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #ffffff;
    border-radius: 50%;
    border-top-color: transparent;
    animation: spin 0.8s ease-in-out infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
@endpush

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Secure Payment</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="{{ route('cart.index') }}">Cart</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Payment</li>
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

<div class="payment-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-card">
                    <div class="text-center mb-4">
                        <h2><i class="fas fa-credit-card me-3 text-primary"></i>Complete Your Payment</h2>
                        <p class="text-muted">Order #{{ $order->order_number }}</p>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary">
                        <h5 class="mb-3">
                            <i class="fas fa-receipt me-2 text-primary"></i>Payment Summary
                        </h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Order Total:</span>
                            <span class="fw-bold">₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span class="fw-bold">{{ $order->shipping_cost == 0 ? 'Free' : '₹' . number_format($order->shipping_cost, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="h5">Amount to Pay:</span>
                            <span class="h5 text-success">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <h5 class="mb-3">
                        <i class="fas fa-wallet me-2 text-primary"></i>Choose Payment Method
                    </h5>
                    
                    <div class="payment-methods">
                        <div class="payment-option" data-method="card">
                            <i class="fas fa-credit-card text-primary" style="font-size: 40px; margin-bottom: 15px;"></i>
                            <h6>Credit/Debit Card</h6>
                            <small class="text-muted">Visa, Mastercard, RuPay</small>
                        </div>
                        
                        <div class="payment-option" data-method="upi">
                            <i class="fas fa-mobile-alt text-success" style="font-size: 40px; margin-bottom: 15px;"></i>
                            <h6>UPI Payment</h6>
                            <small class="text-muted">Google Pay, PhonePe, Paytm</small>
                        </div>
                        
                        <div class="payment-option" data-method="netbanking">
                            <i class="fas fa-university text-info" style="font-size: 40px; margin-bottom: 15px;"></i>
                            <h6>Net Banking</h6>
                            <small class="text-muted">All major banks</small>
                        </div>
                        
                        <div class="payment-option" data-method="wallet">
                            <i class="fas fa-wallet text-warning" style="font-size: 40px; margin-bottom: 15px;"></i>
                            <h6>Digital Wallet</h6>
                            <small class="text-muted">Paytm, Amazon Pay</small>
                        </div>
                    </div>

                    <!-- Payment Form (Hidden by default) -->
                    <div id="payment-form" style="display: none;">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-lock me-2"></i>
                                    Secure Payment Details
                                </h6>
                            </div>
                            <div class="card-body">
                                <form id="payment-details-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Card Number</label>
                                            <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Cardholder Name</label>
                                            <input type="text" class="form-control" placeholder="John Doe">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Expiry Month</label>
                                            <select class="form-control">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                                <option>06</option>
                                                <option>07</option>
                                                <option>08</option>
                                                <option>09</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Expiry Year</label>
                                            <select class="form-control">
                                                @for($year = date('Y'); $year <= date('Y') + 10; $year++)
                                                <option>{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">CVV</label>
                                            <input type="text" class="form-control" placeholder="123" maxlength="4">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pay Button -->
                    <button class="btn-pay-now mt-4" id="pay-now-btn" disabled>
                        <i class="fas fa-lock me-2"></i>Select Payment Method
                    </button>

                    <!-- Security Info -->
                    <div class="security-info">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="mb-2">
                                    <i class="fas fa-shield-alt me-2 text-success"></i>
                                    Your payment is secured with 256-bit SSL encryption
                                </h6>
                                <small class="text-muted">
                                    We never store your payment information. All transactions are processed securely.
                                </small>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-certificate text-success" style="font-size: 40px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    let selectedPaymentMethod = null;

    // Payment method selection
    $('.payment-option').click(function() {
        $('.payment-option').removeClass('selected');
        $(this).addClass('selected');
        selectedPaymentMethod = $(this).data('method');
        
        // Show/hide payment form based on method
        if (selectedPaymentMethod === 'card') {
            $('#payment-form').slideDown();
        } else {
            $('#payment-form').slideUp();
        }
        
        updatePayButton();
    });

    // Update pay button
    function updatePayButton() {
        const btn = $('#pay-now-btn');
        if (selectedPaymentMethod) {
            btn.prop('disabled', false);
            btn.html('<i class="fas fa-lock me-2"></i>Pay ₹{{ number_format($order->total_amount, 2) }} Securely');
        } else {
            btn.prop('disabled', true);
            btn.html('<i class="fas fa-exclamation-circle me-2"></i>Select Payment Method');
        }
    }

    // Process payment
    $('#pay-now-btn').click(function() {
        const btn = $(this);
        const originalText = btn.html();
        btn.prop('disabled', true).html('<div class="loading-spinner me-2"></div>Processing Payment...');

        // Simulate payment processing
        setTimeout(() => {
            $.ajax({
                url: '{{ route("orders.process-payment", $order->id) }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    payment_method: selectedPaymentMethod
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        btn.html('<i class="fas fa-check me-2"></i>Payment Successful!');
                        btn.removeClass('btn-pay-now').addClass('btn-success');
                        
                        // Redirect after 2 seconds
                        setTimeout(() => {
                            window.location.href = response.redirect_url;
                        }, 2000);
                    } else {
                        btn.prop('disabled', false).html(originalText);
                        alert(response.message || 'Payment failed. Please try again.');
                    }
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalText);
                    alert('Payment failed. Please try again.');
                }
            });
        }, 2000); // Simulate processing delay
    });

    // Format card number input
    $(document).on('input', 'input[placeholder="1234 5678 9012 3456"]', function() {
        let value = $(this).val().replace(/\s/g, '').replace(/[^0-9]/gi, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        $(this).val(formattedValue);
    });
});
</script>
@endpush
@endsection
