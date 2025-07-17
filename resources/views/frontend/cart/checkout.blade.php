@extends('frontend.layouts.layout')

@section('title', 'Checkout - PetNet')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
@endpush

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Cart Checkout</h2>
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

<section class="gap"> 
    <div class="container">
        <form class="checkout-meta donate-page" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing details</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input type="text" id="first_name" name="first_name" required class="form-control" 
                                       value="{{ auth()->check() ? explode(' ', auth()->user()->name)[0] ?? '' : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" required class="form-control"
                                       value="{{ auth()->check() ? explode(' ', auth()->user()->name)[1] ?? '' : '' }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="company">Company Name (Optional)</label>
                        <input type="text" id="company" name="company" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="country">Country / Region *</label>
                        <select id="country" name="country" required class="form-control">
                            <option value="IN" selected>India</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Street Address *</label>
                        <input type="text" id="address" name="address" required class="form-control" placeholder="House number and street name">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="address_2" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="city">Town / City *</label>
                                <input type="text" id="city" name="city" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="state">State *</label>
                                <select id="state" name="state" required class="form-control">
                                    <option value="">Select State</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                    <option value="Delhi">Delhi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="postal_code">Postal Code / ZIP *</label>
                        <input type="text" id="postal_code" name="postal_code" required class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required class="form-control" 
                               value="{{ auth()->check() ? auth()->user()->email : '' }}">
                    </div>
                    
                    <div class="woocommerce-additional-fields">
                        <h3>Additional Information</h3>
                        <div class="form-group">
                            <label for="order_notes">Order Notes (Optional)</label>
                            <textarea id="order_notes" name="order_notes" class="form-control" rows="4" 
                                      placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="woocommerce-additional-fields">
                        <div class="checkout-side">
                            <h3>Your Order</h3>
                            <div class="order-review">
                                <table class="shop_table_responsive">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(session('cart'))
                                            @foreach(session('cart') as $item)
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ $item['name'] }} 
                                                    <strong class="product-quantity">× {{ $item['quantity'] }}</strong>
                                                </td>
                                                <td class="product-total">
                                                    ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td>₹{{ number_format(session('cart') ? collect(session('cart'))->sum(function($item) { return $item['price'] * $item['quantity']; }) : 0, 2) }}</td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td>Free Shipping</td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong>₹{{ number_format(session('cart') ? collect(session('cart'))->sum(function($item) { return $item['price'] * $item['quantity']; }) : 0, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            <div class="payment-methods mt-4">
                                <h4>Payment Methods</h4>
                                
                                <div class="payment-method">
                                    <input type="radio" id="cod" name="payment_method" value="cod" checked>
                                    <label for="cod">
                                        <i class="fas fa-money-bill-wave"></i>
                                        Cash on Delivery
                                    </label>
                                    <div class="payment-description">
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                </div>
                                
                                <div class="payment-method">
                                    <input type="radio" id="online" name="payment_method" value="online">
                                    <label for="online">
                                        <i class="fas fa-credit-card"></i>
                                        Online Payment
                                    </label>
                                    <div class="payment-description">
                                        <p>Pay securely using your credit/debit card or net banking.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="privacy-policy mt-4">
                                <label class="checkbox-container">
                                    <input type="checkbox" required name="terms_accepted">
                                    I have read and agree to the website 
                                    <a href="#" target="_blank">terms and conditions</a> *
                                </label>
                            </div>
                            
                            <button type="submit" class="button w-100 mt-4" id="place-order-btn">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
$(document).ready(function() {
    $('#checkout-form').on('submit', function(e) {
        e.preventDefault();
        
        const $btn = $('#place-order-btn');
        const originalText = $btn.text();
        
        // Validate form
        if (!this.checkValidity()) {
            this.reportValidity();
            return;
        }
        
        // Show loading state
        $btn.prop('disabled', true).text('Processing...');
        
        // Get form data
        const formData = new FormData(this);
        
        // Simulate order processing (replace with actual order processing)
        setTimeout(() => {
            // Show success message
            alert('Order placed successfully! You will receive a confirmation email shortly.');
            
            // Clear cart and redirect
            clearCartAndRedirect();
        }, 2000);
    });
    
    function clearCartAndRedirect() {
        $.ajax({
            url: '{{ route("cart.clear") }}',
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                // Redirect to success page or home
                window.location.href = '{{ route("home") }}';
            }
        });
    }
    
    // Payment method selection
    $('input[name="payment_method"]').change(function() {
        $('.payment-method').removeClass('selected');
        $(this).closest('.payment-method').addClass('selected');
    });
});
</script>
@endsection
