@extends('frontend.layouts.layout')
@section('style')
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
            <div class="col-lg-4 col-md-6">
                <div class="we-provide">
                    <div class="we-provide-img">
                        <img src="{{ asset('assets/img/we-provide-1.jpg') }}" alt="we-provide-1">
                        <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fedc4f"/>
                        </svg>

                    </div>
                    <a href="#"><h5>Find a Dog Sitter</h5></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="we-provide">
                    <div class="we-provide-img">
                        <img src="{{ asset('assets/img/we-provide-2.jpg') }}" alt="we-provide-1">
                        <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fb5e3c"/>
                        </svg>
                    </div>
                    <a href="#"><h5>Become a Dog Sitter</h5></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="we-provide mb-0">
                    <div class="we-provide-img">
                        <img src="{{ asset('assets/img/we-provide-3.jpg') }}" alt="we-provide-1">
                        <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fedc4f"/>
                        </svg>
                    </div>
                    <a href="#"><h5> Start a franchise</h5></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                </div>
            </div>
        </div>
    </div>
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
            <h6>Find Healthy Product By Category</h6>
            <h2>Browse By Categories</h2>
        </div>
        <div class="row slider-categorie owl-carousel owl-theme">
            @forelse($categories as $category)
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    @if($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                    @else
                        <img src="{{ asset('assets/img/food-categorie-' . (($loop->index % 5) + 1) . '.png') }}" alt="{{ $category->name }}">
                    @endif
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                </div>
            </div>
            @empty
            <!-- Fallback static categories if no dynamic data -->
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <img src="{{ asset('assets/img/food-categorie-1.png') }}" alt="food-categorie">
                    <a href="{{ route('products.index') }}">Pet Supplies</a>
                </div>
            </div>
            <div class="col-lg-12 item">
                <div class="food-categorie">
                    <img src="{{ asset('assets/img/food-categorie-2.png') }}" alt="food-categorie">
                    <a href="{{ route('products.index') }}">Dog Supplies</a>
                </div>
            </div>
            @endforelse
        </div>
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
                    <span>{{ $product->category->name ?? 'Animal Feed' }}</span>
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
                        <span>{{ $dealOfWeek->category->name ?? 'Animal Feed' }}</span>
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
<section class="gap"> 
    <div class="container">
        <div class="dog-walker">
            <img src="assets/img/dog-walker.png" alt="dog walker">
            <img src="assets/img/line.png" class="line" alt="line">
            <img src="assets/img/dabal-foot.png" class="dabal-foot" alt="dabal-foot">
            <div class="dog-walker-text">
                <h2>Find a dog walker or pet care</h2>
                <p>Place your trust in We Love Pets, an award-winning dog walking and pet care</p>
                <form>
                    <input placeholder="Enter address or postcode..." name="Enter address" type="text">
                    <button class="button">Find Branch</button>
                </form>
            </div>
        </div>
    </div>
</section>  
@endsection
 
