<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $websiteSettings = \App\Models\WebsiteSetting::getSettings();
    @endphp
    <title>@yield('title', ($websiteSettings['company_name'] ?? 'PetNet') . ' - ' . ($websiteSettings['tagline'] ?? 'Pet Food Ecommerce'))</title>
    
    <!-- Favicon -->
    @if(!empty($websiteSettings['favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $websiteSettings['favicon']) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <!-- Font Awesome CDN as backup -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom Dynamic Logo Styles -->
    <style>
        /* Poppins Font Override for All Frontend Elements - Excluding Icons */
        body, p, span:not([class*="fa-"]):not([class*="icon"]), div:not([class*="fa-"]):not([class*="icon"]), 
        section, article, aside, nav, header, footer,
        h1, h2, h3, h4, h5, h6,
        a:not([class*="fa-"]):not([class*="icon"]), button, input, textarea, select, option,
        table, td, th, tr, thead, tbody,
        ul, ol, li:not([class*="fa-"]):not([class*="icon"]), dl, dt, dd,
        form, fieldset, legend, label,
        blockquote, cite, q, code, pre, kbd, samp, var,
        small, big, sub, sup, strong, em, b:not([class*="fa-"]):not([class*="icon"]), 
        i:not([class*="fa-"]):not([class*="icon"]), u, s,
        .btn, .form-control, .nav-link, .dropdown-item,
        .card, .card-title, .card-text, .card-header, .card-footer,
        .modal, .modal-title, .modal-body, .modal-footer,
        .alert, .badge, .breadcrumb, .pagination,
        .navbar, .navbar-brand, .nav-item, .nav-text,
        .carousel, .carousel-caption, .carousel-item,
        .accordion, .collapse, .offcanvas,
        .toast, .tooltip, .popover,
        .list-group, .list-group-item,
        .progress, .spinner-border,
        .tab-content, .tab-pane, .nav-tabs, .nav-pills,
        .sidebar, .main-content, .container, .row, .col,
        .hero-section, .section-title, .widget-title,
        .footer, .header, .navigation, .menu,
        .product-card, .product-title, .product-price,
        .blog-post, .blog-title, .blog-content,
        .testimonial, .client-review, .rating,
        .contact-form, .form-group, .form-label,
        .slider, .carousel-control, .owl-carousel,
        .price-tag, .discount-badge, .sale-badge,
        .social-icons, .social-link,
        .search-form, .search-input, .search-btn,
        .category-card, .category-title,
        .product-grid, .product-list,
        .checkout-form, .payment-form,
        .user-profile, .account-info,
        .order-summary, .cart-item,
        .shipping-info, .billing-info,
        .newsletter, .subscription-form,
        .team-member, .team-info,
        .service-card, .service-title,
        .faq-item, .faq-question, .faq-answer,
        .gallery-item, .gallery-caption,
        .video-player, .video-caption,
        .map-container, .location-info,
        .counter, .statistic, .achievement,
        .feature-box, .feature-title,
        .call-to-action, .cta-text,
        .error-message, .success-message,
        .loading-text, .placeholder-text {
            font-family: 'Poppins', sans-serif !important;
        }
        
        /* Ensure Font Awesome icons work properly */
        i[class*="fa-"], 
        i[class*="fab"], 
        i[class*="fas"], 
        i[class*="far"], 
        i[class*="fal"], 
        i[class*="fad"],
        .fa, .fab, .fad, .fal, .far, .fas,
        [class^="fa-"], [class*=" fa-"],
        [class^="fab"], [class*=" fab"],
        [class^="fad"], [class*=" fad"],
        [class^="fal"], [class*=" fal"],
        [class^="far"], [class*=" far"],
        [class^="fas"], [class*=" fas"] {
            font-family: "Font Awesome 6 Free", "Font Awesome 6 Pro", "Font Awesome 6 Brands", "FontAwesome", "Font Awesome 5 Free", "Font Awesome 5 Pro" !important;
            font-weight: 900 !important;
            font-style: normal !important;
            font-variant: normal !important;
            text-transform: none !important;
            line-height: 1 !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
        
        /* Brand icons have different weight */
        .fab, [class^="fab"], [class*=" fab"] {
            font-weight: 400 !important;
        }
        
        /* Main Logo Styles */
        .main-logo {
       max-height: 76px;
        width: 103px;
            transition: all 0.3s ease;
        }
        
        /* Footer Logo Styles */
        .footer-logo {
           max-height: 142px;
            width: auto;
            transition: all 0.3s ease;
        }
        
        /* Mobile Logo Styles */
        .mobile-logo {
            max-height: 60px;
            width: auto;
            transition: all 0.3s ease;
            object-fit: contain;
        }
        
        /* Mobile Navigation Logo Container */
        .res-log {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .res-log .mobile-logo {
            max-height: 80px;
            max-width: 200px;
            width: auto;
            height: auto;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-logo {
                max-height: 45px;
            }
            
            .footer-logo {
                max-height: 60px;
            }
            
            .mobile-logo {
                max-height: 50px;
            }
            
            .res-log .mobile-logo {
                max-height: 123px;
            }
        }
        
        @media (max-width: 480px) {
            .main-logo {
                max-height: 40px;
            }
            
            .footer-logo {
                max-height: 100px;
            }
            
            .mobile-logo {
                max-height: 45px;
            }
            
            .res-log {
                padding: 15px;
            }
        }
        
        /* User Profile Dropdown Styling */
        .login .dropdown {
            position: relative;
        }
        
        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #fa441d, #ff6b47);
            color: white !important;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(250, 68, 29, 0.3);
            white-space: nowrap;
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .dropdown-toggle:hover {
            background: linear-gradient(135deg, #e8381a, #fa441d);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(250, 68, 29, 0.4);
            color: white !important;
        }
        
        .dropdown-toggle i {
            font-size: 16px;
            flex-shrink: 0;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            min-width: 200px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            padding: 8px 0;
            margin-top: 8px;
        }
        
        .dropdown.show .dropdown-menu,
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 20px;
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid white;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #374151 !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, #fa441d, #ff6b47);
            color: white !important;
        }
        
        .dropdown-item i {
            font-size: 16px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        
        /* Mobile User Dropdown */
        #mobileUserDropdown .dropdown-toggle {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white !important;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        #mobileUserDropdown .dropdown-menu {
            position: static;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            margin-top: 0;
            margin-bottom: 20px;
        }
        
        #mobileUserDropdown .dropdown-menu::before {
            display: none;
        }
        
        #mobileUserDropdown .dropdown-item {
            color: white !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        #mobileUserDropdown .dropdown-item:last-child {
            border-bottom: none;
        }
        
        #mobileUserDropdown .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
    
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

<!-- cart-sidebar -->
<div id="cartSidebar" class="cart-sidebar">
    <div class="cart-overlay"></div>
    <div class="cart-sidebar-content">
        <!-- Cart Header -->
        <div class="cart-sidebar-header">
            <div class="cart-header-info">
                <div class="cart-header-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="cart-header-details">
                    <h3>Shopping Cart</h3>
                    <span class="cart-items-count">0 items</span>
                </div>
            </div>
            <button class="cart-close-btn" onclick="closeCartSidebar()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Cart Body -->
        <div class="cart-sidebar-body">
            <div id="cart-items-container">
                <!-- Cart items will be loaded here via AJAX -->
                <div class="empty-cart-state">
                    <div class="empty-cart-illustration">
                        <div class="cart-icon-large">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="floating-hearts">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <h4>Your cart is empty</h4>
                    <p>Discover amazing products for your beloved pets!</p>
                    <a href="{{ route('products.index') }}" class="btn-continue-shopping">
                        <i class="fas fa-paw"></i>
                        Start Shopping
                    </a>
                </div>
            </div>
        </div>

        <!-- Cart Footer -->
        <div class="cart-sidebar-footer">
            <!-- Subtotal Section -->
            <div class="cart-subtotal">
                <div class="subtotal-row">
                    <span>Subtotal</span>
                    <span class="subtotal-amount">₹0.00</span>
                </div>
                <div class="tax-info">
                    <small>Shipping and taxes calculated at checkout</small>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="cart-actions">
                <a href="{{ route('cart.index') }}" class="btn-view-cart">
                    <i class="fas fa-shopping-cart"></i>
                    View Full Cart
                </a>
                <a href="{{ route('checkout.index') }}" class="btn-checkout">
                    <i class="fas fa-lock"></i>
                    Secure Checkout
                </a>
            </div>

            <!-- Security Badge -->
            <div class="security-badge">
                <i class="fas fa-shield-alt"></i>
                <span>Secure & Safe Payment</span>
            </div>
        </div>
    </div>
</div>

<style>
/* ========================================
   E-COMMERCE CART SIDEBAR STYLES
======================================== */
.cart-sidebar {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 99999;
    pointer-events: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.cart-sidebar.open {
    pointer-events: all;
}

.cart-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(4px);
}

.cart-sidebar.open .cart-overlay {
    opacity: 1;
}

.cart-sidebar-content {
    position: absolute;
    top: 0;
    right: 0;
    width: 420px;
    height: 100%;
    background: white;
    box-shadow: -10px 0 30px rgba(0, 0, 0, 0.2);
    transform: translateX(100%);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.cart-sidebar.open .cart-sidebar-content {
    transform: translateX(0);
}

/* Cart Header */
.cart-sidebar-header {
    background: linear-gradient(135deg, #FA441D 0%, #FF6B35 100%);
    color: white;
    padding: 25px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 10px rgba(250, 68, 29, 0.2);
    position: relative;
    overflow: hidden;
}

.cart-sidebar-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="cartPattern" patternUnits="userSpaceOnUse" width="30" height="30"><circle cx="15" cy="15" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23cartPattern)"/></svg>') repeat;
    animation: patternMove 20s linear infinite;
    opacity: 0.3;
}

@keyframes patternMove {
    0% { transform: translateX(-30px) translateY(-30px); }
    100% { transform: translateX(30px) translateY(30px); }
}

.cart-header-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.cart-header-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    position: relative;
}

.cart-header-icon::after {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, rgba(255,255,255,0.3), transparent, rgba(255,255,255,0.3));
    border-radius: 12px;
    z-index: -1;
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { opacity: 0; }
    50% { opacity: 1; }
}

.cart-header-details h3 {
    margin: 0 0 5px 0;
    font-size: 20px;
    font-weight: 700;
    font-family: 'Poppins', sans-serif;
}

.cart-items-count {
    font-size: 13px;
    opacity: 0.9;
    background: rgba(255, 255, 255, 0.2);
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 500;
}

.cart-close-btn {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.cart-close-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg) scale(1.1);
}

