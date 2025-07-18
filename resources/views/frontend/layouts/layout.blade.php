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

<!-- Cart and Wishlist Management -->
<script src="{{ asset('assets/js/cart-wishlist.js') }}"></script>

<!-- Cart Functionality -->
<script>
$(document).ready(function() {
    // Update counts on page load
    if (window.cartWishlistManager) {
        window.cartWishlistManager.updateCounts();
        // Update wishlist icons to show current state
        window.cartWishlistManager.updateWishlistIcons();
    }
    
    // Remove from cart (for cart popup only)
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
                    if (window.cartWishlistManager) {
                        window.cartWishlistManager.updateCartCount();
                    }
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
    
    function updateCartPopup() {
        $.get('{{ route("cart.popup") }}', function(response) {
            $('#cart-items').html(response.html);
            $('.total-price').text('₹' + response.total.toFixed(2));
        }).fail(function() {
            console.error('Failed to update cart popup');
        });
    }
    
    // Use universal toast function from cart-wishlist.js
    function showToast(message, type) {
        if (window.cartWishlistManager) {
            window.cartWishlistManager.showToast(message, type);
        } else {
            // Fallback if cart-wishlist.js isn't loaded
            console.log(type.toUpperCase() + ': ' + message);
        }
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
.cart-count, .wishlist-count {
    position: absolute;
    top: -8px;
    right: -10px;
    background: #FF6B35;
    color: white;
    font-size: 10px;
    font-weight: 700;
    min-width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(255, 107, 53, 0.3);
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    z-index: 10;
}

.cart-count:empty, .wishlist-count:empty {
    display: none !important;
}

/* Make the cart and wishlist icon containers position relative */
.donation, .wishlist-icon {
    position: relative;
    display: inline-block;
}

/* Wishlist specific styling */
.wishlist-count {
    background: #e74c3c;
    box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
}

.wishlist-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    transition: all 0.3s ease;
    position: relative;
}

.wishlist-link:hover {
    color: #e74c3c;
}

.wishlist-link i {
    font-size: 1.2rem;
}

/* Cart icon styling improvements */
.donation a {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    transition: all 0.3s ease;
}

.donation svg {
    width: 24px;
    height: 24px;
    fill: currentColor;
}

/* Hide cart count when it's 0 */
.cart-count[data-count="0"],
.wishlist-count[data-count="0"] {
    display: none !important;
}

/* Active state animations */
.cart-count.updated,
.wishlist-count.updated {
    animation: bounceIn 0.6s ease;
}

@keyframes bounceIn {
    0% {
        transform: scale(0.3);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
        opacity: 1;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Header Icons Container */
.header-icons {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-right: 15px;
}

.header-icons .icon-link {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background: rgba(250, 68, 29, 0.05);
    border-radius: 50%;
    color: #333;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.header-icons .icon-link:hover {
    background: rgba(250, 68, 29, 0.1);
    border-color: #FA441D;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.25);
    text-decoration: none;
}

.header-icons .icon-link i {
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.header-icons .icon-link:hover i {
    color: #FA441D;
    transform: scale(1.15);
}

/* Wishlist specific hover */
.wishlist-icon .icon-link:hover {
    background: rgba(231, 76, 60, 0.1);
    border-color: #e74c3c;
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.25);
}

.wishlist-icon .icon-link:hover i {
    color: #e74c3c;
}

/* Icon count styling */
.icon-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background: linear-gradient(135deg, #FA441D, #FF6B35);
    color: white;
    font-size: 11px;
    font-weight: 700;
    min-width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    border: 2px solid white;
    box-shadow: 0 4px 15px rgba(250, 68, 29, 0.4);
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    z-index: 10;
    transition: all 0.3s ease;
    animation: pulse 2s infinite;
}

.wishlist-count.icon-count {
    background: linear-gradient(135deg, #e74c3c, #e67e22);
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);
}

/* Pulse animation for counts */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* Hide counts when 0 */
.icon-count[data-count="0"] {
    display: none !important;
}

/* Show counts when they have values */
.icon-count:not([data-count="0"]) {
    display: flex !important;
}

/* Better menu-end layout */
.menu-end {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .header-icons {
        gap: 10px;
        margin-right: 10px;
    }
    
    .header-icons .icon-link {
        width: 40px;
        height: 40px;
    }
    
    .header-icons .icon-link i {
        font-size: 1rem;
    }
    
    .icon-count {
        min-width: 20px;
        height: 20px;
        font-size: 10px;
        top: -3px;
        right: -3px;
    }
}
</style>

</body>
</html>
