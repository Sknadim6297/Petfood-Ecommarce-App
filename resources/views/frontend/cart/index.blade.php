@extends('frontend.layouts.layout')

@section('title', 'Shopping Cart - PetNet')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>shop cart</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
        <div class="row">
          @if(empty($cartItems))
            <div class="col-12">
                <div class="empty-cart text-center">
                    <div class="empty-cart-icon mb-4">
                        <i class="fas fa-shopping-cart" style="font-size: 80px; color: #fa441d; opacity: 0.3;"></i>
                    </div>
                    <h3>Your Cart is Empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="button">Continue Shopping</a>
                </div>
            </div>
          @else
          <form class="woocommerce-cart-form">
            <div style="overflow-x:auto;overflow-y: hidden;">
              <table class="shop_table table-responsive">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Product</th>
                    <th class="product-name">Name</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-subtotal">Total</th>
                    <th class="product-remove"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($cartItems as $item)
                  <tr class="cart_item" data-product-id="{{ $item['id'] }}">
                    <td class="product-thumbnail">
                      <img decoding="async" width="70" height="70" 
                           src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('assets/img/food-1.png') }}" 
                           alt="{{ $item['name'] }}">
                    </td>
                    <td class="product-name" data-title="Product">
                      <a href="{{ route('product.show', $item['slug']) }}">{{ $item['name'] }}</a>
                      <div class="product-category">{{ $item['category'] }}</div>
                    </td>
                    <td class="product-price" data-title="Price">
                      @if($item['original_price'] > $item['price'])
                        <del>₹{{ number_format($item['original_price'], 2) }}</del>
                        <span class="sale-price">₹{{ number_format($item['price'], 2) }}</span>
                      @else
                        <span>₹{{ number_format($item['price'], 2) }}</span>
                      @endif
                    </td>
                    <td class="product-quantity" data-title="Quantity">
                      <div class="quantity-controls d-flex align-items-center">
                        <button type="button" class="quantity-btn minus" data-product-id="{{ $item['id'] }}">-</button>
                        <input type="number" class="quantity-input" value="{{ $item['quantity'] }}" min="1" data-product-id="{{ $item['id'] }}">
                        <button type="button" class="quantity-btn plus" data-product-id="{{ $item['id'] }}">+</button>
                      </div>
                    </td>
                    <td class="product-subtotal" data-title="Total">
                      <span class="item-total">₹{{ number_format($item['subtotal'], 2) }}</span>
                    </td>
                    <td class="product-remove">
                      <button type="button" class="remove-item" data-product-id="{{ $item['id'] }}" title="Remove this item">
                        <i class="fas fa-times"></i>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
                <div class="row mt-lg-5">
                  <div class="col-lg-6">
                    <div class="cart-actions">
                      <a href="{{ route('products.index') }}" class="button outline">Continue Shopping</a>
                      <button type="button" id="clear-cart" class="button outline ml-3">Clear Cart</button>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="cart_totals cart-Total">
                      <h4>Cart Totals</h4>
                      <table>
                        <tbody>
                          <tr class="cart-subtotal">
                            <th>Subtotal</th>
                            <td>₹{{ number_format($total, 2) }}</td>
                          </tr>
                          <tr class="shipping">
                            <th>Shipping</th>
                            <td>Free Shipping</td>
                          </tr>
                          <tr class="order-total">
                            <th>Total</th>
                            <td><strong>₹{{ number_format($total, 2) }}</strong></td>
                          </tr>
                        </tbody>
                      </table>
                      <a href="{{ route('checkout.index') }}" class="button w-100 mt-3">Proceed to Checkout</a>
                    </div>
                  </div>
                </div>
          </form>
          @endif
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Quantity controls
    $('.quantity-btn.plus').click(function() {
        const $input = $(this).siblings('.quantity-input');
        const currentVal = parseInt($input.val());
        const productId = $(this).data('product-id');
        updateQuantity(productId, currentVal + 1);
    });
    
    $('.quantity-btn.minus').click(function() {
        const $input = $(this).siblings('.quantity-input');
        const currentVal = parseInt($input.val());
        const productId = $(this).data('product-id');
        if (currentVal > 1) {
            updateQuantity(productId, currentVal - 1);
        }
    });
    
    $('.quantity-input').change(function() {
        const quantity = parseInt($(this).val());
        const productId = $(this).data('product-id');
        if (quantity >= 1) {
            updateQuantity(productId, quantity);
        }
    });
    
    // Remove item
    $('.remove-item').click(function() {
        const productId = $(this).data('product-id');
        removeItem(productId);
    });
    
    // Clear cart
    $('#clear-cart').click(function() {
        if (confirm('Are you sure you want to clear your cart?')) {
            clearCart();
        }
    });
    
    function updateQuantity(productId, quantity) {
        $.ajax({
            url: '{{ route("cart.update") }}',
            method: 'PUT',
            data: {
                product_id: productId,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    location.reload(); // Reload page to show updated totals
                } else {
                    alert(response.message);
                }
            }
        });
    }
    
    function removeItem(productId) {
        $.ajax({
            url: '{{ route("cart.remove") }}',
            method: 'DELETE',
            data: {
                product_id: productId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            }
        });
    }
    
    function clearCart() {
        $.ajax({
            url: '{{ route("cart.clear") }}',
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            }
        });
    }
});
</script>
@endsection
