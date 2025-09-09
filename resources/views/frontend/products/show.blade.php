@extends('frontend.layouts.layout')
@section('styles')
<style>
/* Theme Colors */
:root {
    --primary-color: #fa441d;
    --primary-dark: #e63612;
    --primary-light: #fef2ee;
    --secondary-color: #2c3e50;
    --accent-color: #ffc107;
    --text-dark: #2c3e50;
    --text-light: #6c757d;
    --border-color: #e9ecef;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --shadow: 0 4px 25px rgba(0,0,0,0.1);
    --shadow-light: 0 2px 15px rgba(0,0,0,0.08);
}

/* Product Gallery Styles - Amazon/Flipkart Style */
.pd-gallery {
    padding: 20px;
    background: var(--white);
    border-radius: 15px;
    box-shadow: var(--shadow-light);
    margin-bottom: 30px;
}

.gallery-container {
    display: flex;
    gap: 20px;
}

.gallery-thumbnails {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 80px;
    max-height: 400px;
    overflow-y: auto;
}

.gallery-thumbnails::-webkit-scrollbar {
    width: 4px;
}

.gallery-thumbnails::-webkit-scrollbar-track {
    background: var(--bg-light);
    border-radius: 2px;
}

.gallery-thumbnails::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 2px;
}

.thumbnail-item {
    width: 70px;
    height: 70px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.thumbnail-item.active {
    border-color: var(--primary-color);
    box-shadow: 0 0 10px rgba(250, 68, 29, 0.3);
}

.thumbnail-item:hover {
    border-color: var(--primary-color);
    transform: scale(1.05);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.main-gallery {
    flex: 1;
    position: relative;
    background: #fafafa;
    border-radius: 12px;
    padding: 20px;
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-gallery img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.main-gallery:hover img {
    transform: scale(1.02);
}

.gallery-zoom-hint {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.main-gallery:hover .gallery-zoom-hint {
    opacity: 1;
}

/* Product Info Styles */
.product-info {
    padding: 30px;
    background: var(--white);
    border-radius: 20px;
    box-shadow: var(--shadow);
    height: fit-content;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 20px 0;
    padding: 15px 0;
    border-bottom: 1px solid var(--border-color);
}

.start {
    display: flex;
    align-items: center;
    gap: 3px;
}

.start i {
    color: var(--accent-color);
    font-size: 18px;
    transition: transform 0.2s ease;
}

.start i:hover {
    transform: scale(1.2);
}

.rating-text {
    color: var(--text-light);
    font-weight: 500;
    background: var(--bg-light);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
}

.product-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--text-dark);
    margin: 20px 0;
    line-height: 1.3;
}

.price-section {
    margin: 25px 0;
    padding: 20px 0;
    border-bottom: 1px solid var(--border-color);
}

.price {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
}

.price del {
    color: var(--text-light);
    font-size: 20px;
    text-decoration: line-through;
}

.price ins {
    text-decoration: none;
    color: var(--primary-color);
    font-weight: 800;
    font-size: 28px;
}

.stock-status {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
}

.stock-status.in-stock {
    background: #d4edda;
    color: #155724;
}

.stock-status.out-of-stock {
    background: #f8d7da;
    color: #721c24;
}

.quantity-section {
    margin: 25px 0;
}

.quantity-section h6 {
    margin-bottom: 15px;
    font-weight: 600;
    color: var(--text-dark);
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.input-text {
    width: 80px;
    padding: 12px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    text-align: center;
    font-weight: 600;
    transition: all 0.3s ease;
}

.input-text:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(250, 68, 29, 0.1);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    border: none;
    padding: 15px 35px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
}

.product_meta {
    list-style: none;
    padding: 0;
    margin: 25px 0 0 0;
}

.product_meta li {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f1f1;
}

.product_meta li:last-child {
    border-bottom: none;
}

.theme-bg-clr {
    font-weight: 700;
    margin-right: 15px;
    color: var(--text-dark);
    min-width: 80px;
}

.meta-value {
    color: var(--text-light);
    font-weight: 500;
}

/* Tabs Section */
.product-tabs-section {
    margin: 60px 0;
    background: var(--white);
    border-radius: 20px;
    box-shadow: var(--shadow);
    overflow: hidden;
}

.tabs-navigation {
    display: flex;
    background: linear-gradient(135deg, var(--primary-light) 0%, #fff 100%);
    border-bottom: 1px solid var(--border-color);
}

.tab-button {
    flex: 1;
    padding: 20px 30px;
    background: none;
    border: none;
    font-size: 16px;
    font-weight: 600;
    color: var(--text-light);
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tab-button::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 3px;
    background: var(--primary-color);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.tab-button.active {
    color: var(--primary-color);
    background: var(--white);
}

.tab-button.active::after {
    width: 80%;
}

.tab-button:hover {
    color: var(--primary-color);
    background: rgba(250, 68, 29, 0.05);
}

.tab-content {
    padding: 40px;
    min-height: 300px;
}

.tab-pane {
    display: none;
    animation: fadeIn 0.5s ease-in-out;
}

.tab-pane.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.tab-pane h4 {
    color: var(--text-dark);
    margin-bottom: 20px;
    font-weight: 600;
}

.tab-pane p {
    color: var(--text-light);
    line-height: 1.8;
    margin-bottom: 20px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.info-item {
    background: var(--bg-light);
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid var(--primary-color);
}

.info-item h6 {
    color: var(--text-dark);
    font-weight: 600;
    margin-bottom: 8px;
}

.info-item span {
    color: var(--text-light);
    font-weight: 500;
}

/* Reviews Styles */
.reviews-list {
    list-style: none;
    padding: 0;
}

.review-item {
    padding: 25px;
    border: 1px solid var(--border-color);
    border-radius: 15px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.review-item:hover {
    box-shadow: var(--shadow-light);
    transform: translateY(-2px);
}

.review-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.reviewer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.reviewer-info h6 {
    margin: 0;
    color: var(--text-dark);
    font-weight: 600;
}

.review-date {
    color: var(--text-light);
    font-size: 14px;
}

.review-stars {
    display: flex;
    gap: 2px;
    margin: 8px 0;
}

.review-text {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

/* Reviews Styles */
.reviews-section {
    padding: 30px 0;
}

.review-stats {
    background: var(--bg-light);
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    text-align: center;
}

.review-stats .rating-number {
    font-size: 48px;
    font-weight: 800;
    color: var(--primary-color);
    line-height: 1;
}

.review-stats .stars {
    margin: 10px 0;
}

.review-stats .stars i {
    font-size: 24px;
    color: var(--accent-color);
    margin: 0 3px;
}

.review-stats .total-reviews {
    color: var(--text-light);
    font-size: 16px;
    margin-bottom: 20px;
}

.review-stats .btn-primary {
    padding: 12px 24px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
}

.review-stats .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
}

.review-stats .btn-primary i {
    margin-right: 8px;
    font-size: 14px;
}
    font-size: 14px;
    font-weight: 500;
}

.review-form {
    background: var(--white);
    padding: 30px;
    border-radius: 15px;
    box-shadow: var(--shadow-light);
    margin-bottom: 30px;
}

.review-form h5 {
    margin-bottom: 20px;
    color: var(--text-dark);
    font-weight: 600;
}

.review-form .form-group {
    margin-bottom: 20px;
}

.review-form .form-control {
    border: 2px solid var(--border-color);
    border-radius: 10px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.review-form .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(250, 68, 29, 0.1);
    outline: none;
}

.rating-input {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.rating-stars {
    display: flex;
    gap: 5px;
}

.rating-stars i {
    font-size: 24px;
    color: var(--border-color);
    cursor: pointer;
    transition: all 0.3s ease;
}

.rating-stars i:hover,
.rating-stars i.active {
    color: var(--accent-color);
    transform: scale(1.1);
}

.reviews-list {
    list-style: none;
    padding: 0;
}

.review-item {
    background: var(--white);
    padding: 25px;
    border-radius: 15px;
    box-shadow: var(--shadow-light);
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.review-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow);
}

.review-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-color);
}

.reviewer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--primary-light);
}

.reviewer-info h6 {
    margin: 0 0 5px 0;
    color: var(--text-dark);
    font-weight: 600;
}

.review-stars {
    display: flex;
    gap: 3px;
    margin-bottom: 3px;
}

.review-stars i {
    color: var(--accent-color);
    font-size: 14px;
}

.review-date {
    color: var(--text-light);
    font-size: 12px;
}

.review-text {
    color: var(--text-dark);
    line-height: 1.6;
    margin: 0;
}

.no-reviews {
    text-align: center;
    padding: 60px 30px;
    color: var(--text-light);
}

.no-reviews i {
    font-size: 64px;
    margin-bottom: 20px;
    color: var(--border-color);
}

.no-reviews h5 {
    font-size: 24px;
    margin-bottom: 15px;
    color: var(--text-dark);
}

.no-reviews p {
    font-size: 16px;
    margin-bottom: 25px;
    color: var(--text-light);
}

.no-reviews .btn-primary {
    padding: 12px 24px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}

.no-reviews .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
}