/* Cart Body */
.cart-sidebar-body {
    flex: 1;
    overflow-y: auto;
    padding: 0;
    background: #fafbfc;
}

.cart-sidebar-body::-webkit-scrollbar {
    width: 6px;
}

.cart-sidebar-body::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.cart-sidebar-body::-webkit-scrollbar-thumb {
    background: #FA441D;
    border-radius: 10px;
}

.cart-sidebar-body::-webkit-scrollbar-thumb:hover {
    background: #e63a1a;
}

/* Empty Cart State */
.empty-cart-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 30px;
    text-align: center;
    height: 100%;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
}

.empty-cart-illustration {
    position: relative;
    margin-bottom: 30px;
}

.cart-icon-large {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, rgba(250, 68, 29, 0.1) 0%, rgba(255, 107, 53, 0.1) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 50px;
    color: #FA441D;
    margin: 0 auto;
    position: relative;
    animation: cartBounce 3s ease-in-out infinite;
    border: 3px solid rgba(250, 68, 29, 0.2);
}

@keyframes cartBounce {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.floating-hearts {
    position: absolute;
    top: -10px;
    right: -10px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.floating-hearts i {
    color: #e74c3c;
    font-size: 12px;
    animation: floatHeart 2s ease-in-out infinite;
}

.floating-hearts i:nth-child(1) { animation-delay: 0s; }
.floating-hearts i:nth-child(2) { animation-delay: 0.5s; }
.floating-hearts i:nth-child(3) { animation-delay: 1s; }

@keyframes floatHeart {
    0%, 100% {
        transform: translateY(0px) scale(1);
        opacity: 0.7;
    }
    50% {
        transform: translateY(-8px) scale(1.2);
        opacity: 1;
    }
}

.empty-cart-state h4 {
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 10px 0;
    font-family: 'Poppins', sans-serif;
}

.empty-cart-state p {
    font-size: 16px;
    color: #6c757d;
    margin: 0 0 30px 0;
    line-height: 1.5;
}

.btn-continue-shopping {
    background: linear-gradient(135deg, #FA441D 0%, #FF6B35 100%);
    color: white;
    padding: 15px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-continue-shopping::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-continue-shopping:hover::before {
    left: 100%;
}

.btn-continue-shopping:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 15px 35px rgba(250, 68, 29, 0.4);
    text-decoration: none;
    color: white;
}

/* Cart Items Container */
#cart-items-container {
    min-height: 100%;
}

/* Cart Item Styling */
.cart-item {
    display: flex;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #f0f2f5;
    background: white;
    transition: all 0.3s ease;
    position: relative;
}

.cart-item:hover {
    background: #f8f9fa;
    transform: translateX(-5px);
    box-shadow: 5px 0 15px rgba(250, 68, 29, 0.1);
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item-image {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    overflow: hidden;
    margin-right: 15px;
    flex-shrink: 0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.cart-item:hover .cart-item-image img {
    transform: scale(1.05);
}

.cart-item-details {
    flex: 1;
    min-width: 0;
}

.cart-item-name {
    font-weight: 600;
    font-size: 16px;
    color: #2c3e50;
    margin: 0 0 8px 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    line-height: 1.3;
}

.cart-item-meta {
    font-size: 13px;
    color: #6c757d;
    margin: 0 0 10px 0;
}

.cart-item-quantity {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 8px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e9ecef;
}

.quantity-btn {
    background: none;
    border: none;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
    color: #6c757d;
}

.quantity-btn:hover {
    background: #FA441D;
    color: white;
}

.quantity-input {
    width: 45px;
    height: 32px;
    border: none;
    background: white;
    text-align: center;
    font-weight: 600;
    font-size: 14px;
    color: #2c3e50;
}

.cart-item-price {
    font-weight: 700;
    color: #FA441D;
    font-size: 16px;
    text-align: right;
    margin-left: 15px;
    flex-shrink: 0;
}

.remove-item-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(231, 76, 60, 0.1);
    border: none;
    color: #e74c3c;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 12px;
    opacity: 0;
}

.cart-item:hover .remove-item-btn {
    opacity: 1;
}

.remove-item-btn:hover {
    background: #e74c3c;
    color: white;
    transform: scale(1.1);
}

/* Cart Footer */
.cart-sidebar-footer {
    background: white;
    border-top: 1px solid #f0f2f5;
    padding: 25px 20px;
    box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.1);
}

.cart-subtotal {
    margin-bottom: 20px;
}

.subtotal-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.subtotal-row span:first-child {
    font-size: 16px;
    color: #2c3e50;
    font-weight: 500;
}

.subtotal-amount {
    font-size: 22px;
    font-weight: 700;
    color: #FA441D;
}

.tax-info {
    text-align: center;
}

.tax-info small {
    color: #6c757d;
    font-size: 12px;
}

.cart-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.btn-view-cart,
.btn-checkout {
    padding: 15px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    text-align: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
}

.btn-view-cart {
    background: white;
    color: #FA441D;
    border: 2px solid #FA441D;
}

.btn-view-cart::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: #FA441D;
    transition: left 0.3s ease;
    z-index: -1;
}

.btn-view-cart:hover::before {
    left: 0;
}

.btn-view-cart:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
    text-decoration: none;
}

