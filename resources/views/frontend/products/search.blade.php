@extends('frontend.layouts.layout')

@section('title', 'Search Results for "' . $searchTerm . '" - PetNet')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Search Results</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                        <li class="breadcrumb-item active" aria-current="page">"{{ $searchTerm }}"</li>
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

<section class="gap products-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="sidebar">
            <h3>Search Again</h3>
            <div class="boder-bar"></div>
            
            <!-- Search Form -->
            <div class="search-widget mb-4">
                <form method="post" action="{{ route('products.search') }}">
                    @csrf
                    <div class="form-group">
                        <input type="search" name="search" class="form-control" placeholder="Search products..." value="{{ $searchTerm }}" required>
                        <button type="submit" class="btn btn-primary mt-2 w-100">
                            <i class="fa fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
            
            <h3>Category</h3>
            <div class="boder-bar"></div>
            <ul class="category">
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}">
                        {{ $category->name }} <span>({{ $category->products_count }})</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
      </div>

      <div class="col-lg-9">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="search-info">
              @if($products->count() > 0)
                  <h4>Search Results for "{{ $searchTerm }}"</h4>
                  <p>Found {{ $products->total() }} product(s) matching your search.</p>
              @else
                  <h4>No Results Found</h4>
                  <p>Sorry, we couldn't find any products matching "{{ $searchTerm }}".</p>
              @endif
            </div>
          </div>
          <div class="col-lg-6">
            <div class="short-by d-flex align-items-center justify-content-end">
              <label>Sort by:</label>
              <select class="form-select" onchange="window.location.href='{{ url()->current() }}?search={{ $searchTerm }}&sort=' + this.value">
                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Latest</option>
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
              </select>
            </div>
          </div>
        </div>

        @if($products->count() > 0)
        <div class="row product-grid">
            @foreach($products as $product)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <div class="product-card">
                    <div class="product-img">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/food-1.png') }}" 
                                 alt="{{ $product->name }}" class="w-100">
                        </a>
                        @if($product->sale_price)
                            <span class="discount-badge">
                                -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                            </span>
                        @endif
                    </div>
                    <div class="product-content">
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $product->rating)
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <h4><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
                        <p class="category">{{ $product->category->name ?? 'Pet Product' }}</p>
                        <div class="price">
                            @if($product->sale_price)
                                <del>₹{{ number_format($product->price, 2) }}</del>
                                <span class="current-price">₹{{ number_format($product->sale_price, 2) }}</span>
                            @else
                                <span class="current-price">₹{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        
                        @if($product->stock_quantity > 0)
                            <div class="product-actions">
                                <button class="btn btn-primary add-to-cart-btn" data-product-id="{{ $product->id }}">
                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                </button>
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-primary">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                            </div>
                        @else
                            <div class="product-actions">
                                <button class="btn btn-secondary" disabled>
                                    <i class="fa fa-times"></i> Out of Stock
                                </button>
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-primary">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-wrapper d-flex justify-content-center mt-4">
                    {{ $products->appends(['search' => $searchTerm, 'sort' => request('sort')])->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-12">
                <div class="no-results text-center py-5">
                    <i class="fa fa-search fa-3x text-muted mb-3"></i>
                    <h3>No products found</h3>
                    <p class="text-muted">Try searching with different keywords or browse our categories.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                        <i class="fa fa-arrow-left"></i> Back to All Products
                    </a>
                </div>
            </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection

@section('styles')
<style>
.search-widget .form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px 15px;
}

.product-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-img {
    position: relative;
    overflow: hidden;
    border-radius: 10px 10px 0 0;
}

.product-img img {
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-img img {
    transform: scale(1.05);
}

.discount-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #ff4444;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: bold;
}

.product-content {
    padding: 20px;
}

.rating {
    color: #ffa500;
    margin-bottom: 10px;
}

.product-content h4 {
    margin: 10px 0;
    font-size: 18px;
}

.product-content h4 a {
    color: #333;
    text-decoration: none;
}

.product-content h4 a:hover {
    color: #fa441d;
}

.category {
    color: #666;
    font-size: 14px;
    margin-bottom: 10px;
}

.price {
    margin-bottom: 15px;
}

.price del {
    color: #999;
    margin-right: 10px;
}

.current-price {
    color: #fa441d;
    font-weight: bold;
    font-size: 18px;
}

.product-actions {
    display: flex;
    gap: 10px;
}

.product-actions .btn {
    flex: 1;
    padding: 8px 12px;
    font-size: 14px;
}

.search-info h4 {
    color: #333;
    margin-bottom: 10px;
}

.search-info p {
    color: #666;
    margin-bottom: 0;
}

.no-results {
    background: #f8f9fa;
    border-radius: 10px;
    margin: 30px 0;
}
</style>
@endsection