.no-reviews .btn-primary i {
    margin-right: 8px;
    font-size: 14px;
}

/* Related Products */
.related-products {
    margin: 60px 0;
    padding: 0 40px; /* Add horizontal padding */
}

.section-title {
    text-align: left; /* Align to left instead of center */
    margin-bottom: 40px;
    padding-left: 20px;
}

.section-title h3 {
    font-size: 32px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 10px;
}

.section-title .boder-bar {
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    margin: 0 0 15px 0; /* Remove auto centering */
    border-radius: 2px;
}

.section-title p {
    color: var(--text-light);
    font-size: 16px;
    margin: 0;
}

.related-products .row {
    margin: 0 -10px; /* Reduce spacing between columns */
}

.related-products .row > [class*="col-"] {
    padding: 0 10px; /* Reduce column padding */
}

.healthy-product {
    background: var(--white);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow-light);
    transition: all 0.3s ease;
    margin-bottom: 25px;
    border: 1px solid #f0f0f0;
}

.healthy-product:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow);
    border-color: var(--primary-color);
}

.healthy-product-img {
    position: relative;
    overflow: hidden;
    height: 200px;
    background: #fafafa;
}

.healthy-product-img img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* Changed from cover to contain for better product display */
    transition: transform 0.3s ease;
    padding: 10px; /* Add padding around product images */
}

