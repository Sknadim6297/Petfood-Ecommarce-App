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
    @stack('styles')
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
            <form method="post" action="{{ route('universal.search') }}">
                @csrf
                <div class="form-group">
                    <input type="search" name="search" placeholder="Search products and cooked foods..." required="">
                    <button type="submit"><span class="fa fa-search"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- search-popup end -->

<!-- Login Required Popup -->
<div id="loginRequiredModal" class="login-required-modal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="login-required-content">
        <button class="close-login-modal" onclick="closeLoginModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="login-modal-header">
            <div class="modal-icon">
                <i class="fas fa-paw"></i>
            </div>
            <h3>Login Required</h3>
            <p class="modal-subtitle">You need to be logged in to add items to wishlist.</p>
        </div>
        
        <div class="login-modal-body">
            <div class="pet-illustration">
                <div class="pet-graphic">
                    <i class="fas fa-heart"></i>
                    <i class="fas fa-dog"></i>
                    <i class="fas fa-cat"></i>
                </div>
            </div>
            
            <div class="join-message">
                <h4>Join our pet-loving community!</h4>
                <p>Create an account to save your favorite products, track orders, and get exclusive deals for your furry friends.</p>
            </div>
            
            <div class="benefits-list">
                <div class="benefit-item">
                    <i class="fas fa-heart text-danger"></i>
                    <span>Save favorite products to your wishlist</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-shipping-fast text-primary"></i>
                    <span>Track your orders in real-time</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-gift text-success"></i>
                    <span>Get exclusive discounts and offers</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-star text-warning"></i>
                    <span>Write reviews and share experiences</span>
                </div>
            </div>
        </div>
        
        <div class="login-modal-footer">
            <a href="{{ route('login') }}" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                Login to Your Account
            </a>
            <p class="signup-text">
                Don't have an account? 
                <a href="{{ route('register') }}" class="signup-link">Sign Up Free</a>
            </p>
        </div>
        
        <div class="modal-decoration">
            <div class="paw-print paw-1">🐾</div>
            <div class="paw-print paw-2">🐾</div>
            <div class="paw-print paw-3">🐾</div>
        </div>
    </div>
</div>
<!-- Login Required Popup End -->

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

<!-- Page-specific scripts (loaded after jQuery) -->
@stack('scripts')

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

/* ========================================
   LOGIN REQUIRED MODAL STYLES
======================================== */
.login-required-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.login-required-modal.show {
    opacity: 1;
    visibility: visible;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    animation: fadeIn 0.3s ease;
}

.login-required-content {
    position: relative;
    background: white;
    border-radius: 20px;
    padding: 0;
    max-width: 480px;
    width: 90%;
    max-height: 90vh;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    transform: scale(0.8) translateY(30px);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    background: linear-gradient(135deg, #ffffff 0%, #fff8f0 100%);
    border: 3px solid #FA441D;
}

.login-required-modal.show .login-required-content {
    transform: scale(1) translateY(0);
}

.close-login-modal {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.close-login-modal:hover {
    background: #FA441D;
    color: white;
    transform: rotate(90deg) scale(1.1);
}

.login-modal-header {
    text-align: center;
    padding: 40px 30px 20px;
    background: linear-gradient(135deg, #FA441D, #FF6B35);
    color: white;
    position: relative;
    overflow: hidden;
}

.login-modal-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="pawPattern" patternUnits="userSpaceOnUse" width="20" height="20"><path d="M10 5c-1.5 0-3 1.5-3 3s1.5 3 3 3 3-1.5 3-3-1.5-3-3-3zm-4 8c-1 0-2 1-2 2s1 2 2 2 2-1 2-2-1-2-2-2zm8 0c-1 0-2 1-2 2s1 2 2 2 2-1 2-2-1-2-2-2z" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23pawPattern)"/></svg>') repeat;
    animation: float 20s linear infinite;
    opacity: 0.1;
}

@keyframes float {
    0% { transform: translateX(-50px) translateY(-50px); }
    100% { transform: translateX(50px) translateY(50px); }
}

.modal-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 36px;
    color: white;
    animation: bounce 2s infinite;
    backdrop-filter: blur(10px);
    border: 3px solid rgba(255, 255, 255, 0.3);
}

@keyframes bounce {
    0%, 20%, 53%, 80%, 100% {
        transform: translate3d(0, 0, 0);
    }
    40%, 43% {
        transform: translate3d(0, -15px, 0);
    }
    70% {
        transform: translate3d(0, -8px, 0);
    }
    90% {
        transform: translate3d(0, -3px, 0);
    }
}

