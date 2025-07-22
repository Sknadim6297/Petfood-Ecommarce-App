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
                        @php
                            // Determine item type and create proper data attributes
                            $isProduct = !isset($item['item_type']) || $item['item_type'] === 'product';
                            $itemType = $isProduct ? 'product' : 'cooked_food';
                            $showRoute = $isProduct ? 'product.show' : 'cooked-food.show';
                        @endphp
                        <tr data-item-id="{{ $item['id'] }}" data-item-type="{{ $itemType }}">
                            <td class="product-remove">
                                <a href="#" class="remove-item" data-item-id="{{ $item['id'] }}" data-item-type="{{ $itemType }}">
                                    <i class="fa-solid fa-x"></i>
                                </a>
                            </td>
                            <td class="product-name">
                                <img alt="{{ $item['name'] }}" src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('assets/img/food-1.png') }}">
                                <div>
                                    <span>{{ $item['category'] ?? 'Pet Product' }}</span>
                                    <a href="{{ route($showRoute, $item['slug']) }}">{{ $item['name'] }}</a>
                                </div>
                            </td>
                            <td class="product-price">
                                <span class="woocommerce-Price-amount">
                                    <bdi><span class="woocommerce-Price-currencySymbol">₹</span>{{ number_format($item['current_price'], 2) }}</bdi>
                                    @if(isset($item['original_price']) && $item['original_price'] != $item['current_price'])
                                        <del>₹{{ number_format($item['original_price'], 2) }}</del>
                                    @endif
                                </span>          
                            </td>
                            <td class="product-quantity">
                                <div class="quantity-controls" style="display: flex; align-items: center; gap: 8px; justify-content: center;">
                                    <button type="button" class="qty-btn dec" 
                                            style="background: #fa441d; color: white; border: none; width: 35px; height: 35px; border-radius: 4px; cursor: pointer; font-size: 18px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                                        −
                                    </button>
                                    <input type="number" class="input-text quantity-input" min="1" max="999" 
                                           value="{{ $item['quantity'] }}" data-item-id="{{ $item['id'] }}" data-item-type="{{ $itemType }}"
                                           style="width: 70px; text-align: center; border: 1px solid #ddd; border-radius: 4px; padding: 8px; font-size: 14px;">
                                    <button type="button" class="qty-btn inc" 
                                            style="background: #fa441d; color: white; border: none; width: 35px; height: 35px; border-radius: 4px; cursor: pointer; font-size: 18px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                                        +
                                    </button>
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <span class="woocommerce-Price-amount item-subtotal">
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
                            
                            <!-- Coupon Application Form -->
                            <div class="coupon" id="coupon-form">
                                <input type="text" id="coupon_code" class="input-text" placeholder="Enter coupon code" maxlength="50">
                                <button type="button" id="apply-coupon-btn" class="button">Apply coupon</button>
                            </div>
                            
                            <!-- Applied Coupon Display -->
                            <div id="applied-coupon" style="display: none; margin-top: 15px;">
                                <div style="background: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; padding: 15px;">
                                    <div style="display: flex; justify-content: between; align-items: center;">
                                        <div>
                                            <strong id="coupon-display-code"></strong>
                                            <span id="coupon-display-discount" style="color: #28a745; font-weight: bold;"></span>
                                            <br>
                                            <small id="coupon-display-savings" style="color: #666;"></small>
                                        </div>
                                        <button type="button" id="remove-coupon-btn" style="background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Available Coupons -->
                            <div style="margin-top: 20px;">
                                <h5 style="margin-bottom: 10px; font-size: 14px; color: #666;">Available Coupons:</h5>
                                <div id="available-coupons" style="max-height: 150px; overflow-y: auto;"></div>
                            </div>
                            
                            <!-- Coupon Messages -->
                            <div id="coupon-message" style="margin-top: 15px;"></div>
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
                                                <span class="woocommerce-Price-currencySymbol">₹</span><span id="cart-subtotal">{{ number_format($total, 2) }}</span>
                                            </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="discount-row" id="discount-row" style="display: none;">
                                        <th>Discount:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount" style="color: #28a745;">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">-₹</span><span id="discount-amount">0.00</span>
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
                                                <span>₹</span><span id="cart-total">{{ number_format($finalTotal, 2) }}</span>
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
    $(document).on('click', '.qty-btn', function(e) {
        e.preventDefault();
        const $input = $(this).siblings('.quantity-input');
        const currentVal = parseInt($input.val()) || 1;
        const itemId = $input.data('item-id');
        const itemType = $input.data('item-type') || 'product';
        
        if ($(this).hasClass('inc')) {
            updateQuantity(itemId, itemType, currentVal + 1);
        } else if ($(this).hasClass('dec') && currentVal > 1) {
            updateQuantity(itemId, itemType, currentVal - 1);
        }
    });
    
    $(document).on('change blur', '.quantity-input', function(e) {
        const quantity = parseInt($(this).val()) || 1;
        const itemId = $(this).data('item-id');
        const itemType = $(this).data('item-type') || 'product';
        if (quantity >= 1 && quantity <= 999) {
            updateQuantity(itemId, itemType, quantity);
        } else {
            $(this).val(quantity < 1 ? 1 : 999);
        }
    });
    
    // Remove item
    $(document).on('click', '.remove-item', function(e) {
        e.preventDefault();
        const itemId = $(this).data('item-id');
        const itemType = $(this).data('item-type') || 'product';
        if (confirm('Are you sure you want to remove this item from cart?')) {
            removeItem(itemId, itemType);
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
    function updateQuantity(itemId, itemType, quantity) {
        // Validation
        if (!itemId || !quantity || quantity < 1 || quantity > 999) {
            return;
        }
        
        // Disable buttons during update
        const $row = $(`tr[data-item-id="${itemId}"]`);
        const $buttons = $row.find('.qty-btn');
        $buttons.prop('disabled', true);
        
        $.ajax({
            url: '{{ route("cart.update") }}',
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            data: {
                item_id: itemId,
                item_type: itemType,
                quantity: quantity,
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            },
            success: function(response) {
                if (response.success) {
                    updateCartUI(itemId, quantity, response);
                    
                    // Update header cart count if function exists
                    if (typeof updateCartCount === 'function') {
                        updateCartCount();
                    }
                } else {
                    showError(response.message || 'Error updating cart');
                }
            },
            error: function(xhr, status, error) {
                console.error('Cart update error:', xhr.responseText);
                
                let errorMessage = 'Error updating cart. Please try again.';
                
                if (xhr.status === 401) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.redirect) {
                            alert(response.message || 'Please login to continue.');
                            window.location.href = response.redirect;
                            return;
                        }
                    } catch (e) {
                        // Continue with default error handling
                    }
                    errorMessage = 'Please login to update cart items.';
                } else if (xhr.status === 405) {
                    errorMessage = 'Method not allowed. Please refresh the page and try again.';
                } else if (xhr.status === 422) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        errorMessage = response.message || 'Validation error occurred.';
                    } catch (e) {
                        errorMessage = 'Validation error occurred.';
                    }
                } else if (xhr.status === 404) {
                    errorMessage = 'Item not found. Please refresh the page.';
                }
                
                showError(errorMessage);
            },
            complete: function() {
                $buttons.prop('disabled', false);
            }
        });
    }
    
    // Update cart UI elements
    function updateCartUI(itemId, quantity, response) {
        const row = $(`tr[data-item-id="${itemId}"]`);
        const newSubtotal = response.new_subtotal || '0.00';
        const newTotal = parseFloat(response.cart_total) || 0;
        const shipping = parseFloat(response.shipping) || 0;
        const finalTotal = parseFloat(response.final_total) || 0;
        
        // Update product subtotal
        row.find('.item-subtotal').html(
            `<bdi><span class="woocommerce-Price-currencySymbol">₹</span>${newSubtotal}</bdi>`
        );
        
        // Update quantity input
        row.find('.quantity-input').val(quantity);
        
        // Update cart subtotal (not the final total)
        $('#cart-subtotal').text(newTotal.toFixed(2));
        
        // Update shipping display
        $('.Shipping .woocommerce-Price-amount').text(
            shipping === 0 ? 'free' : `₹${shipping.toFixed(2)}`
        );
        
        // Update final total
        $('#cart-total').text(finalTotal.toFixed(2));
    }
    
    // Remove item from cart
    function removeItem(itemId, itemType) {
        $.ajax({
            url: '{{ route("cart.remove") }}',
            method: 'POST',
            data: {
                item_id: itemId,
                item_type: itemType,
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                if (response.success) {
                    // Remove the row with animation
                    $(`tr[data-item-id="${itemId}"]`).fadeOut(300, function() {
                        $(this).remove();
                        
                        // Check if cart is empty
                        if ($('tbody tr:visible').length === 0) {
                            location.reload(); // Reload to show empty cart message
                        } else {
                            // Update totals with new response structure
                            const newTotal = parseFloat(response.cart_total) || 0;
                            const shipping = parseFloat(response.shipping) || 0;
                            const finalTotal = parseFloat(response.final_total) || 0;
                            
                            // Update subtotal
                            $('#cart-subtotal').text(newTotal.toFixed(2));
                            
                            // Update final total
                            $('#cart-total').text(finalTotal.toFixed(2));
                            
                            // Update shipping
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
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
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
    
    // Coupon functionality
    let appliedCoupon = @json($appliedCoupon ?? null);
    
    // Load applied coupon on page load
    if (appliedCoupon) {
        showAppliedCoupon(appliedCoupon, {{ $discountAmount ?? 0 }});
        updateCartTotalsOnLoad();
    }
    
    // Load available coupons on page load
    loadAvailableCoupons();
    
    // Apply coupon button click
    $('#apply-coupon-btn').click(function() {
        const couponCode = $('#coupon_code').val().trim();
        if (!couponCode) {
            showCouponMessage('Please enter a coupon code', 'error');
            return;
        }
        applyCoupon(couponCode);
    });
    
    // Remove coupon button click
    $('#remove-coupon-btn').click(function() {
        removeCoupon();
    });
    
    // Enter key on coupon input
    $('#coupon_code').keypress(function(e) {
        if (e.which === 13) {
            $('#apply-coupon-btn').click();
        }
    });
    
    function applyCoupon(code) {
        $('#apply-coupon-btn').prop('disabled', true).text('Applying...');
        showCouponMessage('Applying coupon...', 'info');
        
        $.ajax({
            url: '{{ route("coupons.apply") }}',
            method: 'POST',
            data: {
                coupon_code: code,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    appliedCoupon = response.coupon;
                    showAppliedCoupon(response.coupon, response.cart_totals.discount);
                    updateCartTotals(response.cart_totals);
                    showCouponMessage(response.message, 'success');
                    $('#coupon_code').val('');
                } else {
                    showCouponMessage(response.message, 'error');
                }
            },
            error: function() {
                showCouponMessage('Error applying coupon. Please try again.', 'error');
            },
            complete: function() {
                $('#apply-coupon-btn').prop('disabled', false).text('Apply coupon');
            }
        });
    }
    
    function removeCoupon() {
        $.ajax({
            url: '{{ route("coupons.remove") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    appliedCoupon = null;
                    hideAppliedCoupon();
                    updateCartTotals(response.cart_totals);
                    showCouponMessage(response.message, 'success');
                }
            },
            error: function() {
                showCouponMessage('Error removing coupon. Please try again.', 'error');
            }
        });
    }
    
    function showAppliedCoupon(coupon, discountAmount) {
        $('#coupon-display-code').text(coupon.code);
        
        let discountText = '';
        if (coupon.discount_type === 'percentage') {
            discountText = `${coupon.discount}% OFF`;
        } else {
            discountText = `₹${coupon.discount} OFF`;
        }
        $('#coupon-display-discount').text(discountText);
        
        $('#coupon-display-savings').text(`You saved ₹${discountAmount.toFixed(2)}`);
        
        $('#coupon-form').hide();
        $('#applied-coupon').show();
    }
    
    function hideAppliedCoupon() {
        $('#applied-coupon').hide();
        $('#coupon-form').show();
    }
    
    function updateCartTotals(totals) {
        $('#cart-subtotal').text(totals.subtotal.toFixed(2));
        $('#discount-amount').text(totals.discount.toFixed(2));
        $('#cart-total').text(totals.final_total.toFixed(2));
        
        if (totals.discount > 0) {
            $('#discount-row').show();
        } else {
            $('#discount-row').hide();
        }
    }
    
    function updateCartTotalsOnLoad() {
        const subtotal = {{ $total ?? 0 }};
        const discount = {{ $discountAmount ?? 0 }};
        const finalTotal = {{ $finalTotal ?? 0 }};
        
        $('#cart-subtotal').text(subtotal.toFixed(2));
        $('#discount-amount').text(discount.toFixed(2));
        $('#cart-total').text(finalTotal.toFixed(2));
        
        if (discount > 0) {
            $('#discount-row').show();
        }
    }
    
    function loadAvailableCoupons() {
        $.ajax({
            url: '{{ route("coupons.available") }}',
            method: 'GET',
            success: function(response) {
                if (response.success && response.coupons.length > 0) {
                    displayAvailableCoupons(response.coupons);
                }
            }
        });
    }
    
    function displayAvailableCoupons(coupons) {
        const container = $('#available-coupons');
        container.empty();
        
        coupons.forEach(function(coupon) {
            const discountText = coupon.discount_type === 'percentage' 
                ? `${coupon.discount}% OFF` 
                : `₹${coupon.discount} OFF`;
            
            const minOrderText = coupon.min_order_amount > 0 
                ? `Min. order: ₹${coupon.min_order_amount}` 
                : 'No minimum order';
            
            const couponHtml = `
                <div style="border: 1px solid #ddd; border-radius: 4px; padding: 10px; margin-bottom: 8px; background: #f9f9f9; cursor: pointer;" 
                     onclick="$('#coupon_code').val('${coupon.code}')">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong style="color: #fa441d;">${coupon.code}</strong>
                            <span style="color: #28a745; font-weight: bold; margin-left: 10px;">${discountText}</span>
                        </div>
                        <small style="color: #666;">Click to apply</small>
                    </div>
                    <small style="color: #666; display: block; margin-top: 2px;">${minOrderText}</small>
                </div>
            `;
            container.append(couponHtml);
        });
    }
    
    function showCouponMessage(message, type) {
        const container = $('#coupon-message');
        let className = '';
        let bgColor = '';
        let textColor = '';
        
        switch(type) {
            case 'success':
                bgColor = '#d4edda';
                textColor = '#155724';
                break;
            case 'error':
                bgColor = '#f8d7da';
                textColor = '#721c24';
                break;
            case 'info':
                bgColor = '#d1ecf1';
                textColor = '#0c5460';
                break;
        }
        
        container.html(`
            <div style="background: ${bgColor}; color: ${textColor}; padding: 10px; border-radius: 4px; margin-top: 10px;">
                ${message}
            </div>
        `);
        
        // Clear message after 5 seconds
        setTimeout(function() {
            container.empty();
        }, 5000);
    }
});
</script>
@endsection
