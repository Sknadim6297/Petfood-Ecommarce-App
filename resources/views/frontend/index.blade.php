@extends('frontend.layouts.layout')
@section('styles')
<style>
/* Wishlist toggle button styling for home page */
.wishlist-toggle-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    color: #7f8c8d;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.wishlist-toggle-btn:hover {
    background: rgba(231, 76, 60, 0.1);
    color: #e74c3c;
    transform: scale(1.1);
    text-decoration: none;
}

.wishlist-toggle-btn.active {
    background: rgba(231, 76, 60, 0.1);
    color: #e74c3c;
}

.wishlist-toggle-btn.active:hover {
    background: rgba(231, 76, 60, 0.2);
    color: #e74c3c;
}

.wishlist-toggle-btn i {
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.wishlist-toggle-btn:hover i {
    transform: scale(1.1);
}

/* Loading state for wishlist buttons */
.wishlist-toggle-btn.btn-loading {
    pointer-events: none;
    opacity: 0.7;
}

.wishlist-toggle-btn.btn-loading i {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Browse Categories Section Styles */
.food-categorie {
    text-align: center;
    padding: 30px 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    margin: 10px;
    border: 2px solid #f0f0f0;
}

.food-categorie:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    border-color: #fa441d;
}

.food-categorie img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #fa441d;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    padding: 5px;
    background: white;
}

.food-categorie:hover img {
    transform: scale(1.1);
    border-color: #e63612;
    box-shadow: 0 5px 15px rgba(250, 68, 29, 0.3);
}

.food-categorie a {
    color: #2c3e50;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    transition: color 0.3s ease;
    display: block;
    margin-top: 10px;
}

.food-categorie:hover a {
    color: #fa441d;
}

.category-image-wrapper {
    margin-bottom: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.category-product-count {
    margin-top: 8px;
    opacity: 0.8;
}

.category-product-count small {
    font-size: 12px;
    color: #6c757d;
    font-weight: 500;
}

/* Responsive adjustments for categories */
@media (max-width: 768px) {
    .food-categorie img {
        width: 60px;
        height: 60px;
    }
    
    .food-categorie a {
        font-size: 14px;
    }
    
    .food-categorie {
        padding: 20px 15px;
        margin: 5px;
    }
}

/* Pet Types Section Styles */
.pet-types-section {
    background: #f8f9fa;
    padding: 80px 0;
}

.pet-type-tabs {
    margin-bottom: 50px;
}

.pet-type-tabs .nav-tabs {
    border: none;
    justify-content: center;
    margin-bottom: 0;
}

.pet-type-tabs .nav-link {
    border: 2px solid #e9ecef;
    background: white;
    color: #6c757d;
    padding: 15px 30px;
    border-radius: 50px;
    margin: 0 10px 10px 0;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
}

.pet-type-tabs .nav-link .pet-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    object-fit: cover;
}

.pet-type-tabs .nav-link:hover {
    color: #fa441d;
    border-color: #fa441d;
    background: #fff5f2;
}

.pet-type-tabs .nav-link.active {
    color: white;
    background: #fa441d;
    border-color: #fa441d;
}

.pet-type-tabs .nav-link .product-count {
    font-size: 12px;
    margin-left: 5px;
    opacity: 0.8;
}

.subcategory-grid {
    margin-top: 40px;
}

.subcategory-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    margin-bottom: 30px;
    overflow: hidden;
    border: 1px solid #f0f0f0;
}

.subcategory-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    border-color: #fa441d;
}

