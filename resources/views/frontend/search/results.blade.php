@extends('frontend.layouts.layout')

@section('title', 'Search Results for "' . $searchTerm . '"')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Search Results</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Search: "{{ $searchTerm }}"</li>
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
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-3">
</section>

<section class="gap">
    <div class="container">
        <div class="search-results-header mb-4">
            <h3>Search Results for "{{ $searchTerm }}"</h3>
            <p class="text-muted">Found {{ $totalResults }} result(s)</p>
        </div>

        @if($totalResults > 0)
            <!-- Products Section -->
            @if($products->count() > 0)
                <div class="search-section mb-5">
                    <div class="section-header d-flex align-items-center mb-4">
                        <h4 class="mb-0">Products ({{ $products->total() }})</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm ms-3">View All Products</a>
                    </div>
                    
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="healthy-product">
                                    <div class="healthy-product-img">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('assets/img/food-shop-1.png') }}" alt="{{ $product->name }}">
                                        @endif
                                        <div class="add-to-cart">
                                            <a href="{{ route('product.show', $product->slug) }}"><i class="fa-solid fa-eye"></i></a>
                                            <a href="javascript:void(0);" class="wishlist-toggle-btn" data-item-id="{{ $product->id }}" data-item-type="product">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="add-to-cart-btn" data-item-id="{{ $product->id }}" data-item-type="product">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </a>
                                        </div>
                                        @if($product->is_on_sale)
                                            <h4>-{{ $product->discount_percentage ?? '10' }}%</h4>
                                        @endif
                                    </div>
                                    <div class="healthy-product-text">
                                        <div class="stock">
                                            <span class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= ($product->rating ?? 4) ? '' : 'text-muted' }}"></i>
                                                @endfor
                                            </span>
                                            <span class="shopping-bag">
                                                <i class="fa-solid fa-bag-shopping"></i>
                                            </span>
                                        </div>
                                        <span>{{ $product->category->name ?? 'Pet Product' }}</span>
                                        @if($product->brand)
                                            <div class="product-brand">
                                                <i class="fas fa-tag"></i> {{ $product->brand->name }}
                                            </div>
                                        @endif
                                        <h4><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
                                        <span class="price">
                                            @if($product->is_on_sale)
                                                <del>₹{{ number_format($product->price, 2) }}</del>
                                                <ins>₹{{ number_format($product->sale_price, 2) }}</ins>
                                            @else
                                                <ins>₹{{ number_format($product->price, 2) }}</ins>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Products Pagination -->
                    <div class="pagination-wrapper mt-4">
                        {{ $products->appends(['search' => $searchTerm])->links() }}
                    </div>
                </div>
            @endif

            <!-- Cooked Foods Section -->
            @if($cookedFoods->count() > 0)
                <div class="search-section">
                    <div class="section-header d-flex align-items-center mb-4">
                        <h4 class="mb-0">Cooked Foods ({{ $cookedFoods->total() }})</h4>
                        <a href="{{ route('cooked-foods.index') }}" class="btn btn-outline-primary btn-sm ms-3">View All Cooked Foods</a>
                    </div>
                    
                    <div class="row">
                        @foreach($cookedFoods as $cookedFood)
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="healthy-product">
                                    <div class="healthy-product-img">
                                        @if($cookedFood->image)
                                            <img src="{{ $cookedFood->image_url }}" alt="{{ $cookedFood->name }}">
                                        @else
                                            <img src="{{ asset('assets/img/food-shop-1.png') }}" alt="{{ $cookedFood->name }}">
                                        @endif
                                        <div class="add-to-cart">
                                            <a href="{{ route('cooked-food.show', $cookedFood->slug) }}"><i class="fa-solid fa-eye"></i></a>
                                            <a href="javascript:void(0);" class="wishlist-toggle-btn" data-item-id="{{ $cookedFood->id }}" data-item-type="cooked_food">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="add-to-cart-btn" data-item-id="{{ $cookedFood->id }}" data-item-type="cooked_food">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="healthy-product-text">
                                        <div class="stock">
                                            <span class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star"></i>
                                                @endfor
                                            </span>
                                            <span class="shopping-bag">
                                                <i class="fa-solid fa-bag-shopping"></i>
                                            </span>
                                        </div>
                                        <span>{{ ucfirst($cookedFood->category) }}</span>
                                        <h4><a href="{{ route('cooked-food.show', $cookedFood->slug) }}">{{ $cookedFood->name }}</a></h4>
                                        <span class="price">
                                            <ins>{{ $cookedFood->formatted_price }}</ins>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Cooked Foods Pagination -->
                    <div class="pagination-wrapper mt-4">
                        {{ $cookedFoods->appends(['search' => $searchTerm])->links() }}
                    </div>
                </div>
            @endif
        @else
            <!-- No Results -->
            <div class="no-results text-center py-5">
                <div class="empty-state">
                    <i class="fas fa-search fa-4x text-muted mb-3"></i>
                    <h4>No results found</h4>
                    <p class="text-muted">We couldn't find any products or cooked foods matching "{{ $searchTerm }}"</p>
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-primary me-2">Browse Products</a>
                        <a href="{{ route('cooked-foods.index') }}" class="btn btn-outline-primary">Browse Cooked Foods</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@section('styles')
<style>
.search-results-header h3 {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 10px;
}

.section-header h4 {
    color: #4a5568;
    font-weight: 600;
}

.search-section {
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 2rem;
}

.search-section:last-child {
    border-bottom: none;
}

.empty-state {
    padding: 3rem 1rem;
    background: #f8f9fa;
    border-radius: 15px;
    max-width: 500px;
    margin: 0 auto;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
}

@media (max-width: 768px) {
    .section-header {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 10px;
    }
    
    .section-header .btn {
        margin-left: 0 !important;
    }
}
</style>
@endsection
