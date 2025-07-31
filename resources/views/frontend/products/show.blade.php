@extends('frontend.layouts.layout')
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
    padding: 20px;
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

@media (max-width: 768px) {
    .pd-imgs {
        justify-content: center;
    }
    
    .li-pd-imgs {
        width: 60px;
        height: 60px;
    }
    
    .product-info {
        padding: 15px;
        margin-top: 20px;
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
          @if($product->gallery && is_array($product->gallery) && count($product->gallery) > 0)
            <ul class="pd-imgs">
                @foreach($product->gallery as $index => $image)
                <li class="li-pd-imgs {{ $index == 0 ? 'nav-active' : '' }}">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
                </li>
                @endforeach
            </ul>
          @endif
          <div class="pd-main-img">
            <img id="NZoomImg" alt="{{ $product->name }}" src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/food-shop-1.png') }}">
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="product-info p-60">
          <div class="d-flex align-items-center">
            <div class="start d-flex align-items-center">
              @for($i = 1; $i <= 5; $i++)
                @if($i <= $product->rating)
                  <i class="fa-solid fa-star"></i>
                @else
                  <i class="fa-regular fa-star"></i>
                @endif
              @endfor
            </div>
            <span class="ms-2">{{ $product->reviews_count }} Reviews</span>
          </div>
          <h3>{{ $product->name }}</h3>
          <form class="variations_form">
            <div class="stock">
              <span class="price">
                @if($product->sale_price)
                  <del>
                    <span class="woocommerce-Price-amount">
                      <bdi>₹{{ number_format($product->price, 2) }}</bdi>
                    </span>
                  </del>
                  <ins>₹{{ number_format($product->sale_price, 2) }}</ins>
                @else
                  <ins>₹{{ number_format($product->price, 2) }}</ins>
                @endif
              </span>
              <h6>
                <span class="{{ $product->stock_quantity > 0 ? 'text-success' : 'text-danger' }}">
                  {{ $product->stock_quantity > 0 ? 'In stock' : 'Out of stock' }}
                </span>
              </h6>
            </div>
            @if($product->stock_quantity > 0)
            <div class="quantity product-actions">
              <h6>Quantity</h6>
              <input type="number" class="input-text quantity-input" step="1" min="1" max="{{ $product->stock_quantity }}" name="quantity" value="1">
            </div>
            <button type="button" class="button mt-3 add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
            @else
            <div class="out-of-stock-notice">
              <p class="text-danger"><strong>Out of Stock</strong></p>
            </div>
            @endif
            <ul class="product_meta mt-4">
              <li><span class="theme-bg-clr">Category:</span> {{ $product->category->name }}</li>
              @if($product->brand)
              <li><span class="theme-bg-clr">Brand:</span> {{ $product->brand->name }}</li>
              @endif
              <li><span class="theme-bg-clr">SKU:</span> {{ $product->sku }}</li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="gap">
  <div class="container">
    @if($product->description)
    <div class="information">
      <h3>Product Description</h3>
      <div class="boder-bar"></div>
      <p>{{ $product->description }}</p>
    </div>
    @endif
    
    <!-- Nutritional Info Section (if needed for pet food) -->
    @if($product->category && str_contains(strtolower($product->category->name), 'food'))
    <div class="information mt-70">
      <h3>Nutritional Info</h3>
      <div class="boder-bar"></div>
      <ul class="specification">
        <li><h6>Protein</h6>21.0% Min</li>
        <li><h6>Fat</h6>8.0% Min</li>
        <li><h6>Fiber</h6>4.0% Max</li>
        <li><h6>Moisture</h6>12.0% Max</li>
      </ul>
    </div>
    @endif
     <section class="gap">
  <div class="container">
    <div class="information">
      <h3>Related Products</h3>
      <div class="boder-bar"></div>
      <p>Lorem ipsum dolor sit amet,consectetur adipiscing elit do eiusmod tempor incididunt ut labore et.Lorem ipsumsit amet, consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur adipiscing elibore et. Lorem ipsum dolor sit amet,consectetur adipiscing elit do eiusmod tempor incididunt ut labore et.Lorem ipsumsit amet, consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur adipiscing elibore et. loLorem ipsum dolor sit amet,consectetur adipiscing elit do eiusmod tempor incididunt ut labore et.Lorem ipsumsit amet, consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur adipiscing elibore et. Lorem ipsum dolor sit amet,consectetur adipiscing elit do eiusmod tempor incididunt ut labore et.Lorem ipsumsit amet, consectetur adipiscing elit, </p>
    </div>
      <div class="row mt-5">
        <div class="col-lg-7">
            <div class="information">
              <h3>Related Products</h3>
              <div class="boder-bar"></div>
              <p>Lorem ipsum dolor sit amet,consectetur adipiscing elit do eiusmosed do eiusmod teincididunt ut la amet,consectetur adipiscing elib incididunt ut labore et.Lorem ipsumsit amet, consec</p>
              <div class="row mt-md-5">
                <div class="col-lg-6 col-md-6">
                                <div class="pet-grooming">
                                <i><img src="assets/img/welcome-to-1.png" alt="icon"></i>
                                <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                                </svg>
                                <a href="#"><h4>Pet Grooming</h4></a>
                                <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                                </div>
                </div>
                <div class="col-lg-6 col-md-6">
                                <div class="pet-grooming">
                                <i><img src="assets/img/welcome-to-2.png" alt="icon"></i>
                                <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                                </svg>
                                <a href="#"><h4>Dog Walking</h4></a>
                                <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                                </div>
                </div>
              </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="looking video position-relative">
                        <svg class="golo" width="510" height="510" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                        <a data-fancybox="" href="https://www.youtube.com/watch?v=xKxrkht7CpY">
                            <i>
                              <svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11 8.49951L0.5 0.27227L0.5 16.7268L11 8.49951Z" fill="#000"></path>
                              </svg>
                            </i>
                        </a>
                        <img src="assets/img/dog-video-1.jpg" alt="img">
          </div>
        </div>
      </div>
      <div class="information mt-70">
      <h3>Nutritional Info</h3>
      <div class="boder-bar"></div>
      <ul class="specification">
        <li><h6>Vitamin E</h6>100 IU/kg</li>
        <li><h6>Glucosamine</h6>350 mg/kg*</li>
        <li><h6>Crude Protein</h6>21.0%</li>
        <li><h6>Moisture </h6>12.0%</li>
      </ul>
    </div>
    <div class="information mt-70">
      <h3>Feeding Guidelines</h3>
      <div class="boder-bar"></div>
      <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Weight of Dog</th>
          <th scope="col">Cups Per Day</th>
          <th scope="col">Mix With Pouch</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="noBorder">Up to 10 lb</td>
          <td class="noBorder">1 to 2</td>
          <td class="noBorder">3.5 oz of PEDIGREE® Pouch</td>
        </tr>
        <tr>
          <td class="noBorder">10 to 25</td>
          <td class="noBorder">2 to 3</td>
          <td class="noBorder">3.5 oz of PEDIGREE</td>
        </tr>
        <tr>
          <td class="noBorder">50 to 75</td>
          <td class="noBorder">1 to 2</td>
          <td class="noBorder"></td>
        </tr>
        <tr>
          <td class="noBorder">75 to 150</td>
          <td class="noBorder">2 to 3</td>
        </tr>
      </tbody>
    </table>
  </div>
    </div>
    <div class="row mt-70">
      <div class="col-lg-7">
        <div class="information ">
          <h3>Reviews</h3>
          <div class="boder-bar"></div>
        </div>
        <ul class="reviews">
          <li>
            <div>
            <img alt="img" src="assets/img/reviews-1.jpg">
              <div class="star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
            <div>
              <div class="d-flex align-items-center">
                <h4>Smith Johnson</h4>
                <span>January 7, 2023</span>
              </div>
              <p>Integer sollicitudin ligula non enim sodales non lacinia commodo tempor mod licitudin. Integer sollicitudin ligula non enim sodales non lacinia.</p>
            </div>
          </li>
          <li>
            <div>
            <img alt="img" src="assets/img/reviews-2.jpg">
              <div class="star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
            <div>
              <div class="d-flex align-items-center">
                <h4>Wilimes Marko</h4>
                <span>January 7, 2023</span>
              </div>
              <p>Integer sollicitudin ligula non enim sodales non lacinia commodo tempor mod licitudin. Integer sollicitudin ligula non enim sodales non lacinia.</p>
            </div>
          </li>
          <li>
            <div>
            <img alt="img" src="assets/img/reviews-3.jpg">
              <div class="star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
            <div>
              <div class="d-flex align-items-center">
                <h4>Thomas Nomia</h4>
                <span>January 7, 2023</span>
              </div>
              <p>Integer sollicitudin ligula non enim sodales non lacinia commodo tempor mod licitudin. Integer sollicitudin ligula non enim sodales non lacinia.</p>
            </div>
          </li>
        </ul>
        <ul class="pagination">
                  <li class="prev"><a href="#"><i class='fa-solid fa-arrow-left'></i></a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">......</a></li>
                  <li><a href="#">18</a></li>
                  <li class="next"><a href="#"><i class='fa-solid fa-arrow-right'></i></a></li>
               </ul>
      </div>
      <div class="col-lg-5">
        <form class="add-review comment leave-comment">
          <div class="information">
            <h3>Leave Your Review</h3>
            <div class="boder-bar"></div>
            <div class="d-flex align-items-center mb-4">
            <span>Select Rating:</span>
              <div class="start d-flex align-items-center ps-md-4">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
          </div>
              <input type="text" name="name" placeholder="Complate Name">
              <input type="text" name="Email" placeholder="Email Address">
            <textarea placeholder="Add Review"></textarea>
              <button class="button">Add Review
              </button>
        </form>
      </div>
    </div>
  </div>
</section>
    @if($relatedProducts->count() > 0)
    <div class="information mt-70">
      <h3>Related Products</h3>
      <div class="boder-bar"></div>
      <div class="row">
        @foreach($relatedProducts as $related)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="healthy-product mb-lg-0">
                <div class="healthy-product-img">
                    <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('assets/img/food-1.png') }}" alt="{{ $related->name }}">
                    <ul class="star">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $related->rating)
                                <li><i class="fa-solid fa-star"></i></li>
                            @else
                                <li><i class="fa-regular fa-star"></i></li>
                            @endif
                        @endfor
                    </ul>
                    <div class="add-to-cart">
                      <a href="#" class="add-to-cart-btn" data-product-id="{{ $related->id }}">Add to Cart</a>
                      <a href="#" class="heart-wishlist">
                        <i class="fa-regular fa-heart"></i>
                      </a>
                    </div>
                    @if($related->sale_price)
                        <h4>-{{ round((($related->price - $related->sale_price) / $related->price) * 100) }}%</h4>
                    @endif
                </div>
                <span>{{ $related->category->name }}</span>
                <a href="{{ route('product.show', $related->slug) }}">{{ $related->name }}</a>
                <h6>
                    @if($related->sale_price)
                        <del>${{ number_format($related->price, 2) }}</del>${{ number_format($related->sale_price, 2) }}
                    @else
                        ${{ number_format($related->price, 2) }}
                    @endif
                </h6>
            </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>
@endsection

@section('script')
<script>
function changeMainImage(src) {
    document.getElementById('NZoomImg').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.li-pd-imgs').forEach(function(li) {
        li.classList.remove('nav-active');
    });
    event.target.parentElement.classList.add('nav-active');
}

$(document).ready(function() {
    // Quantity selector
    $('.quantity-plus').click(function() {
        var input = $(this).siblings('.quantity-input');
        var max = parseInt(input.attr('max'));
        var value = parseInt(input.val());
        if (value < max) {
            input.val(value + 1);
        }
    });

    $('.quantity-minus').click(function() {
        var input = $(this).siblings('.quantity-input');
        var value = parseInt(input.val());
        if (value > 1) {
            input.val(value - 1);
        }
    });

    // Gallery thumbnails
    $('.thumbnail-image').click(function() {
        var newSrc = $(this).attr('src');
        $('.main-image').attr('src', newSrc);
    });

    // Add to wishlist functionality (placeholder)
    $('.add-to-wishlist').click(function() {
        $(this).toggleClass('btn-outline-secondary btn-danger');
        var icon = $(this).find('i');
        icon.toggleClass('fa-regular fa-solid');
        // Here you would implement actual wishlist functionality
    });
});
</script>
@endsection