.subcategory-image {
    height: 200px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.subcategory-card.featured .subcategory-image {
    height: 250px;
}

.subcategory-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.subcategory-card:hover .subcategory-image img {
    transform: scale(1.05);
}

.subcategory-image .placeholder {
    color: #6c757d;
    font-size: 18px;
    text-align: center;
}

.subcategory-content {
    padding: 25px;
}

.subcategory-count {
    display: inline-block;
    background: #fa441d;
    color: white;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 15px;
}

.subcategory-content h3 {
    font-size: 22px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.subcategory-content h3 a {
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.3s ease;
}

.subcategory-content h3 a:hover {
    color: #fa441d;
}

.subcategory-content p {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.subcategory-button {
    display: inline-block;
    background: #fa441d;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.subcategory-button:hover {
    background: #e63612;
    color: white;
    transform: translateY(-2px);
    text-decoration: none;
}

.popular-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #ffd700;
    color: #333;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 15px;
    margin: 20px 0;
}

.empty-state i {
    color: #fa441d;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #2c3e50;
    margin-bottom: 15px;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 25px;
}

.empty-state .btn-primary {
    background: #fa441d;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.empty-state .btn-primary:hover {
    background: #e63612;
    transform: translateY(-2px);
}

.tab-content {
    min-height: 300px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .pet-type-tabs .nav-link {
        padding: 12px 20px;
        font-size: 14px;
    }
    
    .subcategory-card {
        height: 250px;
        margin-bottom: 20px;
    }
    
    .subcategory-card.featured {
        height: 300px;
    }
    
    .subcategory-content {
        padding: 20px;
    }
    
    .subcategory-content h3 {
        font-size: 20px;
    }
}

@media (max-width: 768px) {
    .pet-type-tabs .nav-tabs {
        flex-direction: column;
        padding: 5px;
    }
    
    .pet-type-tabs .nav-link {
        margin: 5px 0;
        justify-content: center;
    }
    
    .subcategory-card {
        height: 200px;
    }
    
    .subcategory-card.featured {
        height: 250px;
    }
    
    .subcategory-content h3 {
        font-size: 18px;
    }
    
    .subcategory-content p {
        font-size: 13px;
    }
}
</style>
@endsection

@section('content')
<section class="hero-section" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/background.png') }})">
    <div class="container">
        <div class="row hero-one-slider owl-carousel owl-theme">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="hero-text">
                            <h1>Take a Good Care of Pets</h1>
                            <h3>We are your local dog home boarding service giving you complete</h3>
                            <a href="contact.html" class="button">Get Appointment</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="hero-img">
                            <img src="{{ asset('assets/img/hero-img-1.png') }}" alt="img">
                            <img src="{{ asset('assets/img/hero-shaps.png') }}" alt="hero-shaps" class="img-1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="hero-text">
                            <h1>Healthy Pets, Happy People</h1>
                            <h3>We are your local dog home boarding service giving you complete</h3>
                            <a href="contact.html" class="button">Get Appointment</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="hero-img">
                            <img src="{{ asset('assets/img/slide-3.png') }}" alt="img">
                            <img src="{{ asset('assets/img/hero-shaps.png') }}" alt="hero-shaps" class="img-1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="hero-text">
                            <h1>Take a Good Care of Pets</h1>
                            <h3>We are your local dog home boarding service giving you complete</h3>
                            <a href="contact.html" class="button">Get Appointment</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="hero-img">
                            <img src="{{ asset('assets/img/slide-2.png') }}" alt="img">
                            <img src="{{ asset('assets/img/hero-shaps.png') }}" alt="hero-shaps" class="img-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-2">
    <img src="{{ asset('assets/img/dabal-foot-1.png') }}" alt="hero-shaps" class="img-3">
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-4">
</section> 

<section class="gap no-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="welcome-to">
                    <h2>Welcome to The Pet Care Company</h2>
                    <p>Lorem ipsum dolor sit amet,consectetur adipiscing elit do eiusmod tempor incididunt ut labore et.Lorem ipsumsit amet, consectetur adipiscing elit, sed do eiusmod teincididunt ut laamet,consectetur adipiscing elibore et.</p>
                    <div class="row mt-lg-5">
                        <div class="col-md-6">
                            <div class="pet-grooming">
                            <i><img src="{{ asset('assets/img/welcome-to-1.png') }}" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                            </svg>
                            <a href="#"><h4>Pet Grooming</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pet-grooming mb-0">
                            <i><img src="{{ asset('assets/img/welcome-to-2.png') }}" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                            </svg>
                            <a href="#"><h4>Dog Walking</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dog-walker two d-block">
                    <img src="{{ asset('assets/img/puppies.png') }}" class="puppies" alt="puppies">
                    <img src="{{ asset('assets/img/dog-walker-1.png') }}" class="w-100" alt="dog walker">
                    <img src="{{ asset('assets/img/line.png') }}" class="line" alt="line">
                    <img src="{{ asset('assets/img/dabal-foot.png') }}" class="dabal-foot" alt="dabal-foot">
                    <img src="{{ asset('assets/img/haddi.png') }}" class="haddi" alt="haddi">
                </div>
            </div>
        </div>
    </div>
</section> 
<section class="gap">
    <div class="container">
        <div class="heading">
            <img src="{{ asset('assets/img/heading-img.png') }}" alt="heading-img">
            <h6>Find Products By Main Category</h6>
            <h2>Browse By Categories</h2>
        </div>
        <div class="row slider-categorie owl-carousel owl-theme">
            @forelse($categories as $category)
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <div class="category-image-wrapper">
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" onerror="this.src='{{ asset('assets/img/food-categorie-' . (($loop->index % 5) + 1) . '.png') }}'">
                        @else
                            <img src="{{ asset('assets/img/food-categorie-' . (($loop->index % 5) + 1) . '.png') }}" alt="{{ $category->name }}">
                        @endif
                    </div>
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    <div class="category-product-count">
                        <small class="text-muted">{{ $category->products_count ?? 0 }} products</small>
                    </div>
                </div>
            </div>
            @empty
            <!-- Fallback static categories if no dynamic data -->
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <div class="category-image-wrapper">
                        <img src="{{ asset('assets/img/food-categorie-1.png') }}" alt="food-categorie">
                    </div>
                    <a href="{{ route('products.index') }}">Pet Supplies</a>
                    <div class="category-product-count">
                        <small class="text-muted">Available products</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <div class="category-image-wrapper">
                        <img src="{{ asset('assets/img/food-categorie-2.png') }}" alt="food-categorie">
                    </div>
                    <a href="{{ route('products.index') }}">Dog Supplies</a>
                    <div class="category-product-count">
                        <small class="text-muted">Available products</small>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Pet Types & Subcategories Section -->
<section class="gap pet-types-section">
    <div class="container">
        <div class="heading">
            <img src="{{ asset('assets/img/heading-img.png') }}" alt="heading-img">
            <h6>Shop By Pet Type</h6>
            <h2>Explore Subcategories by Pet Type</h2>
        </div>
        
        @if($petTypes->count() > 0)
        <!-- Pet Type Tabs Navigation -->
        <div class="pet-type-tabs">
            <ul class="nav nav-tabs justify-content-center mb-5" id="petTypeTab" role="tablist">
                @foreach($petTypes as $petType)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ strtolower(str_replace(' ', '-', $petType->name)) }}-tab" 
                            data-bs-toggle="tab" data-bs-target="#{{ strtolower(str_replace(' ', '-', $petType->name)) }}" 
                            type="button" role="tab" aria-controls="{{ strtolower(str_replace(' ', '-', $petType->name)) }}" 
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        @if($petType->image)
                            <img src="{{ asset($petType->image) }}" alt="{{ $petType->name }}" class="pet-icon">
                        @endif
                        {{ $petType->name }}
                        <span class="product-count">({{ $petType->products_count }} products)</span>
                    </button>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Pet Type Tab Content -->
        <div class="tab-content" id="petTypeTabContent">
            @foreach($petTypes as $petType)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ strtolower(str_replace(' ', '-', $petType->name)) }}" 
                 role="tabpanel" aria-labelledby="{{ strtolower(str_replace(' ', '-', $petType->name)) }}-tab">
                <div class="subcategory-grid">
                    @if($petType->children->count() > 0)
                    <div class="row">
                        @foreach($petType->children as $subcategory)
                        <div class="col-lg-{{ $subcategory->products_count > 50 ? '6' : '4' }} col-md-6 mb-4">
                            <div class="subcategory-card {{ $subcategory->products_count > 50 ? 'featured' : '' }}">
                                <div class="subcategory-image">
                                    @if($subcategory->image)
                                        <img src="{{ asset($subcategory->image) }}" alt="{{ $subcategory->name }}">
                                    @else
                                        <div class="placeholder">
                                            <i class="fas fa-image fa-3x mb-2 d-block"></i>
                                            {{ $subcategory->name }}
                                        </div>
                                    @endif
                                    @if($subcategory->products_count > 50)
                                        <div class="popular-badge">Most Popular</div>
                                    @endif
                                </div>
                                <div class="subcategory-content">
                                    <span class="subcategory-count">
                                        <i class="fas fa-box"></i> {{ $subcategory->products_count }} Products
                                    </span>
                                    <h3>
                                        <a href="{{ route('products.index', ['category' => $petType->slug, 'subcategory' => $subcategory->slug]) }}">
                                            {{ $subcategory->name }}
                                        </a>
                                    </h3>
                                    @if($subcategory->description)
                                        <p>{{ strlen($subcategory->description) > 100 ? substr($subcategory->description, 0, 100) . '...' : $subcategory->description }}</p>
                                    @endif
                                    <a href="{{ route('products.index', ['category' => $petType->slug, 'subcategory' => $subcategory->slug]) }}" 
                                       class="subcategory-button">
                                        Shop Now <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-paw fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No subcategories available</h4>
                            <p class="text-muted">Subcategories for {{ $petType->name }} will be added soon.</p>
                            <a href="{{ route('products.index', ['category' => $petType->slug]) }}" class="btn btn-primary">
                                View All {{ $petType->name }} Products
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Fallback if no pet types available -->
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Pet categories coming soon</h4>
                <p class="text-muted">We're setting up our pet product categories. Check back soon!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">View All Products</a>
            </div>
        </div>
        @endif
    </div>
