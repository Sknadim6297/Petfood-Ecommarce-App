@extends('frontend.layouts.layout')

@section('title', 'Shopping Cart - PetNet')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url(assets/img/banner.png)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>shop cart</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img">
                    <div class="banner-img-1">
                        <svg width="260" height="260" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="assets/img/banner-img-1.jpg" alt="banner">
                    </div>
                    <div class="banner-img-2">
                        <svg width="320" height="320" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="assets/img/banner-img-2.jpg" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="assets/img/hero-shaps-1.png" alt="hero-shaps" class="img-2">
    <img src="assets/img/hero-shaps-1.png" alt="hero-shaps" class="img-4">
</section>
<section class="gap">
    <div class="container">
        <div class="row">
          <form class="woocommerce-cart-form">
            <div style="overflow-x:auto;overflow-y: hidden;">
              <table class="shop_table table-responsive">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cartItems as $item)
                        <tr data-product-id="{{ $item['id'] }}">
                            <td class="product-remove">
                                <a href="#" class="remove-item" data-product-id="{{ $item['id'] }}">
                                    <i class="fa-solid fa-x"></i>
                                </a>
                            </td>
                            <td class="product-name">
                                <img alt="{{ $item['name'] }}" src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('assets/img/food-1.png') }}">
                                <div>
                                    <span>{{ $item['category'] ?? 'Pet Product' }}</span>
                                    <a href="{{ route('product.show', $item['slug']) }}">{{ $item['name'] }}</a>
                                </div>
                            </td>
                            <td class="product-price">
                                <span class="woocommerce-Price-amount">
                                    <bdi><span class="woocommerce-Price-currencySymbol">₹</span>{{ number_format($item['current_price'], 2) }}</bdi>
                                    @if($item['original_price'] != $item['current_price'])
                                        <del>₹{{ number_format($item['original_price'], 2) }}</del>
                                    @endif
                                </span>          
                            </td>
                            <td class="product-quantity">
                                <div class="quantity-controls" style="display: flex; align-items: center; gap: 8px; justify-content: center;">
                                    <button type="button" class="quantity-btn minus" data-product-id="{{ $item['id'] }}" 
                                            style="background: #fa441d; color: white; border: none; width: 35px; height: 35px; border-radius: 4px; cursor: pointer; font-size: 18px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                                        −
                                    </button>
                                    <input type="number" class="input-text quantity-input" min="1" max="999" 
                                           value="{{ $item['quantity'] }}" data-product-id="{{ $item['id'] }}" 
                                           style="width: 70px; text-align: center; border: 1px solid #ddd; border-radius: 4px; padding: 8px; font-size: 14px;">
                                    <button type="button" class="quantity-btn plus" data-product-id="{{ $item['id'] }}" 
                                            style="background: #fa441d; color: white; border: none; width: 35px; height: 35px; border-radius: 4px; cursor: pointer; font-size: 18px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                                        +
                                    </button>
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <span class="woocommerce-Price-amount">
                                    <bdi><span class="woocommerce-Price-currencySymbol">₹</span>{{ number_format($item['subtotal'], 2) }}</bdi>
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <p style="padding: 40px 0; font-size: 18px; color: #666;">
                                    Your cart is empty. <a href="{{ route('products.index') }}" style="color: #fa441d;">Continue shopping</a>
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
              </table>
            </div>
                <div class="row mt-lg-5">
                    @if(count($cartItems) > 0)
                    <div class="col-lg-5">
                        <div class="coupon-area">
                            <h3>Discount</h3>
                            <p>Enter a coupon code below to apply it</p>
                            <div class="coupon">
                                <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code">
                                <button type="submit" class="button" name="apply_coupon">Apply coupon
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                    @else
                    <div class="col-lg-12">
                    @endif
                        <div class="cart_totals">
                            <h4>Payment Total</h4>
                            <table class="shop_table_responsive">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount">
                                            <bdi>
                                                <span class="woocommerce-Price-currencySymbol">₹</span>{{ number_format($total, 2) }}
                                            </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="Shipping">
                                        <th>Shipping:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount amount">
                                                @if($shipping == 0)
                                                    free
                                                @else
                                                    ₹{{ number_format($shipping, 2) }}
                                                @endif
                                            </span>
                                         </td>
                                    </tr>
                                    <tr class="Total">
                                        <th>Total:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount">
                                            <bdi>
                                                <span>₹</span>{{ number_format($finalTotal, 2) }}
                                            </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="wc-proceed-to-checkout">
                            @if(count($cartItems) > 0)
                                <a href="{{ route('checkout.index') }}" class="button">Proceed to checkout</a>
                                <a href="#" id="clear-cart" class="button" style="margin-left: 10px;">Clear Cart</a>
                            @else
                                <a href="{{ route('products.index') }}" class="button">Continue Shopping</a>
                            @endif
                        </div>
                    </div>
                </div>
          </form>
        </div>
    </div>
</section>

