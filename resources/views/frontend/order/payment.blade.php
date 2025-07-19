@extends('frontend.layouts.layout')

@section('title', 'Payment - PetNet')

@push('styles')
<style>
.payment-section {
    padding: 50px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
.payment-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}
.payment-method {
    border: 2px solid #e0e0e0;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}
.payment-method:hover, .payment-method.selected {
    border-color: #fa441d;
    background-color: #fff8f5;
}
.payment-method i {
    font-size: 48px;
    color: #fa441d;
    margin-bottom: 10px;
}
.btn-pay {
    background: linear-gradient(45deg, #fa441d, #ff6b3d);
    border: none;
    color: white;
    padding: 15px 40px;
    border-radius: 25px;
    font-weight: 600;
    width: 100%;
    transition: all 0.3s ease;
}
.btn-pay:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(250, 68, 29, 0.3);
    color: white;
}
.order-summary {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
}
</style>
@endpush

@section('content')
<section class="payment-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-card">
                    <h3 class="text-center mb-4">Complete Your Payment</h3>
                    
                    <!-- Order Summary -->
                    <div class="order-summary">
                        <h5 class="mb-3">Order Summary</h5>
                        <div class="d-flex justify-content-between">
                            <span>Order Number:</span>
                            <span class="fw-bold">{{ $order->order_number }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Total Amount:</span>
                            <span class="fw-bold text-primary fs-4">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <h5 class="mb-3">Select Payment Method</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="payment-method" data-method="card">
                                <i class="fas fa-credit-card"></i>
                                <h6>Credit/Debit Card</h6>
                                <p class="text-muted mb-0">Visa, MasterCard, RuPay</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="payment-method" data-method="upi">
                                <i class="fab fa-google-pay"></i>
                                <h6>UPI Payment</h6>
                                <p class="text-muted mb-0">GPay, PhonePe, PayTM</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="payment-method" data-method="netbanking">
                                <i class="fas fa-university"></i>
                                <h6>Net Banking</h6>
                                <p class="text-muted mb-0">All major banks</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form id="payment-form" class="mt-4">
                        @csrf
                        <input type="hidden" name="payment_method_type" id="payment_method_type" value="">
                        
                        <!-- Card Payment Details -->
                        <div id="card-details" class="payment-details" style="display: none;">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Card Number</label>
                                    <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" placeholder="MM/YY" maxlength="5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">CVV</label>
                                    <input type="text" class="form-control" placeholder="123" maxlength="3">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Cardholder Name</label>
                                    <input type="text" class="form-control" placeholder="Name on card">
                                </div>
                            </div>
                        </div>

                        <!-- UPI Details -->
                        <div id="upi-details" class="payment-details" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">UPI ID</label>
                                <input type="text" class="form-control" placeholder="yourname@upi">
                            </div>
                        </div>

                        <!-- Net Banking Details -->
                        <div id="netbanking-details" class="payment-details" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Select Bank</label>
                                <select class="form-control">
                                    <option value="">Choose your bank</option>
                                    <option value="sbi">State Bank of India</option>
                                    <option value="hdfc">HDFC Bank</option>
                                    <option value="icici">ICICI Bank</option>
                                    <option value="axis">Axis Bank</option>
                                    <option value="kotak">Kotak Mahindra Bank</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn-pay" disabled>
                            <i class="fas fa-lock me-2"></i>Pay Securely ₹{{ number_format($order->total_amount, 2) }}
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            Your payment information is secured with 256-bit SSL encryption
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    let selectedMethod = null;

    // Payment method selection
    $('.payment-method').click(function() {
        $('.payment-method').removeClass('selected');
        $(this).addClass('selected');
        
        selectedMethod = $(this).data('method');
        $('#payment_method_type').val(selectedMethod);
        
        // Hide all payment details
        $('.payment-details').hide();
        
        // Show selected payment details
        $('#' + selectedMethod + '-details').show();
        
        // Enable pay button
        $('.btn-pay').prop('disabled', false);
    });

    // Format card number
    $('input[placeholder="1234 5678 9012 3456"]').on('input', function() {
        let value = $(this).val().replace(/\s/g, '').replace(/[^0-9]/gi, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        $(this).val(formattedValue);
    });

    // Format expiry date
    $('input[placeholder="MM/YY"]').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        $(this).val(value);
    });

    // Process payment
    $('#payment-form').on('submit', function(e) {
        e.preventDefault();
        
        if (!selectedMethod) {
            alert('Please select a payment method');
            return;
        }
        
        const $btn = $('.btn-pay');
        const originalText = $btn.html();
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Processing Payment...');
        
        // Simulate payment processing
        setTimeout(() => {
            $.ajax({
                url: '{{ route("order.processPayment", $order->id) }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    payment_method_type: selectedMethod
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        alert('Payment successful! Redirecting to order confirmation...');
                        window.location.href = response.redirect_url;
                    } else {
                        alert(response.message || 'Payment failed. Please try again.');
                        $btn.prop('disabled', false).html(originalText);
                    }
                },
                error: function() {
                    alert('Payment failed. Please try again.');
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        }, 2000);
    });
});
</script>
@endsection