.healthy-product:hover .healthy-product-img img {
    transform: scale(1.05);
}

.product-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: var(--primary-color);
    color: white;
    padding: 6px 10px;
    border-radius: 15px;
    font-weight: 600;
    font-size: 11px;
    z-index: 2;
}

.product-content {
    padding: 20px;
}

.product-category {
    color: var(--text-light);
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-brand {
    font-size: 12px;
    color: var(--primary-color);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.product-name {
    color: var(--text-dark);
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 12px;
    text-decoration: none;
    display: block;
    transition: color 0.3s ease;
    line-height: 1.4;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-name:hover {
    color: var(--primary-color);
}

.product-rating {
    margin-bottom: 10px;
}

.product-rating .start {
    gap: 2px;
}

.product-rating .start i {
    font-size: 14px;
}

.product-price {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    margin-bottom: 15px;
}

.product-price del {
    color: var(--text-light);
    font-size: 14px;
}

.product-price .current-price {
    color: var(--primary-color);
    font-size: 18px;
    font-weight: 700;
}

.product-actions {
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
}

.healthy-product:hover .product-actions {
    opacity: 1;
    transform: translateY(0);
}

.product-actions .btn-primary {
    padding: 10px 20px;
    font-size: 14px;
    border-radius: 8px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .pd-gallery {
        margin-bottom: 20px;
    }
    
    .product-info {
        margin-top: 0;
    }
    
    .tabs-navigation {
        flex-direction: column;
    }
    
    .tab-button {
        border-bottom: 1px solid var(--border-color);
    }
    
    .tab-button:last-child {
        border-bottom: none;
    }
    
    .related-products {
        padding: 0 20px;
    }
}

@media (max-width: 768px) {
    .pd-gallery {
        padding: 15px;
    }
    
    .gallery-container {
        flex-direction: column;
        gap: 15px;
    }
    
    .gallery-thumbnails {
        flex-direction: row;
        width: 100%;
        max-height: none;
        overflow-x: auto;
        overflow-y: hidden;
        gap: 8px;
        padding: 5px 0;
    }
    
    .thumbnail-item {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
    }
    
    .main-gallery {
        min-height: 300px;
        padding: 15px;
    }
    
    .product-info {
        padding: 20px;
    }
    
    .product-title {
        font-size: 24px;
    }
    
    .price ins {
        font-size: 22px;
    }
    
    .tab-content {
        padding: 25px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .related-products {
        padding: 0 15px;
    }
    
    .related-products .row {
        margin: 0 -5px;
    }
    
    .related-products .row > [class*="col-"] {
        padding: 0 5px;
    }
}

@media (max-width: 480px) {
    .gallery-container {
        gap: 10px;
    }
    
    .thumbnail-item {
        width: 50px;
        height: 50px;
    }
    
    .main-gallery {
        min-height: 250px;
        padding: 10px;
    }
    
    .product-title {
        font-size: 20px;
    }
    
    .section-title h3 {
        font-size: 24px;
    }
    
    .tab-content {
        padding: 20px;
    }
    
    .related-products {
        padding: 0 10px;
    }
    
    .product-content {
        padding: 15px;
    }
    
    .product-name {
        font-size: 14px;
        height: 40px;
    }
    
    .gallery-thumbnails::-webkit-scrollbar {
        height: 4px;
    }
    
    .gallery-thumbnails::-webkit-scrollbar-track {
        background: var(--bg-light);
        border-radius: 2px;
    }
    
    .gallery-thumbnails::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 2px;
    }
}
</style>
@endsection

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Product Details</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="{{ route('products.index') }}">Products</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
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

<section class="gap no-bottom">
  <div class="container">
    <div class="row product-info-section">
      <div class="col-lg-7 p-0">
        <div class="pd-gallery">
          <div class="gallery-container">
            @if($product->gallery && is_array($product->gallery) && count($product->gallery) > 0)
            <!-- Thumbnail Navigation (Left Side) -->
            <div class="gallery-thumbnails">
              @foreach($product->gallery as $index => $image)
              <div class="thumbnail-item {{ $index == 0 ? 'active' : '' }}" onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)">
                <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}">
              </div>
              @endforeach
              <!-- Add main product image as first thumbnail if not in gallery -->
              @if($product->image && !in_array($product->image, $product->gallery ?? []))
              <div class="thumbnail-item {{ !$product->gallery ? 'active' : '' }}" onclick="changeMainImage('{{ asset('storage/' . $product->image) }}', this)">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
              </div>
              @endif
            </div>
            @endif
            
            <!-- Main Image Display (Right Side) -->
            <div class="main-gallery">
              <img id="NZoomImg" alt="{{ $product->name }}" src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/food-shop-1.png') }}">
              <div class="gallery-zoom-hint">
                <i class="fa-solid fa-search-plus"></i> Hover to zoom
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="product-info">
          <div class="product-rating">
            <div class="start">
              @for($i = 1; $i <= 5; $i++)
                @if($i <= $product->rating)
                  <i class="fa-solid fa-star"></i>
                @else
                  <i class="fa-regular fa-star"></i>
                @endif
              @endfor
            </div>
            <span class="rating-text">{{ $product->reviews_count }} Reviews</span>
          </div>
          <h3 class="product-title">{{ $product->name }}</h3>
          <form class="variations_form">
            <div class="price-section">
              <div class="price">
                @if($product->sale_price)
                  <del>₹{{ number_format($product->price, 2) }}</del>
                  <ins>₹{{ number_format($product->sale_price, 2) }}</ins>
                @else
                  <ins>₹{{ number_format($product->price, 2) }}</ins>
                @endif
              </div>
              <div class="stock-status {{ $product->stock_quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                <i class="fa-solid {{ $product->stock_quantity > 0 ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
              </div>
            </div>
            
            @if($product->stock_quantity > 0)
            <div class="quantity-section">
              <h6>Quantity</h6>
              <div class="quantity-controls">
                <input type="number" class="input-text quantity-input" step="1" min="1" max="{{ $product->stock_quantity }}" name="quantity" value="1">
                <button type="button" class="btn-primary add-to-cart-btn" data-product-id="{{ $product->id }}">
                  <i class="fa-solid fa-cart-plus"></i> Add to Cart
                </button>
              </div>
            </div>
            @else
            <div class="out-of-stock-notice">
              <p class="text-danger"><strong>This product is currently out of stock</strong></p>
            </div>
            @endif
            
            <ul class="product_meta">
              <li>
                <span class="theme-bg-clr">Category:</span> 
                <span class="meta-value">
                    @if($product->category && $product->subcategory)
                        {{ $product->category->name }} > {{ $product->subcategory->name }}
                    @elseif($product->category)
                        {{ $product->category->name }}
                    @else
                        Uncategorized
                    @endif
                </span>
              </li>
              @if($product->brand)
              <li>
                <span class="theme-bg-clr">Brand:</span> 
                <span class="meta-value">{{ $product->brand->name }}</span>
              </li>
              @endif
              <li>
                <span class="theme-bg-clr">SKU:</span> 
                <span class="meta-value">{{ $product->sku }}</span>
              </li>
              @if($product->stock_quantity > 0)
              <li>
                <span class="theme-bg-clr">Stock:</span> 
                <span class="meta-value">{{ $product->stock_quantity }} units available</span>
              </li>
              @endif
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<<section class="gap">
  <div class="container">
    <!-- Product Tabs Section -->
    <div class="product-tabs-section">
      <div class="tabs-navigation">
        <button class="tab-button active" onclick="openTab(event, 'description')">
          <i class="fa-solid fa-file-text"></i> Description
        </button>
        <button class="tab-button" onclick="openTab(event, 'additional-info')">
          <i class="fa-solid fa-info-circle"></i> Additional Info
        </button>
        <button class="tab-button" onclick="openTab(event, 'reviews')">
          <i class="fa-solid fa-star"></i> Reviews
        </button>
      </div>
      
      <div class="tab-content">
        <!-- Description Tab -->
        <div id="description" class="tab-pane active">
          <h4><i class="fa-solid fa-file-text me-2"></i>Product Description</h4>
          @if($product->description)
            <p>{{ $product->description }}</p>
          @else
            <p>Discover the amazing qualities of {{ $product->name }}. This premium product is carefully crafted to meet the highest standards of quality and excellence. Whether you're looking for nutrition, taste, or value, this product delivers on all fronts.</p>
            <p>Our commitment to quality ensures that every {{ $product->name }} meets rigorous standards before reaching your hands. Experience the difference that quality makes with this exceptional product.</p>
          @endif
          
          <div class="product-highlights mt-4">
            <h5><i class="fa-solid fa-check-circle me-2 text-success"></i>Key Features:</h5>
            <ul class="feature-list">
              <li><i class="fa-solid fa-check text-success"></i> Premium Quality Ingredients</li>
              <li><i class="fa-solid fa-check text-success"></i> Nutritionally Balanced</li>
              <li><i class="fa-solid fa-check text-success"></i> Safe & Natural</li>
              <li><i class="fa-solid fa-check text-success"></i> Expert Recommended</li>
            </ul>
          </div>
        </div>
        
        <!-- Additional Info Tab -->
        <div id="additional-info" class="tab-pane">
          <h4><i class="fa-solid fa-info-circle me-2"></i>Additional Information</h4>
          <div class="info-grid">
            <div class="info-item">
              <h6><i class="fa-solid fa-weight-hanging me-2"></i>Weight</h6>
              <span>{{ $product->weight ?? 'Standard Package' }}</span>
            </div>
            <div class="info-item">
              <h6><i class="fa-solid fa-ruler-combined me-2"></i>Dimensions</h6>
              <span>{{ $product->dimensions ?? 'Standard Size' }}</span>
            </div>
            <div class="info-item">
              <h6><i class="fa-solid fa-tag me-2"></i>Category</h6>
              <span>
                  @if($product->category && $product->subcategory)
                      {{ $product->category->name }} > {{ $product->subcategory->name }}
                  @elseif($product->category)
                      {{ $product->category->name }}
                  @else
                      Uncategorized
                  @endif
              </span>
            </div>
            @if($product->brand)
            <div class="info-item">
              <h6><i class="fa-solid fa-industry me-2"></i>Brand</h6>
              <span>{{ $product->brand->name }}</span>
            </div>
            @endif
            <div class="info-item">
              <h6><i class="fa-solid fa-barcode me-2"></i>SKU</h6>
              <span>{{ $product->sku }}</span>
            </div>
            <div class="info-item">
              <h6><i class="fa-solid fa-boxes me-2"></i>Stock Status</h6>
              <span class="{{ $product->stock_quantity > 0 ? 'text-success' : 'text-danger' }}">
                {{ $product->stock_quantity > 0 ? 'In Stock (' . $product->stock_quantity . ' available)' : 'Out of Stock' }}
              </span>
            </div>
          </div>
        </div>
        
        <!-- Reviews Tab -->
        <div id="reviews" class="tab-pane">
          <h4><i class="fa-solid fa-star me-2"></i>Customer Reviews</h4>
          
          @if($product->reviews()->approved()->count() > 0)
            <div class="review-stats mb-4">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <div class="rating-overview">
                    <div class="overall-rating">
                      <span class="rating-number">{{ number_format($product->rating, 1) }}</span>
                      <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                          @if($i <= $product->rating)
                            <i class="fa-solid fa-star"></i>
                          @else
                            <i class="fa-regular fa-star"></i>
                          @endif
                        @endfor
                      </div>
                      <span class="total-reviews">Based on {{ $product->reviews()->approved()->count() }} reviews</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <button class="btn-primary w-100" onclick="toggleReviewForm()">
                    <i class="fa-solid fa-edit"></i> Write a Review
                  </button>
                </div>
              </div>
            </div>
          @else
            <div class="review-stats mb-4">
              <div class="no-reviews">
                <i class="fa-solid fa-star-half-alt"></i>
                <h5>No reviews yet</h5>
                <p>Be the first to review this product!</p>
                <button class="btn-primary" onclick="toggleReviewForm()">
                  <i class="fa-solid fa-edit"></i> Write First Review
                </button>
              </div>
            </div>
          @endif

          <!-- Review Form -->
          <div id="reviewForm" class="review-form" style="display: none;">
            <h5><i class="fa-solid fa-comment-dots me-2"></i>Write Your Review</h5>
            <form action="{{ route('reviews.store') }}" method="POST" id="reviewSubmitForm">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Your Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" 
                           value="{{ auth()->check() ? auth()->user()->name : old('name') }}" 
                           {{ auth()->check() ? 'readonly' : '' }} required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Your Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" 
                           value="{{ auth()->check() ? auth()->user()->email : old('email') }}" 
                           {{ auth()->check() ? 'readonly' : '' }} required>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label>Your Rating <span class="text-danger">*</span></label>
                <div class="rating-input">
                  <span>Click to rate:</span>
                  <div class="rating-stars" id="ratingStars">
                    <i class="fa-solid fa-star" data-rating="1"></i>
                    <i class="fa-solid fa-star" data-rating="2"></i>
                    <i class="fa-solid fa-star" data-rating="3"></i>
                    <i class="fa-solid fa-star" data-rating="4"></i>
                    <i class="fa-solid fa-star" data-rating="5"></i>
                  </div>
                  <input type="hidden" name="rating" id="ratingInput" required>
                </div>
              </div>
              
              <div class="form-group">
                <label for="comment">Your Review <span class="text-danger">*</span></label>
                <textarea class="form-control" name="comment" id="comment" rows="5" 
                          placeholder="Share your experience with this product..." required>{{ old('comment') }}</textarea>
              </div>
              
              <div class="d-flex gap-3">
                <button type="submit" class="btn-primary">
                  <i class="fa-solid fa-paper-plane"></i> Submit Review
                </button>
                <button type="button" class="btn btn-secondary" onclick="toggleReviewForm()">
                  <i class="fa-solid fa-times"></i> Cancel
                </button>
              </div>
            </form>
          </div>
          
          <!-- Existing Reviews -->
          @if($product->reviews()->approved()->count() > 0)
            <ul class="reviews-list">
              @foreach($product->reviews()->approved()->latest()->get() as $review)
                <li class="review-item">
                  <div class="review-header">
                    @if($review->user && $review->user->avatar)
                      <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="{{ $review->name }}" class="reviewer-avatar">
                    @else
                      <div class="reviewer-avatar d-flex align-items-center justify-content-center text-white" 
                           style="background-color: var(--primary-color); font-weight: 600; font-size: 18px; width: 50px; height: 50px; border-radius: 50%;">
                        {{ strtoupper(substr($review->name, 0, 1)) }}
                      </div>
                    @endif
                    <div class="reviewer-info">
                      <h6>{{ $review->name }}</h6>
                      <div class="review-stars">
                        @for($i = 1; $i <= 5; $i++)
                          @if($i <= $review->rating)
                            <i class="fa-solid fa-star"></i>
                          @else
                            <i class="fa-regular fa-star"></i>
                          @endif
                        @endfor
                      </div>
                      <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                  </div>
                  <p class="review-text">{{ $review->comment }}</p>
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
    @if($relatedProducts->count() > 0)
    <div class="container">
      <div class="related-products">
        <div class="section-title">
          <h3>Related Products</h3>
          <div class="boder-bar"></div>
          <p>Discover more amazing products you might love</p>
        </div>
        <div class="row">
          @foreach($relatedProducts as $related)
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
              <div class="healthy-product">
                  <div class="healthy-product-img">
                      <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('assets/img/food-1.png') }}" alt="{{ $related->name }}">
                      @if($related->sale_price)
                          <div class="product-badge">
                              -{{ round((($related->price - $related->sale_price) / $related->price) * 100) }}%
                          </div>
                      @endif
                  </div>
                  <div class="product-content">
                      <div class="product-category">
                          @if($related->category && $related->subcategory)
                              {{ $related->category->name }} > {{ $related->subcategory->name }}
                          @elseif($related->category)
                              {{ $related->category->name }}
                          @else
                              Uncategorized
                          @endif
                      </div>
                      @if($related->brand)
                          <div class="product-brand">{{ $related->brand->name }}</div>
                      @endif
                      <a href="{{ route('product.show', $related->slug) }}" class="product-name">{{ $related->name }}</a>
                      <div class="product-rating mb-2">
                          <div class="start">
                              @for($i = 1; $i <= 5; $i++)
                                  @if($i <= $related->rating)
                                      <i class="fa-solid fa-star"></i>
                                  @else
                                      <i class="fa-regular fa-star"></i>
                                  @endif
                              @endfor
                          </div>
                      </div>
                      <div class="product-price">
                          @if($related->sale_price)
                              <del>₹{{ number_format($related->price, 2) }}</del>
                              <span class="current-price">₹{{ number_format($related->sale_price, 2) }}</span>
                          @else
                              <span class="current-price">₹{{ number_format($related->price, 2) }}</span>
                          @endif
                      </div>
                      <div class="product-actions mt-3">
                          <button class="btn-primary w-100 add-to-cart-btn" data-product-id="{{ $related->id }}">
                              <i class="fa-solid fa-cart-plus"></i> Add to Cart
                          </button>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
@endsection

@section('script')
<script>
// Gallery Image Change Function - Amazon/Flipkart Style
function changeMainImage(src, element) {
    document.getElementById('NZoomImg').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail-item').forEach(function(item) {
        item.classList.remove('active');
    });
    element.classList.add('active');
}

