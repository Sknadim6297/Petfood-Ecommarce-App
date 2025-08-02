@extends('frontend.layouts.layout')

@section('title', 'Cooked Foods - Fresh & Delicious Pet Foods')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Cooked Foods</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                        <li class="breadcrumb-item active" aria-current="page">shop</li>
                        <li class="breadcrumb-item active" aria-current="page">Cooked Foods</li>
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
            <h3>Category</h3>
            <div class="boder-bar"></div>
            <ul class="category">
              <li>
                <a href="{{ route('cooked-foods.index') }}" class="{{ !request('category') ? 'active' : '' }}">
                  All Categories
                  <span>{{ array_sum($categoryCounts) }}</span>
                </a>
              </li>
              @foreach($categories as $category)
              <li>
                <a href="{{ route('cooked-foods.index', ['category' => $category]) }}" 
                   class="{{ request('category') == $category ? 'active' : '' }}">
                   {{ ucfirst($category) }}
                   <span>{{ $categoryCounts[$category] ?? 0 }}</span>
                </a>
              </li>
              @endforeach
              @if(request('category'))
              <li>
                <a href="{{ route('cooked-foods.index') }}" class="text-primary">
                  <i class="fas fa-arrow-left me-1"></i>All Cooked Foods
                </a>
              </li>
              @endif
            </ul>
        </div>
        
        <div class="sidebar">
            <h3>Price range</h3>
            <div class="boder-bar"></div>
            <div class="wrapper">
              <form method="GET" action="{{ route('cooked-foods.index') }}">
                @if(request('category'))
                  <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('search'))
                  <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <fieldset class="filter-price">
                 <div class="price-wrap">
                    <span class="price-title">Price</span>
                    <div class="price-wrap-1">
                      <input id="one" name="min_price" value="{{ request('min_price', 0) }}">
                      <label for="one">₹</label>
                    </div>
                    <div class="price-wrap_line">-</div>
                    <div class="price-wrap-2">
                      <input id="two" name="max_price" value="{{ request('max_price', 1000) }}">
                      <label for="two">₹</label>
                    </div>
                  </div>
                  <div class="price-field">
                    <input type="range" min="0" max="1000" value="{{ request('min_price', 0) }}" id="lower" name="min_range">
                    <input type="range" min="0" max="1000" value="{{ request('max_price', 1000) }}" id="upper" name="max_range">
                  </div>
                  <button type="submit" class="w-100 button">Filter</button>
                </fieldset>
              </form>
            </div>
        </div>
        
        <!-- Search Box -->
        <div class="sidebar">
            <h3>Search Foods</h3>
            <div class="boder-bar"></div>
            <form method="GET" action="{{ route('cooked-foods.index') }}">
                @if(request('category'))
                  <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('min_price'))
                  <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                @endif
                @if(request('max_price'))
                  <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                @endif
                <div class="search-box">
                    <input type="text" name="search" placeholder="Search cooked foods..." 
                           value="{{ request('search') }}" class="form-control mb-2">
                    <button type="submit" class="button w-100">Search</button>
                </div>
            </form>
        </div>

      </div>
      
      <div class="col-lg-9">
        <div class="items-number">
          <span>Items {{ $cookedFoods->firstItem() ?? 0 }}-{{ $cookedFoods->lastItem() ?? 0 }} of {{ $cookedFoods->total() ?? 0 }}</span>
          <div class="d-flex align-items-center sort-section">
            <label for="sort-select" class="me-2">Sort By:</label>
            <form method="GET" action="{{ route('cooked-foods.index') }}" class="d-inline">
              @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
              @endif
              @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
              @endif
              @if(request('min_price'))
                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
              @endif
              @if(request('max_price'))
                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
              @endif
              <select name="sort" id="sort-select" class="form-select sort-dropdown" onchange="this.form.submit()">
                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Recently Added</option>
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low to High</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High to Low</option>
              </select>
            </form>
          </div>
        </div>
        
        <div class="row">
          @forelse($cookedFoods as $food)
            <div class="col-md-4 col-sm-6">
                <div class="healthy-product">
                    <div class="healthy-product-img">
                        @if($food->image)
                          <img src="{{ $food->image_url }}" alt="{{ $food->name }}">
                        @else
                          <img src="{{ asset('assets/img/food-1.png') }}" alt="{{ $food->name }}">
                        @endif
                        
                        <ul class="star">
                          @for($i = 1; $i <= 5; $i++)
                            <li><i class="fa-solid fa-star"></i></li>
                          @endfor
                        </ul>
                        
                        <div class="add-to-cart">
                          <a href="#" class="add-to-cart-btn" data-food-id="{{ $food->id }}" data-type="cooked_food">Add to Cart</a>
                          <a href="#" class="wishlist-toggle-btn" data-food-id="{{ $food->id }}" data-type="cooked_food">
                            <i class="fa-regular fa-heart"></i>
                          </a>
                        </div>
                        
                        <!-- Category Badge -->
                        <div class="category-badge-corner">
                            @switch($food->category)
                                @case('fish') 🐟 @break
                                @case('chicken') 🐔 @break
                                @case('meat') 🥩 @break
                                @case('egg') 🥚 @break
                                @default 📦
                            @endswitch
                        </div>
                    </div>
                    
                    <span>{{ ucfirst($food->category) }}</span>
                    <a href="{{ route('cooked-food.show', $food->slug) }}">{{ $food->name }}</a>
                    <h6>{{ $food->formatted_price }}</h6>
                </div>
            </div>
          @empty
            <div class="col-12">
              <div class="text-center py-5">
                <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                <h4>No cooked foods found</h4>
                <p class="text-muted">Try adjusting your filters or browse all categories.</p>
                <a href="{{ route('cooked-foods.index') }}" class="button">View All Cooked Foods</a>
              </div>
            </div>
          @endforelse
        </div>
        
        @if($cookedFoods->hasPages())
        <div class="pagination-wrapper mt-4">
          {{ $cookedFoods->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

<style>
.category li a.active {
  background-color: var(--primary-color, #fa441d);
  color: white;
  border-radius: 5px;
  padding: 5px 10px;
}

.category-badge-corner {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(250, 68, 29, 0.9);
    color: white;
    padding: 5px 8px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: bold;
}

.healthy-product-img {
  position: relative;
}

.pagination-wrapper {
  display: flex;
  justify-content: center;
}

.pagination .page-link {
  color: var(--primary-color, #fa441d);
  border: 1px solid #dee2e6;
}

.pagination .page-item.active .page-link {
  background-color: var(--primary-color, #fa441d);
  border-color: var(--primary-color, #fa441d);
}

.sort-section {
  gap: 10px;
}

.sort-dropdown {
  min-width: 200px;
  border: 2px solid #ddd;
  border-radius: 5px;
  padding: 8px 12px;
  background-color: #fff;
  font-size: 14px;
}

.search-box {
    margin-top: 10px;
}
</style>

<style>
/* Filters Sidebar Styles */
.filters-sidebar {
    margin-bottom: 30px;
}

.filter-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(250, 68, 29, 0.1);
}

.filter-card h4 {
    color: #2d3748;
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 1.2rem;
}

.filter-divider {
    height: 3px;
    background: linear-gradient(135deg, #fa441d, #ff6b47);
    border-radius: 2px;
    margin-bottom: 25px;
}

/* Category List */
.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-list li {
    margin-bottom: 12px;
}

.category-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 15px;
    border-radius: 12px;
    text-decoration: none;
    color: #4a5568;
    transition: all 0.3s ease;
    font-weight: 500;
}

.category-link:hover, .category-link.active {
    background: linear-gradient(135deg, #fa441d, #ff6b47);
    color: white;
    transform: translateX(5px);
}

.category-icon {
    margin-right: 10px;
    font-size: 1.1rem;
}

.count-badge {
    background: rgba(255, 255, 255, 0.2);
    color: inherit;
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.category-link.active .count-badge {
    background: rgba(255, 255, 255, 0.3);
}

.reset-link {
    color: #fa441d !important;
    font-style: italic;
}

/* Price Filter */
.price-filter-form {
    margin-top: 10px;
}

.price-inputs {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.price-input-group {
    flex: 1;
}

.price-input-group label {
    display: block;
    font-size: 0.9rem;
    color: #718096;
    margin-bottom: 5px;
    font-weight: 500;
}

.price-input {
    width: 100%;
    padding: 10px 12px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.price-input:focus {
    outline: none;
    border-color: #fa441d;
    box-shadow: 0 0 0 3px rgba(250, 68, 29, 0.1);
}

.price-separator {
    font-weight: 600;
    color: #718096;
    margin-top: 20px;
}

.filter-apply-btn {
    width: 100%;
    padding: 12px 20px;
    background: linear-gradient(135deg, #fa441d, #ff6b47);
    border: none;
    border-radius: 12px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-apply-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(250, 68, 29, 0.3);
}

/* Search Form */
.search-input-group {
    position: relative;
    margin-top: 10px;
}

.search-input {
    width: 100%;
    padding: 12px 50px 12px 15px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: #fa441d;
    box-shadow: 0 0 0 3px rgba(250, 68, 29, 0.1);
}

.search-btn {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    background: #fa441d;
    border: none;
    border-radius: 8px;
    color: white;
    width: 35px;
    height: 35px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-btn:hover {
    background: #e53e26;
}

/* Results Header */
.results-header {
    background: white;
    border-radius: 15px;
    padding: 20px 25px;
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.results-count {
    color: #4a5568;
    font-weight: 500;
    font-size: 15px;
}

.sort-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sort-form label {
    color: #4a5568;
    font-weight: 500;
    margin: 0;
}

.sort-select {
    padding: 8px 12px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    min-width: 160px;
    cursor: pointer;
}

.sort-select:focus {
    outline: none;
    border-color: #fa441d;
}

/* Products Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.product-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    position: relative;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.product-image-container {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-actions {
    display: flex;
    gap: 10px;
}

.action-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: white;
    color: #fa441d;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.action-btn:hover {
    background: #fa441d;
    color: white;
    transform: scale(1.1);
}

.category-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #fa441d, #ff6b47);
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    z-index: 2;
}

.rating-stars {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 2;
}

.rating-stars i {
    color: #ffd700;
    font-size: 12px;
    margin-left: 2px;
}

.product-info {
    padding: 25px;
}

.product-category {
    color: #fa441d;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: block;
}

.product-name {
    margin-bottom: 12px;
}

.product-name a {
    color: #2d3748;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.product-name a:hover {
    color: #fa441d;
}

.product-price {
    color: #fa441d;
    font-size: 18px;
    font-weight: 700;
    font-family: 'Poppins', sans-serif;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    grid-column: 1 / -1;
}

.empty-icon {
    font-size: 4rem;
    color: #e2e8f0;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #4a5568;
    margin-bottom: 10px;
}

.empty-state p {
    color: #718096;
    margin-bottom: 25px;
}

.btn-reset {
    background: linear-gradient(135deg, #fa441d, #ff6b47);
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(250, 68, 29, 0.3);
    color: white;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .results-header {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
    }
    
    .sort-controls {
        justify-content: center;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .category-stats {
        margin-top: -30px;
        padding: 20px;
    }
    
    .stat-item {
        padding: 15px;
        margin-bottom: 15px;
    }
}

@media (max-width: 576px) {
    .cooked-foods-header h1 {
        font-size: 2.5rem;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
    }
}
</style>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Add to Cart functionality with authentication check
    $('.add-to-cart-btn').click(function(e) {
        e.preventDefault();
        
        @guest
            // If user is not authenticated, show login modal
            if (window.closeAuthModal) {
                // Use the unified authentication modal from layout
                showLoginRequiredModal('cart');
            } else {
                // Fallback if function doesn't exist
                alert('Please login to add items to cart');
                window.location.href = '{{ route("login") }}';
            }
            return false;
        @endguest
        
        let foodId = $(this).data('food-id');
        let type = $(this).data('type');
        let button = $(this);
        let originalText = button.text();
        
        // Disable button and show loading
        button.prop('disabled', true);
        button.text('Adding...');
        
        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                item_id: foodId,
                item_type: type,
                quantity: 1,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Show success message using Bootstrap toast if available, otherwise alert
                if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
                    showToast('Food added to cart successfully!', 'success');
                } else {
                    alert('Food added to cart successfully!');
                }
                
                // Update cart count if element exists
                if ($('.cart-count').length) {
                    $('.cart-count').text(response.cart_count || 0);
                }
                
                // Reset button
                button.prop('disabled', false);
                button.text(originalText);
            },
            error: function(xhr) {
                let message = 'Failed to add to cart';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                
                if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
                    showToast(message, 'error');
                } else {
                    alert(message);
                }
                
                // Reset button
                button.prop('disabled', false);
                button.text(originalText);
            }
        });
    });

    // Wishlist functionality with authentication check
    $('.wishlist-toggle-btn').click(function(e) {
        e.preventDefault();
        
        @guest
            // If user is not authenticated, show login modal
            if (window.closeAuthModal) {
                // Use the unified authentication modal from layout
                showLoginRequiredModal('wishlist');
            } else {
                // Fallback if function doesn't exist
                alert('Please login to manage wishlist');
                window.location.href = '{{ route("login") }}';
            }
            return false;
        @endguest
        
        let foodId = $(this).data('food-id');
        let type = $(this).data('type');
        let button = $(this);
        let icon = button.find('i');
        
        $.ajax({
            url: '{{ route("wishlist.toggle") }}',
            method: 'POST',
            data: {
                item_id: foodId,
                item_type: type,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.added) {
                    icon.removeClass('fa-regular').addClass('fa-solid');
                    if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
                        showToast('Food added to wishlist!', 'success');
                    } else {
                        alert('Food added to wishlist!');
                    }
                } else {
                    icon.removeClass('fa-solid').addClass('fa-regular');
                    if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
                        showToast('Food removed from wishlist!', 'info');
                    } else {
                        alert('Food removed from wishlist!');
                    }
                }
                
                // Update wishlist count if element exists
                if ($('.wishlist-count').length) {
                    $('.wishlist-count').text(response.wishlist_count || 0);
                }
            },
            error: function(xhr) {
                let message = 'Failed to update wishlist';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                
                if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
                    showToast(message, 'error');
                } else {
                    alert(message);
                }
            }
        });
    });

    // Toast notification function (if Bootstrap is available)
    function showToast(message, type = 'success') {
        // Create toast element
        const toastClass = type === 'success' ? 'bg-success' : (type === 'error' ? 'bg-danger' : 'bg-info');
        const toast = $(`
            <div class="toast align-items-center text-white ${toastClass} border-0" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1055;">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `);
        
        $('body').append(toast);
        
        // Initialize and show toast
        const bsToast = new bootstrap.Toast(toast[0]);
        bsToast.show();
        
        // Remove from DOM after hidden
        toast.on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }

    // Authentication Modal Function - Use the same modal from layout
    window.showLoginRequiredModal = function(type = 'general') {
        // Close any existing modals first
        $('.auth-required-modal, .login-prompt-modal').fadeOut(100, function() {
            $(this).remove();
        });
        
        const messages = {
            cart: {
                title: 'Login Required for Cart',
                subtitle: 'You need to be logged in to add items to your cart.',
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
        
        // Small delay to ensure proper animation
        setTimeout(() => {
            $('#authRequiredModal').fadeIn(300);
        }, 50);
    };
    
    window.closeAuthModal = function() {
        $('#authRequiredModal').fadeOut(300, function() {
            $(this).remove();
            $('body').removeClass('modal-open');
        });
    };

    // Enhanced Price range functionality
    const lower = document.getElementById('lower');
    const upper = document.getElementById('upper');
    const one = document.getElementById('one');
    const two = document.getElementById('two');

    if (lower && upper && one && two) {
        
        // Function to update the visual range bar
        function updateRangeVisual() {
            const min = parseInt(lower.min);
            const max = parseInt(lower.max);
            const lowerVal = parseInt(lower.value);
            const upperVal = parseInt(upper.value);
            
            // Calculate percentages
            const lowerPercent = ((lowerVal - min) / (max - min)) * 100;
            const upperPercent = ((upperVal - min) / (max - min)) * 100;
            
            // Update the visual track
            if (!document.querySelector('.range-track')) {
                const track = document.createElement('div');
                track.className = 'range-track';
                track.innerHTML = '<div class="range-fill"></div>';
                document.querySelector('.price-field').appendChild(track);
            }
            
            const fill = document.querySelector('.range-fill');
            if (fill) {
                fill.style.left = lowerPercent + '%';
                fill.style.width = (upperPercent - lowerPercent) + '%';
            }
        }
        
        // Ensure ranges don't overlap
        function validateRanges() {
            const lowerVal = parseInt(lower.value);
            const upperVal = parseInt(upper.value);
            
            if (lowerVal >= upperVal) {
                lower.value = upperVal - 1;
                one.value = upperVal - 1;
            }
            
            if (upperVal <= lowerVal) {
                upper.value = lowerVal + 1;
                two.value = lowerVal + 1;
            }
        }
        
        lower.oninput = function() {
            validateRanges();
            one.value = this.value;
            updateRangeVisual();
        };

        upper.oninput = function() {
            validateRanges();
            two.value = this.value;
            updateRangeVisual();
        };

        one.oninput = function() {
            const value = parseInt(this.value) || 0;
            lower.value = Math.max(0, Math.min(value, parseInt(upper.value) - 1));
            validateRanges();
            updateRangeVisual();
        };

        two.oninput = function() {
            const value = parseInt(this.value) || 1000;
            upper.value = Math.min(1000, Math.max(value, parseInt(lower.value) + 1));
            validateRanges();
            updateRangeVisual();
        };
        
        // Initialize visual range
        updateRangeVisual();
    }
});
</script>

<style>
.price-field {
  position: relative;
  height: 50px;
  margin: 15px 0;
}

.price-field input[type="range"] {
  position: absolute;
  width: 100%;
  height: 4px;
  background: none;
  pointer-events: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}

.price-field input[type="range"]::-webkit-slider-thumb {
  height: 18px;
  width: 18px;
  background: #fa441d;
  border-radius: 50%;
  border: 2px solid white;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  pointer-events: auto;
  -webkit-appearance: none;
  cursor: pointer;
}

.price-field input[type="range"]::-moz-range-thumb {
  height: 18px;
  width: 18px;
  background: #fa441d;
  border-radius: 50%;
  border: 2px solid white;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  pointer-events: auto;
  cursor: pointer;
  -moz-appearance: none;
}

.range-track {
  position: absolute;
  width: 100%;
  height: 4px;
  background: #ddd;
  border-radius: 2px;
  top: 50%;
  transform: translateY(-50%);
}

.range-fill {
  position: absolute;
  height: 100%;
  background: linear-gradient(90deg, #fa441d, #ff6b47);
  border-radius: 2px;
  transition: all 0.1s ease;
}

.price-wrap {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.price-wrap-1, .price-wrap-2 {
  position: relative;
  flex: 1;
}

.price-wrap-1 input, .price-wrap-2 input {
  width: 100%;
  padding: 8px 25px 8px 8px;
  border: 2px solid #e0e0e0;
  border-radius: 8px;
  font-size: 14px;
  background: white;
  transition: border-color 0.2s ease;
}

.price-wrap-1 input:focus, .price-wrap-2 input:focus {
  outline: none;
  border-color: #fa441d;
}

.price-wrap-1 label, .price-wrap-2 label {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  color: #666;
  font-weight: 500;
}

.price-wrap_line {
  color: #666;
  font-weight: 500;
}

.price-title {
  font-weight: 600;
  color: #333;
  margin-bottom: 15px;
  display: block;
}
</style>
@endpush