<style>
.quantity-btn {
    transition: all 0.2s ease;
    user-select: none;
}
.quantity-btn:hover {
    background-color: #e63946 !important;
    transform: scale(1.05);
}
.quantity-btn:active {
    transform: scale(0.95);
}
.quantity-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none !important;
}
.quantity-input {
    -moz-appearance: textfield;
}
.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Cart functionality with optimized event handling
    
    // Quantity controls with event delegation
    $(document).on('click', '.quantity-btn.plus', function(e) {
        e.preventDefault();
        const $input = $(this).siblings('.quantity-input');
        const currentVal = parseInt($input.val()) || 1;
        const productId = $(this).data('product-id');
        updateQuantity(productId, currentVal + 1);
    });
    
    $(document).on('click', '.quantity-btn.minus', function(e) {
        e.preventDefault();
        const $input = $(this).siblings('.quantity-input');
        const currentVal = parseInt($input.val()) || 1;
        const productId = $(this).data('product-id');
        if (currentVal > 1) {
            updateQuantity(productId, currentVal - 1);
        }
    });
    
    $(document).on('change blur', '.quantity-input', function(e) {
        const quantity = parseInt($(this).val()) || 1;
        const productId = $(this).data('product-id');
        if (quantity >= 1 && quantity <= 999) {
            updateQuantity(productId, quantity);
        } else {
            $(this).val(quantity < 1 ? 1 : 999);
        }
    });
    
    // Remove item
    $(document).on('click', '.remove-item', function(e) {
        e.preventDefault();
        const productId = $(this).data('product-id');
        if (confirm('Are you sure you want to remove this item from cart?')) {
            removeItem(productId);
        }
    });
    
    // Clear cart
    $(document).on('click', '#clear-cart', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to clear your entire cart?')) {
            clearCart();
        }
    });
    
    // Optimized quantity update function
    function updateQuantity(productId, quantity) {
        // Validation
        if (!productId || !quantity || quantity < 1 || quantity > 999) {
            return;
        }
        
        // Disable buttons during update
        const $buttons = $(`.quantity-btn[data-product-id="${productId}"]`);
        $buttons.prop('disabled', true);
        
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
                    updateCartUI(productId, quantity, response);
                    
                    // Update header cart count if function exists
                    if (typeof updateCartCount === 'function') {
                        updateCartCount();
                    }
                } else {
                    showError(response.message || 'Error updating cart');
                }
            },
            error: function(xhr) {
                showError('Error updating cart. Please try again.');
            },
            complete: function() {
                $buttons.prop('disabled', false);
            }
        });
    }
    
    // Update cart UI elements
    function updateCartUI(productId, quantity, response) {
        const row = $(`tr[data-product-id="${productId}"]`);
        const newSubtotal = response.new_subtotal || '0.00';
        const newTotal = response.new_total || '0.00';
        const shipping = parseFloat(response.shipping) || 0;
        const finalTotal = response.final_total || '0.00';
        
        // Update product subtotal
        row.find('.product-subtotal .woocommerce-Price-amount').html(
            `<bdi><span class="woocommerce-Price-currencySymbol">₹</span>${newSubtotal}</bdi>`
        );
        
        // Update quantity input
        row.find('.quantity-input').val(quantity);
        
        // Update cart totals
        $('.cart-subtotal .woocommerce-Price-amount').html(
            `<bdi><span class="woocommerce-Price-currencySymbol">₹</span>${newTotal}</bdi>`
        );
        
        // Update shipping
        $('.Shipping .woocommerce-Price-amount').text(
            shipping === 0 ? 'free' : `₹${shipping.toFixed(2)}`
        );
        
        // Update final total
        $('.Total .woocommerce-Price-amount').html(
            `<bdi><span>₹</span>${finalTotal}</bdi>`
        );
    }
    
    // Remove item from cart
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
                    // Remove the row with animation
                    $(`tr[data-product-id="${productId}"]`).fadeOut(300, function() {
                        $(this).remove();
                        
                        // Check if cart is empty
                        if ($('tbody tr:visible').length === 0) {
                            location.reload(); // Reload to show empty cart message
                        } else {
                            // Update totals with new response structure
                            const newTotal = response.new_total || '0.00';
                            const shipping = parseFloat(response.shipping) || 0;
                            const finalTotal = response.final_total || '0.00';
                            
                            $('.cart-subtotal .woocommerce-Price-amount').html(
                                `<bdi><span class="woocommerce-Price-currencySymbol">₹</span>${newTotal}</bdi>`
                            );
                            $('.Total .woocommerce-Price-amount').html(
                                `<bdi><span>₹</span>${finalTotal}</bdi>`
                            );
                            $('.Shipping .woocommerce-Price-amount').text(
                                shipping === 0 ? 'free' : `₹${shipping.toFixed(2)}`
                            );
                        }
                        
                        // Update header cart count
                        if (typeof updateCartCount === 'function') {
                            updateCartCount();
                        }
                    });
                } else {
                    showError(response.message || 'Error removing item from cart');
                }
            },
            error: function() {
                showError('Error removing item from cart. Please try again.');
            }
        });
    }
    
    // Clear entire cart
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
                } else {
                    showError(response.message || 'Error clearing cart');
                }
            },
            error: function() {
                showError('Error clearing cart. Please try again.');
            }
        });
    }
    
    // Show error message
    function showError(message) {
        alert(message);
    }
});
</script>
@endsection