// Review Functionality
function toggleReviewForm() {
    const form = document.getElementById('reviewForm');
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        form.style.display = 'none';
    }
}

// Rating Stars Functionality
document.addEventListener('DOMContentLoaded', function() {
    const ratingStars = document.querySelectorAll('#ratingStars i');
    const ratingInput = document.getElementById('ratingInput');
    
    ratingStars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            
            // Update star appearance
            ratingStars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
        });
        
        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            
            // Highlight stars on hover
            ratingStars.forEach((s, i) => {
                if (i < rating) {
                    s.style.color = 'var(--accent-color)';
                } else {
                    s.style.color = 'var(--border-color)';
                }
            });
        });
    });
    
    // Reset hover effect when leaving rating area
    const ratingContainer = document.getElementById('ratingStars');
    if (ratingContainer) {
        ratingContainer.addEventListener('mouseleave', function() {
            const currentRating = ratingInput.value;
            
            ratingStars.forEach((s, i) => {
                if (i < currentRating) {
                    s.style.color = 'var(--accent-color)';
                } else {
                    s.style.color = 'var(--border-color)';
                }
            });
        });
    }
});

// Review Form Submission
document.getElementById('reviewSubmitForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Validate rating
    if (!formData.get('rating')) {
        alert('Please select a rating');
        return;
    }
    
    // Get CSRF token from meta tag or form
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        // Fallback to form CSRF token
        csrfToken = formData.get('_token');
    }
    
    if (!csrfToken) {
        alert('Security token missing. Please refresh the page and try again.');
        return;
    }
    
    // Add loading state
    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';
    submitBtn.disabled = true;
    
    // Since we're using FormData, the CSRF token from @csrf should already be included
    // But let's also add it to headers for extra safety
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Thank you! Your review has been submitted and will be published after approval.');
            this.reset();
            document.getElementById('ratingInput').value = '';
            document.querySelectorAll('#ratingStars i').forEach(star => {
                star.classList.remove('active');
                star.style.color = 'var(--border-color)';
            });
            toggleReviewForm();
        } else {
            alert('Error: ' + (data.message || 'Unable to submit review. Please try again.'));
            if (data.errors) {
                console.error('Validation errors:', data.errors);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (error.message.includes('419')) {
            alert('Session expired. Please refresh the page and try again.');
        } else {
            alert('Error submitting review. Please try again.');
        }
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// Tab Functionality
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    
    // Hide all tab content
    tabcontent = document.getElementsByClassName("tab-pane");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }
    
    // Remove active class from all tab buttons
    tablinks = document.getElementsByClassName("tab-button");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    
    // Show the selected tab content and mark button as active
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}

