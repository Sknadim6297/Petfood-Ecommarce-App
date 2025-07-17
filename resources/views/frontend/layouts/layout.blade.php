<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PetNet - Pet Food Ecommerce')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    
    @yield('styles')
</head>
<body>

<!-- loader -->
<div class="preloader"> 
    <div class="container">
        <div class="dot dot-1"></div>
        <div class="dot dot-2"></div>
        <div class="dot dot-3"></div>
    </div>
</div>

@include('frontend.sections.header')

@yield('content')

@include('frontend.sections.footer')

<!-- cart-popup -->
<div id="lightbox" class="lightbox clearfix" style="display: none;">
    <div class="white_content">
        <a href="javascript:;" class="textright" id="close"><i class="fa-regular fa-circle-xmark"></i></a>
        <div class="cart-popup">
            <div class="shop-cart">
                <ul id="cart-items">
                    <!-- Cart items will be loaded here via AJAX -->
                    <li class="text-center p-4"><p>Your cart is empty</p></li>
                </ul>
            </div>

            <div class="cart-total d-flex align-items-center justify-content-between">
                <span class="font-semi-bold">Total:</span>
                <span class="font-semi-bold total-price">₹0.00</span>
            </div>

            <div class="cart-btns d-flex align-items-center justify-content-between">
                <a class="font-bold" href="{{ route('cart.index') }}">View Cart</a>
                <a class="font-bold theme-bg-clr text-white checkout" href="{{ route('checkout.index') }}">Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- cart-popup end -->

<!-- search-popup -->
<div class="search-popup">
    <button class="close-search"><span class="fa fa-times"></span></button>
    <div class="search-box-outer">
        <div class="search-box">
            <form method="post" action="{{ route('products.search') }}">
                @csrf
                <div class="form-group">
                    <input type="search" name="search" placeholder="Search Here..." required="">
                    <button type="submit"><span class="fa fa-search"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- search-popup end -->

@yield('script')

<!-- JS Files -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/preloader.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Cart Functionality -->
<script>
$(document).ready(function() {
    // Update cart count on page load
    updateCartCount();
    
    // Add to cart functionality - Support multiple button classes
    $(document).on('click', '.add-to-cart, .add-to-cart-btn', function(e) {
        e.preventDefault();
        
        const $btn = $(this);
        const productId = $btn.data('product-id');
        const $quantityInput = $btn.closest('.food-box, .product-actions, .healthy-product, .col-lg-5, .card').find('.quantity-input');
        const quantity = parseInt($quantityInput.val()) || 1;
        const originalText = $btn.text();
        
        if (!productId) {
            showToast('Product ID not found', 'error');
            return;
        }
        
        $btn.prop('disabled', true).text('Adding...');
        
        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    updateCartCount();
                    showToast(response.message, 'success');
                } else {
                    showToast(response.message, 'error');
                }
            },
            error: function(xhr) {
                console.error('Cart Error:', xhr);
                showToast('Error adding product to cart', 'error');
            },
            complete: function() {
                $btn.prop('disabled', false).text(originalText);
            }
        });
    });
    
    // Remove from cart
    $(document).on('click', '.remove-cart-item', function(e) {
        e.preventDefault();
        
        const productId = $(this).data('product-id');
        
        $.ajax({
            url: '{{ route("cart.remove") }}',
            method: 'DELETE',
            data: {
                product_id: productId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    updateCartPopup();
                    updateCartCount();
                    showToast(response.message, 'success');
                }
            },
            error: function() {
                showToast('Error removing item from cart', 'error');
            }
        });
    });
    
    // Cart popup toggle - Override the existing #show handler
    $('#show').off('click').on('click', function(e) {
        e.preventDefault();
        updateCartPopup();
        if (typeof lightbox_open === 'function') {
            lightbox_open();
        } else {
            $("#lightbox").fadeIn(300);
            $(".white_content").animate({
                opacity: 1,
                width: '400px',
                right: 50
            }, 300);
        }
    });
    
    function updateCartCount() {
        $.get('{{ route("cart.count") }}', function(response) {
            $('.cart-count').text(response.count);
            $('.cart-count').attr('data-count', response.count);
            $('.cart-count').toggle(response.count > 0);
        }).fail(function() {
            console.error('Failed to update cart count');
        });
    }
    
    function updateCartPopup() {
        $.get('{{ route("cart.popup") }}', function(response) {
            $('#cart-items').html(response.html);
            $('.total-price').text('₹' + response.total.toFixed(2));
        }).fail(function() {
            console.error('Failed to update cart popup');
        });
    }
    
    function showToast(message, type) {
        // Remove any existing toasts
        $('.toast-notification').remove();
        
        // Create toast notification
        const toast = $(`
            <div class="toast-notification ${type}">
                <div class="toast-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="toast-close" onclick="$(this).parent().remove()">×</button>
            </div>
        `);
        
        $('body').append(toast);
        
        setTimeout(() => {
            toast.addClass('show');
        }, 100);
        
        setTimeout(() => {
            toast.removeClass('show');
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }
    
    // User dropdown functionality
    $('#userDropdownToggle, #mobileUserDropdownToggle').click(function(e) {
        e.preventDefault();
        $(this).parent('.dropdown').toggleClass('show');
    });
    
    // Close dropdown when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown').removeClass('show');
        }
    });
    
    // Prevent dropdown from closing when clicking inside
    $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
    });
});
</script>

<!-- Toast notification styles -->
<style>
.toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 99999;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 300px;
    max-width: 400px;
}

.toast-notification.show {
    transform: translateX(0);
}

.toast-notification.success {
    border-left: 4px solid #28a745;
}

.toast-notification.error {
    border-left: 4px solid #dc3545;
}

.toast-content {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
}

.toast-close {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    padding: 0;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.7;
    transition: opacity 0.2s ease;
}

.toast-close:hover {
    opacity: 1;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .toast-notification {
        top: 10px;
        right: 10px;
        left: 10px;
        min-width: auto;
        max-width: none;
        transform: translateY(-100px);
    }
    
    .toast-notification.show {
        transform: translateY(0);
    }
}

/* Ensure cart popup appears above other elements */
#lightbox {
    z-index: 9999;
}

.white_content {
    z-index: 10000;
}

/* Fix cart popup width for better mobile experience */
@media (max-width: 768px) {
    .white_content {
        width: 90% !important;
        right: 5% !important;
    }
}

/* Cart Count Badge Styling */
.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background: black;
    color: white;
    font-size: 11px;
    font-weight: bold;
    min-width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    border: 2px solid white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    animation: pulse 2s infinite;
}

.cart-count:empty {
    display: none !important;
}

/* Make the cart icon container position relative for absolute positioning of count */
.donation {
    position: relative;
    display: inline-block;
}

/* Pulse animation for cart count */
@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

/* Hide cart count when it's 0 */
.cart-count[data-count="0"] {
    display: none !important;
}
</style>

</body>
</html>