.btn-checkout {
    background: linear-gradient(135deg, #FA441D 0%, #FF6B35 100%);
    color: white;
    border: 2px solid transparent;
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
}

.btn-checkout::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-checkout:hover::before {
    left: 100%;
}

.btn-checkout:hover {
    background: linear-gradient(135deg, #e63a1a 0%, #ff5722 100%);
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 15px 35px rgba(250, 68, 29, 0.4);
    color: white;
    text-decoration: none;
}

.security-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: #28a745;
    font-size: 13px;
    font-weight: 500;
    background: rgba(40, 167, 69, 0.1);
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.security-badge i {
    font-size: 14px;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .cart-sidebar-content {
        width: 100%;
        max-width: 400px;
    }
    
    .cart-sidebar-header {
        padding: 20px 15px;
    }
    
    .cart-header-icon {
        width: 45px;
        height: 45px;
        font-size: 20px;
    }
    
    .cart-header-details h3 {
        font-size: 18px;
    }
    
    .cart-item {
        padding: 15px;
    }
    
    .cart-item-image {
        width: 70px;
        height: 70px;
    }
    
    .cart-item-name {
        font-size: 15px;
    }
    
    .cart-sidebar-footer {
        padding: 20px 15px;
    }
    
    .subtotal-amount {
        font-size: 20px;
    }
    
    .btn-view-cart,
    .btn-checkout {
        padding: 14px 18px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .cart-sidebar-content {
        width: 100%;
    }
    
    .empty-cart-state {
        padding: 40px 20px;
    }
    
    .cart-icon-large {
        width: 100px;
        height: 100px;
        font-size: 40px;
    }
    
    .empty-cart-state h4 {
        font-size: 20px;
    }
    
    .empty-cart-state p {
        font-size: 14px;
    }
    
    .btn-continue-shopping {
        padding: 12px 25px;
        font-size: 14px;
    }
}

/* Ensure cart sidebar appears above other elements */
.cart-sidebar {
    z-index: 99999;
}

/* Body scroll lock when sidebar is open */
body.cart-sidebar-open {
    overflow: hidden;
}
</style>
<!-- cart-sidebar end -->

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

<!-- Cart and E-commerce Functionality -->
<script>
$(document).ready(function() {
    // Update counts on page load
    if (window.cartWishlistManager) {
        window.cartWishlistManager.updateCounts();
        window.cartWishlistManager.updateWishlistIcons();
    }
    
    // Authentication protection for cart and wishlist
    $('.cart-auth-required').off('click').on('click', function(e) {
        e.preventDefault();
        showLoginRequiredModal('cart');
    });
    
    $('.wishlist-auth-required').off('click').on('click', function(e) {
        e.preventDefault();
        showLoginRequiredModal('wishlist');
    });
    
    // Cart sidebar toggle for authenticated users
    $('#show').off('click').on('click', function(e) {
        e.preventDefault();
        @auth
            updateCartSidebar();
            openCartSidebar();
        @else
            showLoginRequiredModal('cart');
        @endauth
    });
    
    // Handle add to cart buttons for unauthenticated users
    $(document).on('click', '.add-to-cart-btn', function(e) {
        @guest
            e.preventDefault();
            e.stopPropagation();
            showLoginRequiredModal('cart');
            return false;
        @endguest
    });
    
    // Handle wishlist toggle buttons for unauthenticated users
    $(document).on('click', '.wishlist-toggle-btn', function(e) {
        @guest
            e.preventDefault();
            e.stopPropagation();
            showLoginRequiredModal('wishlist');
            return false;
        @endguest
    });
    
    // Remove from cart
    $(document).on('click', '.remove-cart-item', function(e) {
        e.preventDefault();
        
        // Get item details from data attributes
        const itemId = $(this).data('item-id') || $(this).data('product-id');
        const itemType = $(this).data('item-type') || 'product';
        
        // Fallback for older format
        const productId = $(this).data('product-id');
        
        // Prepare data object
        let requestData = {
            _token: '{{ csrf_token() }}'
        };
        
        // Set the appropriate field based on available data
        if (itemId && itemType) {
            requestData.item_id = itemId;
            requestData.item_type = itemType;
        } else if (productId) {
            requestData.product_id = productId;
        } else {
            showToast('Error: Could not identify item to remove', 'error');
            return;
        }
        
        $.ajax({
            url: '{{ route("cart.remove") }}',
            method: 'DELETE',
            data: requestData,
            success: function(response) {
                if (response.success) {
                    updateCartSidebar();
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
    
    // Update cart item quantity
    $(document).on('click', '.quantity-btn', function(e) {
        e.preventDefault();
        
        const isIncrease = $(this).hasClass('increase');
        const input = $(this).siblings('.quantity-input');
        const currentQty = parseInt(input.val()) || 1;
        
        // Get item ID and type from button or closest cart item
        const itemId = $(this).data('item-id') || $(this).closest('.cart-item').data('item-id') || $(this).data('product-id') || $(this).closest('.cart-item').data('product-id');
        const itemType = $(this).data('item-type') || $(this).closest('.cart-item').data('item-type') || 'product';
        
        let newQty = isIncrease ? currentQty + 1 : Math.max(1, currentQty - 1);
        
        updateCartQuantity(itemId, newQty, itemType);
    });
    
    $(document).on('change', '.quantity-input', function() {
        // Get item ID and type from input or closest cart item
        const itemId = $(this).data('item-id') || $(this).closest('.cart-item').data('item-id') || $(this).data('product-id') || $(this).closest('.cart-item').data('product-id');
        const itemType = $(this).data('item-type') || $(this).closest('.cart-item').data('item-type') || 'product';
        const newQty = Math.max(1, parseInt($(this).val()) || 1);
        updateCartQuantity(itemId, newQty, itemType);
    });
    
    function updateCartQuantity(itemId, quantity, itemType = 'product') {
        const data = {
            quantity: quantity,
            _token: '{{ csrf_token() }}'
        };
        
        // Use appropriate parameter based on item type
        if (itemType === 'product') {
            data.product_id = itemId;
        } else {
            data.item_id = itemId;
            data.item_type = itemType;
        }
        
        $.ajax({
            url: '{{ route("cart.update") }}',
            method: 'PUT',
            data: data,
            success: function(response) {
                if (response.success) {
                    // Update the cart sidebar
                    updateCartSidebar();
                    
                    // Update cart count
                    if (window.cartWishlistManager) {
                        window.cartWishlistManager.updateCartCount();
                    }
                    
                    // Update quantity input value using both selectors
                    const input = $(`.quantity-input[data-item-id="${itemId}"][data-item-type="${itemType}"], .quantity-input[data-product-id="${itemId}"]`);
                    if (input.length) {
                        input.val(quantity);
                    }
                    
                    // Update product price if available
                    if (response.current_price) {
                        $(`.cart-item[data-item-id="${itemId}"][data-item-type="${itemType}"] .item-price, .cart-item[data-product-id="${itemId}"] .item-price`).text('₹' + parseFloat(response.current_price).toFixed(2));
                    }
                    
                    // Update subtotal if available
                    if (response.new_subtotal) {
                        $(`.cart-item[data-item-id="${itemId}"][data-item-type="${itemType}"] .item-subtotal, .cart-item[data-product-id="${itemId}"] .item-subtotal`).text('₹' + parseFloat(response.new_subtotal).toFixed(2));
                    }
                    
                    // Update cart total
                    if (response.cart_total) {
                        $('.cart-subtotal-amount, #cart-subtotal').text(parseFloat(response.cart_total).toFixed(2));
                    }
                    
                    showToast('Cart updated successfully', 'success');
                }
            },
            error: function() {
                showToast('Error updating cart', 'error');
                updateCartSidebar(); 
            }
        });
    }
    
    function showLoginRequiredModal(type = 'general') {
        // Remove ALL existing login modals first to prevent duplicates
        $('#authRequiredModal, #loginRequiredModal, .login-required-modal, .login-prompt-modal').remove();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        
        const messages = {
            cart: {
                title: 'Login Required for Cart',
                subtitle: 'You need to be logged in to access your shopping cart.',
                icon: 'fas fa-shopping-cart'
            },
            wishlist: {
                title: 'Login Required for Wishlist',
                subtitle: 'You need to be logged in to save items to your wishlist.',
                icon: 'fas fa-heart'
            },
            general: {
                title: 'Login Required',
                subtitle: 'You need to be logged in to access this feature.',
                icon: 'fas fa-paw'
            }
        };
        
        const message = messages[type] || messages.general;
        
        // Remove existing modal if any
        $('#authRequiredModal').remove();
        
        // Create and show authentication required modal
        const modal = `
            <div id="authRequiredModal" class="auth-required-modal">
                <div class="modal-overlay" onclick="closeAuthModal()"></div>
                <div class="auth-required-content">
                    <button class="close-auth-modal" onclick="closeAuthModal()">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <div class="auth-modal-header">
                        <div class="auth-modal-icon">
                            <i class="${message.icon}"></i>
                        </div>
                        <h3>${message.title}</h3>
                        <p class="auth-modal-subtitle">${message.subtitle}</p>
                    </div>
                    
                    <div class="auth-modal-body">
                        <div class="benefits-showcase">
                            <div class="benefit-item">
                                <i class="fas fa-shopping-bag text-primary"></i>
                                <span>Save items to cart</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-heart text-danger"></i>
                                <span>Create wishlist</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-shipping-fast text-success"></i>
                                <span>Track your orders</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-gift text-warning"></i>
                                <span>Get exclusive deals</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="auth-modal-actions">
                        <a href="{{ route('login') }}" class="btn-auth-login">
                            <i class="fas fa-sign-in-alt"></i>
                            Login Now
                        </a>
                        <a href="{{ route('register') }}" class="btn-auth-register">
                            <i class="fas fa-user-plus"></i>
                            Create Account
                        </a>
                    </div>
                </div>
            </div>
        `;
        $('body').append(modal);
        $('body').addClass('modal-open');
        $('#authRequiredModal').fadeIn(300);
    }
    
    window.closeAuthModal = function() {
        $('#authRequiredModal').fadeOut(300, function() {
            $(this).remove();
            $('body').removeClass('modal-open');
        });
    };
    
    // Cart Sidebar Functions
    window.openCartSidebar = function() {
        $('#cartSidebar').addClass('open');
        $('body').addClass('cart-sidebar-open');
    };
    
    window.closeCartSidebar = function() {
        $('#cartSidebar').removeClass('open');
        $('body').removeClass('cart-sidebar-open');
    };
    
    // Close cart sidebar when clicking overlay
    $(document).on('click', '.cart-overlay', function() {
        closeCartSidebar();
    });
    
    // Close cart sidebar with Escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $('#cartSidebar').hasClass('open')) {
            closeCartSidebar();
        }
    });
    
    function updateCartSidebar() {
        $.get('{{ route("cart.popup") }}', function(response) {
            if (response.html && response.html.trim() !== '') {
                // Convert cart items to sidebar format
                const cartItemsHtml = convertCartItemsToSidebarFormat(response.html);
                $('#cart-items-container').html(cartItemsHtml);
            } else {
                $('#cart-items-container').html(`
                    <div class="empty-cart-state">
                        <div class="empty-cart-illustration">
                            <div class="cart-icon-large">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="floating-hearts">
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <h4>Your cart is empty</h4>
                        <p>Discover amazing products for your beloved pets!</p>
                        <a href="{{ route('products.index') }}" class="btn-continue-shopping">
                            <i class="fas fa-paw"></i>
                            Start Shopping
                        </a>
                    </div>
                `);
            }
            
            // Update totals and counts
            $('.subtotal-amount').text('₹' + (response.total || 0).toFixed(2));
            const itemCount = response.count || 0;
            $('.cart-items-count').text(itemCount + (itemCount === 1 ? ' item' : ' items'));
            
        }).fail(function() {
            console.error('Failed to update cart sidebar');
        });
    }
    
    // Function to immediately clear cart sidebar (for after successful order)
    window.clearCartSidebar = function() {
        // Immediately show empty state
        $('#cart-items-container').html(`
            <div class="empty-cart-state">
                <div class="empty-cart-illustration">
                    <div class="cart-icon-large">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="floating-hearts">
                        <i class="fas fa-heart"></i>
                        <i class="fas fa-heart"></i>
                        <i class="fas fa-heart"></i>
                    </div>
                </div>
                <h4>Your cart is empty</h4>
                <p>Your order has been placed successfully!</p>
                <a href="{{ route('products.index') }}" class="btn-continue-shopping">
                    <i class="fas fa-paw"></i>
                    Continue Shopping
                </a>
            </div>
        `);
        
        // Update totals and counts immediately
        $('.subtotal-amount').text('₹0.00');
        $('.cart-items-count').text('0 items');
        
        // Update cart count in header if cartWishlistManager exists
        if (window.cartWishlistManager) {
            window.cartWishlistManager.updateCartCount();
        }
        
        // Force refresh from server to ensure data consistency
        setTimeout(() => {
            updateCartSidebar();
        }, 500);
    };
    
    function convertCartItemsToSidebarFormat(html) {
        // Create a temporary container to parse the HTML
        const $temp = $('<div>').html(html);
        let sidebarHtml = '';
        let hasItems = false;
        
        $temp.find('li').each(function() {
            const $item = $(this);
            
            // Skip empty cart message
            if ($item.hasClass('empty-cart-message') || $item.text().includes('Your cart is empty')) {
                return;
            }
            
            hasItems = true;
            
            const image = $item.find('img').attr('src') || '';
            const name = $item.find('h3').text() || $item.find('.cart-item-name').text() || 'Product';
            
            // Extract quantity and price from the "2 x ₹50.00" format in p.theme-clr
            const priceText = $item.find('p.theme-clr').text() || '1 x ₹0.00';
            const priceMatch = priceText.match(/(\d+)\s*x\s*₹([\d,]+\.?\d*)/);
            const quantity = priceMatch ? priceMatch[1] : '1';
            const unitPrice = priceMatch ? priceMatch[2] : '0.00';
            
            // Get item ID and type from the remove button's data attributes
            const $removeBtn = $item.find('.remove-cart-item');
            const itemId = $removeBtn.data('item-id') || $removeBtn.data('product-id') || '';
            const itemType = $removeBtn.data('item-type') || 'product';
            
            // Debug: Log item extraction
            console.log('Cart sidebar item:', {
                itemId: itemId,
                itemType: itemType,
                name: name,
                quantity: quantity,
                unitPrice: unitPrice,
                priceText: priceText
            });
            
            sidebarHtml += `
                <div class="cart-item" data-item-id="${itemId}" data-item-type="${itemType}">
                    <div class="cart-item-image">
                        <img src="${image}" alt="${name}" onerror="this.src='/assets/images/placeholder.jpg'">
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-name">${name}</div>
                        <div class="cart-item-meta">Fresh & Healthy</div>
                        <div class="cart-item-quantity">
                            <div class="quantity-controls">
                                <button class="quantity-btn decrease qty-btn dec" type="button" data-item-id="${itemId}" data-item-type="${itemType}">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="quantity-input" value="${quantity}" min="1" readonly data-item-id="${itemId}" data-item-type="${itemType}">
                                <button class="quantity-btn increase qty-btn inc" type="button" data-item-id="${itemId}" data-item-type="${itemType}">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="cart-item-price">₹${unitPrice}</div>
                    <button class="remove-item-btn remove-cart-item" data-item-id="${itemId}" data-item-type="${itemType}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
        });
        
        // If no items found, return empty cart state
        if (!hasItems) {
            return `
                <div class="empty-cart-state">
                    <div class="empty-cart-illustration">
                        <div class="cart-icon-large">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="floating-hearts">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <h4>Your cart is empty</h4>
                    <p>Discover amazing products for your beloved pets!</p>
                    <a href="{{ route('products.index') }}" class="btn-continue-shopping">
                        <i class="fas fa-paw"></i>
                        Start Shopping
                    </a>
                </div>
            `;
        }
        
        return sidebarHtml;
    }
    
    // Use universal toast function from cart-wishlist.js
    function showToast(message, type) {
        if (window.cartWishlistManager) {
            window.cartWishlistManager.showToast(message, type);
        } else {
            // Fallback if cart-wishlist.js isn't loaded
            console.log(type.toUpperCase() + ': ' + message);a
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

/* Authentication Required Modal Styles */
.auth-required-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    backdrop-filter: blur(5px);
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.auth-required-content {
    background: white;
    border-radius: 20px;
    padding: 0;
    max-width: 420px;
    width: 90%;
    position: relative;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    animation: modalSlideUp 0.3s ease-out;
    overflow: hidden;
}

@keyframes modalSlideUp {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.close-auth-modal {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    color: #666;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    z-index: 10;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.close-auth-modal:hover {
    background: #fa441d;
    color: white;
    transform: scale(1.1);
}

.auth-modal-header {
    background: linear-gradient(135deg, #fa441d 0%, #ff6b47 100%);
    color: white;
    padding: 30px 20px 20px;
    text-align: center;
    position: relative;
}

.auth-modal-icon {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 28px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    animation: iconPulse 2s infinite;
}

@keyframes iconPulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

.auth-modal-header h3 {
    margin: 0 0 10px 0;
    font-size: 22px;
    font-weight: 600;
}

.auth-modal-subtitle {
    margin: 0;
    font-size: 14px;
    opacity: 0.9;
}

.auth-modal-body {
    padding: 25px 20px;
}

.benefits-showcase {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 25px;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    background: rgba(250, 68, 29, 0.05);
    border-radius: 10px;
    transition: all 0.3s ease;
    border-left: 3px solid #fa441d;
}

.benefit-item:hover {
    background: rgba(250, 68, 29, 0.1);
    transform: translateX(5px);
}

.benefit-item i {
    font-size: 16px;
    min-width: 16px;
}

.benefit-item span {
    font-size: 13px;
    font-weight: 500;
    color: #333;
}

.auth-modal-actions {
    padding: 0 20px 25px;
    display: grid;
    gap: 12px;
}

.btn-auth-login,
.btn-auth-register {
    padding: 12px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-auth-login {
    background: linear-gradient(135deg, #fa441d 0%, #ff6b47 100%);
    color: white;
}

.btn-auth-login:hover {
    background: linear-gradient(135deg, #e63a1a 0%, #ff5722 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(250, 68, 29, 0.4);
    color: white;
    text-decoration: none;
}

.btn-auth-register {
    background: white;
    color: #fa441d;
    border: 2px solid #fa441d;
}

.btn-auth-register:hover {
    background: #fa441d;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(250, 68, 29, 0.3);
    text-decoration: none;
}

/* Mobile Responsive */
@media (max-width: 480px) {
    .auth-required-content {
        width: 95%;
        margin: 20px;
    }
    
    .auth-modal-header {
        padding: 25px 15px 15px;
    }
    
    .auth-modal-icon {
        width: 60px;
        height: 60px;
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .auth-modal-header h3 {
        font-size: 20px;
    }
    
    .auth-modal-body {
        padding: 20px 15px;
    }
    
    .benefits-showcase {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .benefit-item {
        padding: 10px;
    }
    
    .benefit-item span {
        font-size: 12px;
    }
    
    .auth-modal-actions {
        padding: 0 15px 20px;
        gap: 10px;
    }
    
    .btn-auth-login,
    .btn-auth-register {
        padding: 12px 16px;
        font-size: 13px;
    }
}

/* Ensure cart popup appears above other elements */
#lightbox {
    z-index: 9999;
}

.cart-popup-wrapper {
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
    font-family: 'Poppins', sans-serif;
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
    font-family: 'Poppins', sans-serif;
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
    font-family: 'Poppins', sans-serif;
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
    font-family: 'Poppins', sans-serif;
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
    font-family: 'Poppins', sans-serif;
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

/* Product Brand Styling - Global */
.product-brand {
    font-size: 11px;
    color: #666;
    margin-top: 3px;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.product-brand i {
    font-size: 10px;
}

/* Mobile Brand Styling */
@media (max-width: 768px) {
    .product-brand {
        font-size: 10px;
        margin-top: 2px;
        margin-bottom: 3px;
        gap: 3px;
    }
    
    .product-brand i {
        font-size: 8px;
    }
    
    /* Better mobile product card spacing */
    .healthy-product {
        margin-bottom: 20px;
        padding: 15px;
    }
    
    .healthy-product span {
        font-size: 12px;
        margin-bottom: 3px;
        display: block;
        line-height: 1.3;
    }
    
    .healthy-product a {
        font-size: 14px;
        line-height: 1.3;
        margin: 5px 0;
        display: block;
    }
    
    .healthy-product h6 {
        font-size: 16px;
        margin-top: 8px;
        font-weight: 600;
    }
}

@media (max-width: 480px) {
    .product-brand {
        font-size: 9px;
        gap: 2px;
        margin-top: 1px;
        margin-bottom: 2px;
    }
    
    .product-brand i {
        font-size: 7px;
    }
    
    .healthy-product {
        padding: 12px;
        margin-bottom: 15px;
    }
    
    .healthy-product span {
        font-size: 11px;
    }
    
    .healthy-product a {
        font-size: 13px;
        line-height: 1.2;
    }
    
    .healthy-product h6 {
        font-size: 15px;
        margin-top: 5px;
    }
}
</style>

<script>
// User Profile Dropdown Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Desktop dropdown
    const userDropdown = document.getElementById('userDropdown');
    const userDropdownToggle = document.getElementById('userDropdownToggle');
    
    if (userDropdownToggle) {
        userDropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            userDropdown.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });
    }
    
    // Mobile dropdown
    const mobileUserDropdown = document.getElementById('mobileUserDropdown');
    const mobileUserDropdownToggle = document.getElementById('mobileUserDropdownToggle');
    
    if (mobileUserDropdownToggle) {
        mobileUserDropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            mobileUserDropdown.classList.toggle('show');
        });
    }
});
</script>

</body>
</html>