$(document).ready(function() {
    // Quantity Input Controls
    $('.quantity-input').on('input', function() {
        var value = parseInt($(this).val());
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        
        if (value > max) {
            $(this).val(max);
        } else if (value < min) {
            $(this).val(min);
        }
    });

    // Add to Cart functionality
    $('.add-to-cart-btn').click(function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        var quantity = $('.quantity-input').val() || 1;
        
        // Add loading state
        var originalText = $(this).html();
        $(this).html('<i class="fa-solid fa-spinner fa-spin"></i> Adding...');
        $(this).prop('disabled', true);
        
        // Simulate cart addition (replace with actual AJAX call)
        setTimeout(function() {
            // Show success message (you can use toastr or any notification library)
            alert('Product added to cart successfully!');
            
            // Reset button
            $('.add-to-cart-btn').html(originalText);
            $('.add-to-cart-btn').prop('disabled', false);
        }, 1000);
    });

    // Gallery keyboard navigation
    $(document).keydown(function(e) {
        var currentActive = $('.thumbnail-item.active');
        var nextThumb, prevThumb;
        
        if (e.which === 38) { // Up arrow
            prevThumb = currentActive.prev('.thumbnail-item');
            if (prevThumb.length) {
                prevThumb.click();
            }
        } else if (e.which === 40) { // Down arrow
            nextThumb = currentActive.next('.thumbnail-item');
            if (nextThumb.length) {
                nextThumb.click();
            }
        }
    });

    // Auto-scroll thumbnail container
    $('.thumbnail-item').click(function() {
        var container = $('.gallery-thumbnails');
        var item = $(this);
        var scrollPosition = item.position().top + container.scrollTop() - (container.height() / 2) + (item.height() / 2);
        
        container.animate({
            scrollTop: scrollPosition
        }, 300);
    });

    // Image zoom effect on hover (like Amazon)
    let isZooming = false;
    
    $('.main-gallery img').hover(
        function() {
            isZooming = true;
            $(this).css('cursor', 'zoom-in');
        },
        function() {
            isZooming = false;
            $(this).css({
                'cursor': 'default',
                'transform': 'scale(1)'
            });
        }
    );

    $('.main-gallery').mousemove(function(e) {
        if (!isZooming) return;
        
        var img = $(this).find('img');
        var container = $(this);
        var containerOffset = container.offset();
        var containerWidth = container.width();
        var containerHeight = container.height();
        
        var mouseX = e.pageX - containerOffset.left;
        var mouseY = e.pageY - containerOffset.top;
        
        var percentX = (mouseX / containerWidth) * 100;
        var percentY = (mouseY / containerHeight) * 100;
        
        img.css({
            'transform-origin': percentX + '% ' + percentY + '%',
            'transform': 'scale(1.5)'
        });
    });

    // Add animation to product cards
    $('.healthy-product').each(function(index) {
        $(this).css('animation-delay', (index * 0.1) + 's');
        $(this).addClass('animate-on-scroll');
    });

    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-visible');
                }
            });
        });

        document.querySelectorAll('.animate-on-scroll').forEach((el) => {
            observer.observe(el);
        });
    }
});

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .animate-visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .feature-list, .care-list {
        list-style: none;
        padding: 0;
        margin: 15px 0;
    }
    
    .feature-list li, .care-list li {
        padding: 8px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .feature-list i, .care-list i {
        width: 20px;
    }
    
    .overall-rating {
        text-align: center;
        padding: 20px;
        background: var(--primary-light);
        border-radius: 15px;
    }
    
    .rating-number {
        font-size: 48px;
        font-weight: 800;
        color: var(--primary-color);
        display: block;
        line-height: 1;
    }
    
    .total-reviews {
        color: var(--text-light);
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
    
    .product-brand {
        font-size: 12px;
        color: var(--primary-color);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    
    .product-actions {
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }
    
    .healthy-product:hover .product-actions {
        opacity: 1;
        transform: translateY(0);
    }
`;
document.head.appendChild(style);
</script>
@endsection