</section>

<section class="gap section-healthy-product" style="background-image: url({{ asset('assets/img/healthy-product.png') }}); background-color: #f5f5f5;">
    <div class="container">
        <div class="heading">
            <img src="{{ asset('assets/img/heading-img.png') }}" alt="heading-img">
            <h6>Find Healthy Product</h6>
            <h2>Healthy Products</h2>
        </div>
        <div class="row">
            @foreach($healthyProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="healthy-product">
                    <div class="healthy-product-img">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/food-1.png') }}" alt="{{ $product->name }}">
                        <ul class="star">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $product->rating)
                                    <li><i class="fa-solid fa-star"></i></li>
                                @else
                                    <li><i class="fa-regular fa-star"></i></li>
                                @endif
                            @endfor
                        </ul>
                        <div class="add-to-cart">
                          <a href="#" class="add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</a>
                          <a href="#" class="wishlist-toggle-btn" data-product-id="{{ $product->id }}" title="Add to wishlist">
                            <i class="fa-regular fa-heart"></i>
                          </a>
                        </div>
                        @if($product->sale_price)
                            <h4>-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</h4>
                        @endif
                    </div>
                    <span>
                        @if($product->category && $product->subcategory)
                            {{ $product->category->name }} > {{ $product->subcategory->name }}
                        @elseif($product->category)
                            {{ $product->category->name }}
                        @else
                            Animal Feed
                        @endif
                    </span>
                    @if($product->brand)
                        <div class="product-brand">
                            <i class="fas fa-tag"></i> {{ $product->brand->name }}
                        </div>
                    @endif
                    <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                    <h6>
                        @if($product->sale_price)
                            <del>₹{{ number_format($product->price, 2) }}</del>₹{{ number_format($product->sale_price, 2) }}
                        @else
                            ₹{{ number_format($product->price, 2) }}
                        @endif
                    </h6>
                </div>
            </div>
            @endforeach
            <div class="col-lg-9">
                @if($dealOfWeek)
                <div class="deal-of-the-week">
                    <div class="healthy-product-img">
                        <h6 style="background-color: chocolate;">Deal of the Week</h6>
                        <img src="{{ $dealOfWeek->image ? asset('storage/' . $dealOfWeek->image) : asset('assets/img/food-6.png') }}" alt="{{ $dealOfWeek->name }}">
                        <ul class="star">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $dealOfWeek->rating)
                                    <li><i class="fa-solid fa-star"></i></li>
                                @else
                                    <li><i class="fa-regular fa-star"></i></li>
                                @endif
                            @endfor
                        </ul>
                    </div>
                    <div class="healthy-product">
                        <span>
                            @if($dealOfWeek->category && $dealOfWeek->subcategory)
                                {{ $dealOfWeek->category->name }} > {{ $dealOfWeek->subcategory->name }}
                            @elseif($dealOfWeek->category)
                                {{ $dealOfWeek->category->name }}
                            @else
                                Animal Feed
                            @endif
                        </span>
                        <a href="{{ route('product.show', $dealOfWeek->slug) }}">{{ $dealOfWeek->name }}</a>
                        <h6>
                            @if($dealOfWeek->sale_price)
                                <del>₹{{ number_format($dealOfWeek->price, 2) }}</del>₹{{ number_format($dealOfWeek->sale_price, 2) }}
                            @else
                                ₹{{ number_format($dealOfWeek->price, 2) }}
                            @endif
                        </h6>
                        @if($dealOfWeek->sale_price)
                            <h5>up to {{ round((($dealOfWeek->price - $dealOfWeek->sale_price) / $dealOfWeek->price) * 100) }}% off</h5>
                        @endif
                        <div class="add-to-cart">
                          <a href="#" class="button add-to-cart-btn" data-product-id="{{ $dealOfWeek->id }}">Add to Cart</a>
                          <a href="#" class="wishlist-toggle-btn" data-product-id="{{ $dealOfWeek->id }}" title="Add to wishlist">
                            <i class="fa-regular fa-heart"></i>
                          </a>
                        </div>
                        <div id="countdown">
                            <ul>
                              <li><span id="days"></span>days</li>
                              <li><span id="hours"></span>Hour</li>
                              <li><span id="minutes"></span>Min</li>
                              <li class="mb-0"><span id="seconds"></span>Sec</li>
                            </ul>
                           </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('products.index') }}" class="button">View More Products</a>
            </div>
        </div>
    </div>