.login-modal-header h3 {
    font-family: 'DynaPuff', cursive;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.modal-subtitle {
    font-size: 16px;
    opacity: 0.9;
    margin: 0;
    font-weight: 400;
}

.login-modal-body {
    padding: 30px;
    text-align: center;
}

.pet-illustration {
    margin-bottom: 25px;
    position: relative;
}

.pet-graphic {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    font-size: 48px;
    margin-bottom: 20px;
    animation: petFloat 3s ease-in-out infinite;
}

@keyframes petFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.pet-graphic i:nth-child(1) {
    color: #e74c3c;
    animation: heartbeat 1.5s ease-in-out infinite;
}

.pet-graphic i:nth-child(2) {
    color: #3498db;
    animation-delay: 0.5s;
}

.pet-graphic i:nth-child(3) {
    color: #f39c12;
    animation-delay: 1s;
}

@keyframes heartbeat {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

.join-message h4 {
    font-family: 'DynaPuff', cursive;
    color: #2c3e50;
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 15px;
}

.join-message p {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 25px;
    font-size: 15px;
}

.benefits-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
    text-align: left;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px 15px;
    background: rgba(250, 68, 29, 0.05);
    border-radius: 12px;
    border-left: 4px solid #FA441D;
    transition: all 0.3s ease;
    animation: slideIn 0.6s ease forwards;
}

.benefit-item:nth-child(1) { animation-delay: 0.1s; }
.benefit-item:nth-child(2) { animation-delay: 0.2s; }
.benefit-item:nth-child(3) { animation-delay: 0.3s; }
.benefit-item:nth-child(4) { animation-delay: 0.4s; }

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.benefit-item:hover {
    background: rgba(250, 68, 29, 0.1);
    transform: translateX(5px);
}

.benefit-item i {
    font-size: 18px;
    min-width: 20px;
}

.benefit-item span {
    color: #2c3e50;
    font-weight: 500;
    font-size: 14px;
}

.login-modal-footer {
    padding: 0 30px 30px;
    text-align: center;
}

.btn-login {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(135deg, #FA441D, #FF6B35);
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
    position: relative;
    overflow: hidden;
    font-family: 'DynaPuff', cursive;
}

.btn-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-login:hover::before {
    left: 100%;
}

.btn-login:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 15px 35px rgba(250, 68, 29, 0.4);
    text-decoration: none;
    color: white;
}

.btn-login:active {
    transform: translateY(-1px) scale(1.02);
}

.signup-text {
    margin-top: 20px;
    color: #6c757d;
    font-size: 14px;
}

.signup-link {
    color: #FA441D;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.signup-link:hover {
    color: #e8381a;
    text-decoration: underline;
}

.modal-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    overflow: hidden;
}

.paw-print {
    position: absolute;
    font-size: 24px;
    opacity: 0.1;
    animation: floatPaw 8s ease-in-out infinite;
}

.paw-1 {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.paw-2 {
    top: 60%;
    right: 10%;
    animation-delay: 2s;
}

.paw-3 {
    bottom: 20%;
    left: 15%;
    animation-delay: 4s;
}

@keyframes floatPaw {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.1;
    }
    25% {
        transform: translateY(-20px) rotate(90deg);
        opacity: 0.2;
    }
    50% {
        transform: translateY(-10px) rotate(180deg);
        opacity: 0.15;
    }
    75% {
        transform: translateY(-15px) rotate(270deg);
        opacity: 0.2;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .login-required-content {
        width: 95%;
        margin: 20px;
        border-radius: 15px;
    }
    
    .login-modal-header {
        padding: 30px 20px 15px;
    }
    
    .modal-icon {
        width: 60px;
        height: 60px;
        font-size: 28px;
        margin-bottom: 15px;
    }
    
    .login-modal-header h3 {
        font-size: 24px;
    }
    
    .login-modal-body {
        padding: 20px;
    }
    
    .pet-graphic {
        font-size: 36px;
        gap: 15px;
    }
    
    .join-message h4 {
        font-size: 20px;
    }
    
    .benefits-list {
        gap: 12px;
    }
    
    .benefit-item {
        padding: 10px 12px;
    }
    
    .benefit-item span {
        font-size: 13px;
    }
    
    .btn-login {
        padding: 12px 25px;
        font-size: 14px;
    }
    
    .login-modal-footer {
        padding: 0 20px 25px;
    }
}

/* Animation for modal entrance */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Prevent body scroll when modal is open */
body.modal-open {
    overflow: hidden;
}
</style>

</body>
</html>
