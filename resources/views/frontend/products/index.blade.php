@extends('frontend.layouts.layout')

@section('title', 'Our Products - PetNet')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Our Products</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                        <li class="breadcrumb-item active" aria-current="page">shop</li>
                        <li class="breadcrumb-item active" aria-current="page">Our Products</li>
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
              @forelse($categories as $category)
              <li>
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                   class="{{ request('category') == $category->slug ? 'active' : '' }}">
                   {{ $category->name }}
                   <span>{{ $category->products_count }}</span>
                </a>
              </li>
              @empty
              <li>
                <a href="#">No categories available<span>0</span></a>
              </li>
              @endforelse
              @if(request('category'))
              <li>
                <a href="{{ route('products.index') }}" class="text-primary">
                  <i class="fas fa-arrow-left me-1"></i>All Products
                </a>
              </li>
              @endif
            </ul>
        </div>
        
        <div class="sidebar">
            <h3>Price range</h3>
            <div class="boder-bar"></div>
            <div class="wrapper">
              <form method="GET" action="{{ route('products.index') }}">
                @if(request('category'))
                  <input type="hidden" name="category" value="{{ request('category') }}">
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
        

      </div>
      
      <div class="col-lg-9">
        <div class="items-number">
          <span>Items {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() ?? 0 }}</span>
          <div class="d-flex align-items-center sort-section">
            <label for="sort-select" class="me-2">Sort By:</label>
            <form method="GET" action="{{ route('products.index') }}" class="d-inline">
              @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
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
                <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
              </select>
            </form>
          </div>
        </div>
        
        <div class="row">
          @forelse($products as $product)
            <div class="col-md-4 col-sm-6">
                <div class="healthy-product">
                    <div class="healthy-product-img">
                        @if($product->image)
                          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                          <img src="{{ asset('assets/img/food-1.png') }}" alt="{{ $product->name }}">
                        @endif
                        
                        <ul class="star">
                          @for($i = 1; $i <= 5; $i++)
                            <li><i class="fa-solid fa-star {{ $i <= $product->rating ? '' : 'text-muted' }}"></i></li>
                          @endfor
                        </ul>
                        
                        <div class="add-to-cart">
                          <a href="#" class="add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</a>
                          <a href="#" class="wishlist-toggle-btn" data-product-id="{{ $product->id }}">
                            <i class="fa-regular fa-heart"></i>
                          </a>
                        </div>
                        
                        @if($product->is_on_sale)
                          <h4>-{{ $product->discount_percentage }}%</h4>
                        @endif
                        
                        @if($product->stock_quantity <= 0)
                          <div class="out-of-stock">Out of Stock</div>
                        @endif
                    </div>
                    
                    <span>{{ $product->category->name ?? 'Uncategorized' }}</span>
                    <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                    
                    @if($product->is_on_sale)
                      <h6><del>₹{{ number_format($product->price, 2) }}</del>₹{{ number_format($product->sale_price, 2) }}</h6>
                    @else
                      <h6>₹{{ number_format($product->price, 2) }}</h6>
                    @endif
                </div>
            </div>
          @empty
            <div class="col-12">
              <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4>No products found</h4>
                <p class="text-muted">Try adjusting your filters or browse all categories.</p>
                <a href="{{ route('products.index') }}" class="button">View All Products</a>
              </div>
            </div>
          @endforelse
        </div>
        
        @if($products->hasPages())
        <div class="pagination-wrapper mt-4">
          {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
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

.out-of-stock {
  position: absolute;
  top: 10px;
  left: 10px;
  background-color: #dc3545;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
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

.sort-dropdown:focus {
  border-color: var(--primary-color, #fa441d);
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(250, 68, 29, 0.25);
}

.items-number {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  padding: 15px;
  background: #f8f9fa;
  border-radius: 8px;
  border: 1px solid #e9ecef;
}
.sidebar {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  margin-bottom: 20px;
}

.sidebar h3 {
  margin-bottom: 15px;
  color: #333;
  font-size: 18px;
  font-weight: 600;
}
</style>

<script>
// Enhanced Price range functionality
document.addEventListener('DOMContentLoaded', function() {
  const lowerRange = document.getElementById('lower');
  const upperRange = document.getElementById('upper');
  const minPriceInput = document.getElementById('one');
  const maxPriceInput = document.getElementById('two');

  if (lowerRange && upperRange && minPriceInput && maxPriceInput) {
    
    // Function to update the visual range bar
    function updateRangeVisual() {
      const min = parseInt(lowerRange.min);
      const max = parseInt(lowerRange.max);
      const lowerVal = parseInt(lowerRange.value);
      const upperVal = parseInt(upperRange.value);
      
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
    
    // Ensure lower range doesn't exceed upper range
    function validateRanges() {
      const lowerVal = parseInt(lowerRange.value);
      const upperVal = parseInt(upperRange.value);
      
      if (lowerVal >= upperVal) {
        lowerRange.value = upperVal - 1;
        minPriceInput.value = upperVal - 1;
      }
      
      if (upperVal <= lowerVal) {
        upperRange.value = lowerVal + 1;
        maxPriceInput.value = lowerVal + 1;
      }
    }
    
    // Lower range input event
    lowerRange.addEventListener('input', function() {
      validateRanges();
      minPriceInput.value = this.value;
      updateRangeVisual();
    });

    // Upper range input event
    upperRange.addEventListener('input', function() {
      validateRanges();
      maxPriceInput.value = this.value;
      updateRangeVisual();
    });

    // Min price input event
    minPriceInput.addEventListener('input', function() {
      const value = parseInt(this.value) || 0;
      lowerRange.value = Math.max(0, Math.min(value, parseInt(upperRange.value) - 1));
      validateRanges();
      updateRangeVisual();
    });

    // Max price input event
    maxPriceInput.addEventListener('input', function() {
      const value = parseInt(this.value) || 1000;
      upperRange.value = Math.min(1000, Math.max(value, parseInt(lowerRange.value) + 1));
      validateRanges();
      updateRangeVisual();
    });
    
    // Initialize visual range
    updateRangeVisual();
  }
});

// Add to cart functionality (placeholder)
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('add-to-cart-btn')) {
    e.preventDefault();
    const productId = e.target.getAttribute('data-product-id');
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
@endsection
