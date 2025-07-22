@extends('frontend.layouts.layout')

@section('title', 'My Wishlist - PetNet')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>My Wishlist</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                        <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
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

<section class="gap wishlist-section">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div id="wishlist-content">
            @if($wishlistItems->count() > 0)
                <div class="wishlist-items">
                    <div class="row">
                        @foreach($wishlistItems as $item)
                            @php
                                $itemData = $item->item_type === 'cooked_food' ? $item->cookedFood : $item->product;
                                $itemId = $itemData ? $itemData->id : 0;
                                $itemType = $item->item_type ?? 'product';
                                $itemPrice = $itemData ? ($itemType === 'cooked_food' ? $itemData->price : $itemData->effective_price) : 0;
                                $itemImage = $itemData && $itemData->image ? $itemData->image : null;
                                $itemName = $itemData ? $itemData->name : 'Unknown Item';
                                $itemSlug = $itemData ? $itemData->slug : '#';
                                $showRoute = $itemType === 'cooked_food' ? 'cooked-food.show' : 'product.show';
                            @endphp
                            
                            @if($itemData)
                            <div class="col-md-4 col-sm-6 mb-4" id="wishlist-item-{{ $itemType }}-{{ $itemId }}">
                                <div class="healthy-product">
                                    <div class="healthy-product-img">
                                        @if($itemImage)
                                          <img src="{{ $itemType === 'cooked_food' ? $itemData->image_url : asset('storage/' . $itemImage) }}" alt="{{ $itemName }}">
                                        @else
                                          <img src="{{ asset('assets/img/food-1.png') }}" alt="{{ $itemName }}">
                                        @endif
                                        
                                        <ul class="star">
                                          @for($i = 1; $i <= 5; $i++)
                                            <li><i class="fa-solid fa-star {{ $i <= 4 ? '' : 'text-muted' }}"></i></li>
                                          @endfor
                                        </ul>
                                        
                                        <div class="add-to-cart">
                                          <a href="#" class="add-to-cart-btn" data-item-id="{{ $itemId }}" data-item-type="{{ $itemType }}">Add to Cart</a>
                                          <a href="#" class="wishlist-toggle-btn active" data-item-id="{{ $itemId }}" data-item-type="{{ $itemType }}" title="Remove from wishlist">
                                            <i class="fa-solid fa-heart"></i>
                                          </a>
                                        </div>
                                        
                                        @if($itemType === 'product' && $itemData->is_on_sale)
                                          <h4>-{{ $itemData->discount_percentage ?? '10' }}%</h4>
                                        @endif
                                    </div>
                                    
                                    <span>{{ $itemType === 'cooked_food' ? ucfirst($itemData->category) : ($itemData->category->name ?? 'Uncategorized') }}</span>
                                    <a href="{{ route($showRoute, $itemSlug) }}">{{ $itemName }}</a>
                                    
                                    @if($itemType === 'product' && $itemData->is_on_sale)
                                      <h6><del>₹{{ number_format($itemData->original_price ?? $itemData->price * 1.2, 2) }}</del>₹{{ number_format($itemPrice, 2) }}</h6>
                                    @else
                                      <h6>₹{{ number_format($itemPrice, 2) }}</h6>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <!-- Clear wishlist button -->
                    <div class="text-center mt-4">
                        <button class="btn btn-danger" onclick="clearWishlist()" id="clear-wishlist-btn">
                            <i class="fas fa-trash me-2"></i>Clear Wishlist
                        </button>
                    </div>
                </div>
            @else
                <div class="empty-wishlist text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="fas fa-heart fa-4x" style="color: #fa441d; opacity: 0.3;"></i>
                    </div>
                    <h3 class="mb-3" style="color: #2c3e50;">Your wishlist is empty</h3>
                    <p class="text-muted mb-4">Start browsing our products and add your favorites to your wishlist!</p>
                    <a href="{{ route('products.index') }}" class="button">
                        <i class="fas fa-shopping-bag me-2"></i>Browse Products
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
/* Wishlist specific styles */
.wishlist-section {
    background-color: #f8f9fa;
}

.empty-wishlist {
    background: white;
    border-radius: 15px;
    padding: 4rem 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Style the wishlist heart button to match the theme */
.add-to-cart .wishlist-toggle-btn.active i {
    color: #e74c3c !important;
}

.add-to-cart .wishlist-toggle-btn:hover i {
    color: #e74c3c !important;
}

/* Clear wishlist button styling */
.btn-danger {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    border: none;
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .empty-wishlist {
        padding: 2rem 1rem;
    }
    
    .empty-wishlist h3 {
        font-size: 1.5rem;
    }
}
</style>
@endsection

@section('script')
<script>
// All cart and wishlist functionality is now handled by cart-wishlist.js
// No duplicate functions needed here
console.log('Wishlist page loaded - using universal cart-wishlist.js');
</script>
@endsection
