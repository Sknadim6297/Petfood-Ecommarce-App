@extends('frontend.layouts.layout')

@section('title', $cookedFood->name . ' - Cooked Food Details')

@section('style')
<style>
.pd-gallery {
    padding: 20px;
}

.pd-imgs {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    list-style: none;
    padding: 0;
    flex-wrap: wrap;
}

.li-pd-imgs {
    width: 80px;
    height: 80px;
    border: 2px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.li-pd-imgs.nav-active {
    border-color: #fa441d;
}

.li-pd-imgs:hover {
    border-color: #fa441d;
}

.li-pd-imgs img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pd-main-img {
    text-align: center;
}

.pd-main-img img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    max-height: 500px;
    object-fit: contain;
}

.product-info {
    padding: 60px;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 15px 0;
}

.start i {
    color: #ffc107;
    margin-right: 3px;
}

.price del {
    color: #999;
    margin-right: 10px;
}

.price ins {
    text-decoration: none;
    color: #fa441d;
    font-weight: bold;
    font-size: 1.2em;
}

.button {
    background-color: #fa441d;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #e63612;
}

.product_meta {
    list-style: none;
    padding: 0;
    margin: 30px 0;
}

.product_meta li {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.theme-bg-clr {
    font-weight: bold;
    margin-right: 10px;
}

.information {
    margin: 40px 0;
}

.information h3 {
    margin-bottom: 15px;
    color: #333;
    font-size: 24px;
    font-weight: 600;
}

.boder-bar {
    width: 50px;
    height: 3px;
    background-color: #fa441d;
    margin-bottom: 20px;
}

.specification {
    list-style: none;
    padding: 0;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
}

.specification li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.specification li:last-child {
    border-bottom: none;
}

.specification li h6 {
    margin: 0;
    font-weight: 600;
    color: #333;
}

.quantity {
    margin: 20px 0;
}

.quantity h6 {
    margin-bottom: 10px;
    font-weight: 600;
}

.input-text {
    width: 80px;
    padding: 8px;
    border: 2px solid #ddd;
    border-radius: 5px;
    text-align: center;
}

.input-text:focus {
    border-color: #fa441d;
    outline: none;
}

.healthy-product {
    transition: transform 0.3s ease;
}

.healthy-product:hover {
    transform: translateY(-3px);
}

.healthy-product-img {
    position: relative;
    overflow: hidden;
    border-radius: 10px 10px 0 0;
}

.healthy-product-img img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.healthy-product:hover .healthy-product-img img {
    transform: scale(1.05);
}

.add-to-cart {
    position: absolute;
    bottom: 10px;
    left: 10px;
    right: 10px;
    display: flex;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.healthy-product:hover .add-to-cart {
    opacity: 1;
}

.add-to-cart a {
    flex: 1;
    background: #fa441d;
    color: white;
    padding: 8px;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    font-size: 12px;
    transition: background 0.3s ease;
}

.add-to-cart a:hover {
    background: #e63612;
}

.heart-wishlist {
    width: 40px !important;
    flex: none !important;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
    .pd-imgs {
        justify-content: center;
    }
    
    .li-pd-imgs {
        width: 60px;
        height: 60px;
    }
    
    .product-info {
        padding: 20px !important;
        margin-top: 20px;
    }
    
    .information h3 {
        font-size: 18px;
    }
    
    .specification {
        padding: 15px;
    }
    
    .specification li {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
        padding: 8px 0;
    }
    
    .specification li h6 {
        font-size: 14px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 10px;
    }
    
    .button {
        width: 100%;
        padding: 15px;
        font-size: 16px;
    }
    
    .quantity-controls {
        justify-content: center;
    }
    
    .product_meta li {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .banner-text h2 {
        font-size: 24px;
    }
    
    .breadcrumb {
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .product-info {
        padding: 15px !important;
    }
    
    .information h3 {
        font-size: 16px;
    }
    
    .specification {
        padding: 10px;
    }
    
    .price ins {
        font-size: 1.1em;
    }
    
    .pd-main-img img {
        max-height: 300px;
    }
    
    .banner-text h2 {
        font-size: 20px;
    }
    
    .healthy-product-img img {
        height: 150px;
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
                    <h2>Cooked Food Details</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="{{ route('cooked-foods.index') }}">Cooked Foods</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">{{ $cookedFood->name }}</li>
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

<!-- Product Detail -->
<section class="gap no-bottom">
  <div class="container">
    <div class="row product-info-section">
      <div class="col-lg-7 p-0">
        <div class="pd-gallery">
          <div class="pd-main-img">
            @if($cookedFood->image)
                <img id="NZoomImg" alt="{{ $cookedFood->name }}" src="{{ $cookedFood->image_url }}">
            @else
                <img id="NZoomImg" alt="{{ $cookedFood->name }}" src="{{ asset('assets/img/food-shop-1.png') }}">
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="product-info p-60">
          <div class="d-flex align-items-center">
            <div class="start d-flex align-items-center">
              @for($i = 1; $i <= 5; $i++)
                <i class="fa-solid fa-star" style="color: #ffc107;"></i>
              @endfor
            </div>
            <span class="ms-2">New Cooked Food</span>
          </div>
          <h3>{{ $cookedFood->name }}</h3>
          <form class="variations_form">
            <div class="stock">
              <span class="price">
                <ins style="text-decoration: none; color: #fa441d; font-weight: bold; font-size: 1.2em;">{{ $cookedFood->formatted_price }}</ins>
              </span>
              <h6>
                <span class="text-success">In stock</span>
              </h6>
            </div>
            
            @if($cookedFood->description)
            <div class="product-description" style="margin: 20px 0; color: #666; line-height: 1.6;">
                {{ $cookedFood->description }}
            </div>
            @endif

            <!-- Nutritional Information -->
            <div class="information" style="margin: 30px 0;">
                <h3 style="margin-bottom: 15px; color: #333; font-size: 20px;">Nutritional Information</h3>
                <div class="boder-bar" style="width: 50px; height: 3px; background-color: #fa441d; margin-bottom: 20px;"></div>
                <ul class="specification" style="list-style: none; padding: 0; background: #f8f9fa; border-radius: 8px; padding: 20px;">
                    @php
                        $nutritionData = [
                            'fish' => ['Protein' => '24%', 'Fat' => '8%', 'Moisture' => '68%'],
                            'chicken' => ['Protein' => '22%', 'Fat' => '12%', 'Moisture' => '66%'],
                            'meat' => ['Protein' => '26%', 'Fat' => '15%', 'Moisture' => '59%'],
                            'egg' => ['Protein' => '20%', 'Fat' => '10%', 'Moisture' => '70%'],
                            'other' => ['Protein' => '18%', 'Fat' => '6%', 'Moisture' => '76%']
                        ];
                        $nutrition = $nutritionData[$cookedFood->category] ?? $nutritionData['other'];
                    @endphp
                    
                    @foreach($nutrition as $nutrient => $value)
                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eee;">
                        <h6 style="margin: 0; font-weight: 600;">{{ $nutrient }}:</h6>
                        <span style="font-weight: 500;">{{ $value }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Feeding Guidelines -->
            <div class="information" style="margin: 30px 0;">
                <h3 style="margin-bottom: 15px; color: #333; font-size: 20px;">Feeding Guidelines</h3>
                <div class="boder-bar" style="width: 50px; height: 3px; background-color: #fa441d; margin-bottom: 20px;"></div>
                <ul class="specification" style="list-style: none; padding: 0; background: #f8f9fa; border-radius: 8px; padding: 20px;">
                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eee;">
                        <h6 style="margin: 0; font-weight: 600;">Small Dogs (5-15 lbs):</h6>
                        <span>1/4 to 1/2 cup daily</span>
                    </li>
                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eee;">
                        <h6 style="margin: 0; font-weight: 600;">Medium Dogs (15-35 lbs):</h6>
                        <span>1/2 to 1 cup daily</span>
                    </li>
                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0;">
                        <h6 style="margin: 0; font-weight: 600;">Large Dogs (35+ lbs):</h6>
                        <span>1 to 2 cups daily</span>
                    </li>
                </ul>
            </div>

            <div class="quantity" style="margin: 20px 0;">
              <h6 style="margin-bottom: 10px;">Quantity:</h6>
              <div class="quantity-controls" style="display: flex; align-items: center; gap: 10px;">
                <button type="button" class="quantity-btn" id="decrease-qty" style="width: 35px; height: 35px; border: 1px solid #ddd; background: white; border-radius: 3px;">-</button>
                <input type="number" class="input-text" id="quantity" value="1" min="1" max="10" style="width: 80px; padding: 8px; border: 2px solid #ddd; border-radius: 5px; text-align: center;">
                <button type="button" class="quantity-btn" id="increase-qty" style="width: 35px; height: 35px; border: 1px solid #ddd; background: white; border-radius: 3px;">+</button>
              </div>
            </div>

            <div class="action-buttons" style="display: flex; gap: 10px; margin: 20px 0;">
              <button type="button" class="button add-to-cart-btn" data-food-id="{{ $cookedFood->id }}" data-type="cooked_food" style="background-color: #fa441d; color: white; border: none; padding: 12px 30px; border-radius: 5px; cursor: pointer; flex: 1;">
                <i class="fas fa-shopping-cart"></i> Add to Cart
              </button>
              <button type="button" class="button btn-wishlist" data-food-id="{{ $cookedFood->id }}" data-type="cooked_food" style="background-color: #fff; color: #fa441d; border: 2px solid #fa441d; padding: 12px 15px; border-radius: 5px; cursor: pointer;">
                <i class="fas fa-heart"></i>
              </button>
            </div>

            <ul class="product_meta" style="list-style: none; padding: 0; margin: 30px 0;">
              <li style="margin-bottom: 10px; display: flex; align-items: center;">
                <span class="theme-bg-clr" style="font-weight: bold; margin-right: 10px;">Category:</span>
                <span style="text-transform: capitalize;">{{ $cookedFood->category_label }}</span>
              </li>
              <li style="margin-bottom: 10px; display: flex; align-items: center;">
                <span class="theme-bg-clr" style="font-weight: bold; margin-right: 10px;">Status:</span>
                <span class="badge bg-success">Available</span>
              </li>
              <li style="display: flex; align-items: center;">
                <span class="theme-bg-clr" style="font-weight: bold; margin-right: 10px;">Added:</span>
                <span>{{ $cookedFood->created_at->format('M d, Y') }}</span>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Related Foods Section -->
@if($relatedFoods->count() > 0)
<section class="gap">
    <div class="container">
        <div class="heading">
            <img src="{{ asset('assets/img/heading-img.png') }}" alt="heading-img">
            <h2>Related Cooked Foods</h2>
        </div>
        <div class="row">
            @foreach($relatedFoods as $relatedFood)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="healthy-product">
                        <div class="healthy-product-img">
                            @if($relatedFood->image)
                                <img src="{{ $relatedFood->image_url }}" alt="{{ $relatedFood->name }}">
                            @else
                                <img src="{{ asset('assets/img/food-shop-1.png') }}" alt="{{ $relatedFood->name }}">
                            @endif
                            <div class="add-to-cart">
                                <a href="{{ route('cooked-food.show', $relatedFood->slug) }}"><i class="fa-solid fa-eye"></i></a>
                                <a href="javascript:void(0);" class="heart-wishlist" data-food-id="{{ $relatedFood->id }}" data-type="cooked_food">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                                <a href="javascript:void(0);" class="add-to-cart-related" data-food-id="{{ $relatedFood->id }}" data-type="cooked_food">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                        <div class="healthy-product-text">
                            <div class="stock">
                                <span class="rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                                <span class="shopping-bag">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </span>
                            </div>
                            <h4><a href="{{ route('cooked-food.show', $relatedFood->slug) }}">{{ $relatedFood->name }}</a></h4>
                            <span class="price">
                                <ins>{{ $relatedFood->formatted_price }}</ins>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Quantity controls
    $('#increase-qty').click(function() {
        let qty = parseInt($('#quantity').val()) || 1;
        if (qty < 10) {
            $('#quantity').val(qty + 1);
        }
    });

    $('#decrease-qty').click(function() {
        let qty = parseInt($('#quantity').val()) || 1;
        if (qty > 1) {
            $('#quantity').val(qty - 1);
        }
    });

    // Add to Cart functionality
    $('.add-to-cart-btn').click(function() {
        let foodId = $(this).data('food-id');
        let type = $(this).data('type');
        let quantity = parseInt($('#quantity').val()) || 1;
        let button = $(this);
        
        // Disable button and show loading
        button.prop('disabled', true);
        button.html('<i class="fas fa-spinner fa-spin"></i> Adding to Cart...');
        
        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                item_id: foodId,
                item_type: type,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                showToast('Food added to cart successfully!', 'success');
                
                // Update cart count if element exists
                if ($('.cart-count').length) {
                    $('.cart-count').text(response.cart_count || 0);
                }
                
                // Reset button
                button.prop('disabled', false);
                button.html('<i class="fas fa-shopping-cart"></i> Add to Cart');
            },
            error: function(xhr) {
                let message = 'Failed to add to cart';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                showToast(message, 'error');
                
                // Reset button
                button.prop('disabled', false);
                button.html('<i class="fas fa-shopping-cart"></i> Add to Cart');
            }
        });
    });

    // Wishlist functionality for main product
    $('.btn-wishlist').click(function() {
        let foodId = $(this).data('food-id');
        let type = $(this).data('type');
        let button = $(this);
        
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
                    button.addClass('active');
                    showToast('Food added to wishlist!', 'success');
                } else {
                    button.removeClass('active');
                    showToast('Food removed from wishlist!', 'info');
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
                showToast(message, 'error');
            }
        });
    });

    // Wishlist functionality for related products
    $('.heart-wishlist').click(function() {
        let foodId = $(this).data('food-id');
        let type = $(this).data('type');
        let button = $(this);
        
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
                    button.find('i').removeClass('fa-regular').addClass('fa-solid');
                    showToast('Food added to wishlist!', 'success');
                } else {
                    button.find('i').removeClass('fa-solid').addClass('fa-regular');
                    showToast('Food removed from wishlist!', 'info');
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
                showToast(message, 'error');
            }
        });
    });

    // Add to Cart functionality for related products
    $('.add-to-cart-related').click(function() {
        let foodId = $(this).data('food-id');
        let type = $(this).data('type');
        let button = $(this);
        
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
                showToast('Food added to cart successfully!', 'success');
                
                // Update cart count if element exists
                if ($('.cart-count').length) {
                    $('.cart-count').text(response.cart_count || 0);
                }
            },
            error: function(xhr) {
                let message = 'Failed to add to cart';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                showToast(message, 'error');
            }
        });
    });

    // Toast notification function
    function showToast(message, type = 'success') {
        // Create toast element
        const toast = $(`
            <div class="toast align-items-center text-white bg-${type === 'success' ? 'success' : (type === 'error' ? 'danger' : 'info')} border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `);
        
        // Add to toast container (create if doesn't exist)
        if (!$('#toast-container').length) {
            $('body').append('<div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;"></div>');
        }
        
        $('#toast-container').append(toast);
        
        // Initialize and show toast
        const bsToast = new bootstrap.Toast(toast[0]);
        bsToast.show();
        
        // Remove from DOM after hidden
        toast.on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }
});
</script>
@endpush
