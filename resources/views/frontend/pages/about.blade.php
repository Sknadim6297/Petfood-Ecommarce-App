@extends('frontend.layouts.layout')

@section('title', 'About Us')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url(assets/img/banner.png)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>about</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                      </li>
                        <li class="breadcrumb-item active" aria-current="page">about</li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img">
                    <div class="banner-img-1">
                        <svg width="260" height="260" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="assets/img/banner-img-1.jpg" alt="banner">
                    </div>
                    <div class="banner-img-2">
                        <svg width="320" height="320" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="assets/img/banner-img-2.jpg" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="assets/img/hero-shaps-1.png" alt="hero-shaps" class="img-2">
    <img src="assets/img/hero-shaps-1.png" alt="hero-shaps" class="img-4">
</section>
<section class="gap about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="heading two">
                    <h2>Welcome to The Pet Care Company</h2>
                </div>
                <div class="love-your-pets">
                    <p>Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore et.Lorem ipsumsit amet,  consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur.</p>
                    <ul class="list">
                        <li><img src="assets/img/list.png" alt="list">Graceful goldfish, to small, cute kittens</li>
                        <li><img src="assets/img/list.png" alt="list">Feeders are either veterinary qualified staf</li>
                        <li><img src="assets/img/list.png" alt="list">Experienced pet owners and animal lovers</li>
                        <li><img src="assets/img/list.png" alt="list">Hungry horses: whatever the size of your pe</li>
                    </ul>
                    <div class="company-oner position-relative">
                        <img src="assets/img/girl.jpg" alt="girl">
                        <svg width="116" height="116" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"></path>
                        </svg>
                        <div>
                            <h3>Jessica Catty</h3>
                            <p>Owner Pet Care Company</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dogs-img">
                    <img src="assets/img/dogs-1.png" alt="dogs">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap no-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="we-provide">
                    <div class="we-provide-img">
                        <img src="assets/img/we-provide-1.jpg" alt="we-provide-1">
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
                        <img src="assets/img/we-provide-2.jpg" alt="we-provide-1">
                        <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fb5e3c"/>
                        </svg>
                    </div>
                    <a href="#"><h5>Become a Dog Sitter</h5></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="we-provide">
                    <div class="we-provide-img">
                        <img src="assets/img/we-provide-3.jpg" alt="we-provide-1">
                        <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fedc4f"/>
                        </svg>
                    </div>
                    <a href="#"><h5>Become a Dog Sitter</h5></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="background-image: url(assets/img/healthy-product.png); background-color: #f5f5f5;" class="gap care-services">
    <div class="container">
        <div class="heading">
            <img src="assets/img/heading-img.png" alt="heading-img">
            <h6>What We Provide</h6>
            <h2>Pet Care Services</h2>
        </div>
        <div class="row">
                    <div class="col-lg-3 p-lg-0 col-md-6 col-sm-6">
                            <div class="pet-grooming">
                            <i><img src="assets/img/welcome-to-3.png" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                            </svg>
                            <a href="#"><h4>Online Order</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                    </div>
                    <div class="col-lg-3 p-lg-0 col-md-6 col-sm-6">
                            <div class="pet-grooming">
                            <i><img src="assets/img/welcome-to-1.png" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                            </svg>
                            <a href="#"><h4>Pet Grooming</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                    </div>
                    <div class="col-lg-3 p-lg-0 col-md-6 col-sm-6">
                            <div class="pet-grooming">
                            <i><img src="assets/img/welcome-to-4.png" alt="icon"></i>
                            <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"></path>
                            </svg>
                            <a href="#"><h4>Pet Boarding</h4></a>
                            <p>Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.</p>
                            </div>
                    </div>
                    <div class="col-lg-3 p-lg-0 col-md-6 col-sm-6">
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
        <div class="row mt-3">
            <div class="col-lg-6 col-md-6">
                <div class="video position-relative">
                        <figure>
                            <img src="assets/img/about-1.jpg" alt="img">
                        </figure>
                    </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="video position-relative">
                        <a data-fancybox="" href="https://www.youtube.com/watch?v=xKxrkht7CpY">
                            <i>
                              <svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11 8.49951L0.5 0.27227L0.5 16.7268L11 8.49951Z" fill="#000"></path>
                              </svg>
                            </i>
                        </a>
                        <figure>
                            <img src="assets/img/about-2.jpg" alt="img">
                        </figure>
                    </div>
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
<div class="gap">
    <div class="container">
        <div class="heading">
            <img src="assets/img/heading-img.png" alt="heading-img">
            <h6>Gallery Photos</h6>
            <h2>Pet Care Memories</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="about-gallery-img">
                    <a href="assets/img/gallery-img-1.jpg" data-fancybox="gallery">
                       <i class="fa-solid fa-plus"></i>
                    </a><figure><img alt="girl" src="assets/img/gallery-img-1.jpg"></figure>
                </div> 
                <div class="about-gallery-img mb-lg-0">
                    <a href="assets/img/gallery-img-3.jpg" data-fancybox="gallery">
                       <i class="fa-solid fa-plus"></i>
                    </a><figure><img alt="girl" src="assets/img/gallery-img-3.jpg"></figure>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="about-gallery-img">
                    <a href="assets/img/gallery-img-4.jpg" data-fancybox="gallery">
                       <i class="fa-solid fa-plus"></i>
                    </a><figure><img alt="girl" src="assets/img/gallery-img-4.jpg"></figure>
                </div>
                <div class="about-gallery-img">
                    <a href="assets/img/gallery-img-5.jpg" data-fancybox="gallery">
                       <i class="fa-solid fa-plus"></i>
                    </a><figure><img alt="girl" src="assets/img/gallery-img-5.jpg"></figure>
                </div>
                <div class="about-gallery-img mb-lg-0">
                    <a href="assets/img/gallery-img-6.jpg" data-fancybox="gallery">
                       <i class="fa-solid fa-plus"></i>
                    </a><figure><img alt="girl" src="assets/img/gallery-img-6.jpg"></figure>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="about-gallery-img">
                    <a href="assets/img/gallery-img-7.jpg" data-fancybox="gallery">
                       <i class="fa-solid fa-plus"></i>
                    </a><figure><img alt="girl" src="assets/img/gallery-img-7.jpg"></figure>
                </div>
                <div class="about-gallery-img mb-lg-0">
                    <a href="assets/img/gallery-img-2.jpg" data-fancybox="gallery">
                       <i class="fa-solid fa-plus"></i>
                    </a><figure><img alt="girl" src="assets/img/gallery-img-2.jpg"></figure>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clients-logo">
    <div class="container">
        <div class="logodata owl-carousel owl-theme">
          <div class="partner item">
            <img alt="clients-logo" src="assets/img/clients-1.png">
          </div>
          <div class="partner item">
            <img alt="clients-logo" src="assets/img/clients-2.png">
          </div>
          <div class="partner item">
            <img alt="clients-logo" src="assets/img/clients-3.png">
          </div>
          <div class="partner item">
            <img alt="clients-logo" src="assets/img/clients-4.png">
          </div>
          <div class="partner item">
            <img alt="clients-logo" src="assets/img/clients-5.png">
          </div>
        </div>
    </div>
</div>
<div class="gap">
    <div class="container">
        <div class="mockup">
            <h3>Register your pet with us and <span>Get 5% off</span> their next order</h3>
            <div class="mockup-img">
                <img src="assets/img/mockup.png" alt="mockup">
            </div>
            <div class="mockup-text">
                <p>We are your local dog home boarding service giving you complete</p>
                <a href="#" class="button">Register Now</a>
            </div>
        </div>
</div>
</div>
@endsection