</section> 
<section class="gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="count-text">
                    <img alt="img" src="assets/img/fun-facts-1.png">
                   <div>
                   <div class="d-flex justify-content-center">
                        <h2 class="count" data-number="100" ></h2>
                        <span>+</span>
                   </div>
                   <h3 class="text">Client Served</h3>
                   </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="count-text">
                    <img alt="img" src="assets/img/fun-facts-2.png">
                   <div>
                   <div class="d-flex justify-content-center">
                        <h2 class="count" data-number="99" ></h2>
                        <span>%</span>
                   </div>
                   <h3 class="text">Client Served</h3>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="count-text mb-sm-0">
                    <img alt="img" src="assets/img/fun-facts-3.png">
                   <div>
                   <div class="d-flex justify-content-center">
                        <h2 class="count" data-number="2" ></h2>
                        <span>k</span>
                   </div>
                   <h3 class="text">Client Served</h3>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="count-text mb-0">
                    <img alt="img" src="assets/img/fun-facts-4.png">
                   <div>
                   <div class="d-flex justify-content-center">
                        <h2 class="count" data-number="400" ></h2>
                        <span>+</span>
                   </div>
                   <h3 class="text">Client Served</h3>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>   
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Simple tab switching functionality
    $('.pet-type-tabs .nav-link').click(function(e) {
        e.preventDefault();
        
        // Remove active from all tabs and panes
        $('.pet-type-tabs .nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        
        // Add active to clicked tab
        $(this).addClass('active');
        
        // Get target pane and show it
        var target = $(this).attr('data-bs-target');
        $(target).addClass('show active');
    });
    
    // Card hover effects
    $('.subcategory-card').hover(
        function() {
            $(this).addClass('hover-effect');
        },
        function() {
            $(this).removeClass('hover-effect');
        }
    );
});
</script>
@endsection
 
