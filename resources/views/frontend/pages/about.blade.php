@extends('frontend.layouts.layout')

@section('title', 'About Us')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>about</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
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
                        @if($aboutContent && $aboutContent->banner_image)
                            <img src="{{ Storage::url($aboutContent->banner_image) }}" alt="banner">
                        @else
                            <img src="{{ asset('assets/img/banner-img-1.jpg') }}" alt="banner">
                        @endif
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

<section class="gap about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="heading two">
                    <h2>{{ $aboutContent ? $aboutContent->title : 'Welcome to The Pet Care Company' }}</h2>
                </div>
                <div class="love-your-pets">
                    <p>{{ $aboutContent ? $aboutContent->description : 'Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore et.Lorem ipsumsit amet,  consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur.' }}</p>
                    @if($aboutContent && $aboutContent->features && count($aboutContent->features) > 0)
                        <ul class="list">
                            @foreach($aboutContent->features as $feature)
                                <li>
                                    <img src="{{ asset('assets/img/list.png') }}" alt="list">
                                    {{ is_array($feature) ? ($feature['title'] ?? $feature['description'] ?? 'Feature') : $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <ul class="list">
                            <li><img src="{{ asset('assets/img/list.png') }}" alt="list">Graceful goldfish, to small, cute kittens</li>
                            <li><img src="{{ asset('assets/img/list.png') }}" alt="list">Feeders are either veterinary qualified staf</li>
                            <li><img src="{{ asset('assets/img/list.png') }}" alt="list">Experienced pet owners and animal lovers</li>
                            <li><img src="{{ asset('assets/img/list.png') }}" alt="list">Hungry horses: whatever the size of your pe</li>
                        </ul>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dogs-img">
                    @if($aboutContent && $aboutContent->about_image)
                        <img src="{{ Storage::url($aboutContent->about_image) }}" alt="about">
                    @else
                        <img src="{{ asset('assets/img/dogs-1.png') }}" alt="dogs">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section id="mission-home" class="overlay-light pt-115 pb-115" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 60px 0;">
    <div class="container">
        <!-- section heading -->  
        <div class="section-title text-center mb-50">
            <span class="title-tag" style="background: linear-gradient(135deg, #fa441d, #ff6b35); color: white; padding: 8px 20px; border-radius: 25px; font-weight: 600;">
                <i class="flaticon-dog-food-1"></i> About Us 
            </span>
            <h2 style="margin-top: 20px; color: #2c3e50; font-weight: 700;">Mission <span class="highlight" style="color: #fa441d;">Vision</span></h2>
        </div>
        <!-- /section-heading -->
        <div class="row mission">
           <!-- Tabs -->
           <div class="col-md-12">
              <!-- navigation -->
              <nav>
                 <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist" style="border: none; margin-bottom: 40px;">
                    <a class="nav-item nav-link active show" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-selected="true" 
                       style="background: linear-gradient(135deg, #fa441d, #ff6b35); color: white; border: none; border-radius: 25px 0 0 25px; padding: 12px 30px; font-weight: 600; margin-right: 2px;">
                       {{ $aboutContent ? $aboutContent->mission_title : 'Our Mission' }}
                    </a>
                    <a class="nav-item nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-selected="false"
                       style="background: #f8f9fa; color: #666; border: none; border-radius: 0 25px 25px 0; padding: 12px 30px; font-weight: 600; transition: all 0.3s ease;">
                       {{ $aboutContent ? $aboutContent->vision_title : 'Our Vision' }}
                    </a>
                 </div>
              </nav>
              <!-- tab-content -->
              <div class="tab-content block-padding" id="nav-tabContent">
                 <div class="tab-pane fade active show" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <!-- row -->
                    <div class="row align-items-center">
                       <div class="col-lg-5" data-aos="zoom-out">
                          <!-- image -->
                          <div class="img-zoom-hover" style="border-radius: 15px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                             @if($aboutContent && $aboutContent->mission_image)
                                 <img src="{{ Storage::url($aboutContent->mission_image) }}" alt="mission" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
                             @else
                                 <img src="https://www.ingridkuhn.com/themes/unitedpets/img/abouttab1.jpg" alt="mission" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
                             @endif
                          </div>
                          <!-- /img-zoom-hover -->
                       </div>
                       <!-- /col-lg-5 -->
                       <div class="col-lg-7 res-margin">
                          <h3 style="color: #2c3e50; font-weight: 700; margin-bottom: 20px;">{{ $aboutContent ? $aboutContent->mission_title : 'Our Mission' }}</h3>
                          <!--divider -->
                          <hr class="small-divider left" style="width: 60px; height: 3px; background: linear-gradient(135deg, #fa441d, #ff6b35); border: none; margin-bottom: 25px;">
                          <p style="font-size: 16px; line-height: 1.8; color: #666; text-align: justify;">
                              {{ $aboutContent ? $aboutContent->mission_content : 'To Promote sales of pet products and services in digital platform through E COMMERCE and ensuring delivery of pet products and services at the door step of pet lovers' }}
                          </p>
                       </div>
                       <!-- /col-lg-6-->
                    </div>
                    <!-- row -->
                 </div>
                 <!-- ./Tab-pane -->
                 <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <!-- row -->
                    <div class="row align-items-center">
                       <div class="col-lg-7 res-margin">
                          <h3 style="color: #2c3e50; font-weight: 700; margin-bottom: 20px;">{{ $aboutContent ? $aboutContent->vision_title : 'Our Vision' }}</h3>
                          <!--divider -->
                          <hr class="small-divider left" style="width: 60px; height: 3px; background: linear-gradient(135deg, #fa441d, #ff6b35); border: none; margin-bottom: 25px;">
                          <p style="font-size: 16px; line-height: 1.8; color: #666; text-align: justify;">
                              {{ $aboutContent ? $aboutContent->vision_content : 'To become No. 1 E-COMMERCE portal for pet products and services in India.' }}
                          </p>
                       </div>
                       <div class="col-lg-5 res-margin">
                          <!-- image -->
                          <div class="img-zoom-hover" style="border-radius: 15px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                             @if($aboutContent && $aboutContent->vision_image)
                                 <img src="{{ Storage::url($aboutContent->vision_image) }}" alt="vision" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
                             @else
                                 <img src="https://www.ingridkuhn.com/themes/unitedpets/img/abouttab2.jpg" alt="vision" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
                             @endif
                          </div>
                          <!-- /img-zoom-hover -->
                       </div>
                       <!-- /col-lg-5 -->
                    </div>
                    <!-- /row -->
                 </div>
                 <!-- ./Tab-pane -->
              </div>
              <!-- ./Tab-content -->
           </div>
           <!-- col-md-12 -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container-->
</section>
<section class="gap">
    <div class="container">
        <div class="row">
            @if($aboutContent && $aboutContent->statistics)
                @foreach($aboutContent->statistics as $stat)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="count-text">
                        <img alt="img" src="{{ asset('assets/img/' . ($stat['icon'] ?? 'fun-facts-1.png')) }}">
                       <div>
                       <div class="d-flex justify-content-center">
                            <h2 class="count" data-number="{{ $stat['number'] ?? '0' }}"></h2>
                            <span>{{ $stat['suffix'] ?? '' }}</span>
                       </div>
                       <h3 class="text">{{ $stat['label'] ?? 'Statistic' }}</h3>
                       </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="count-text">
                        <img alt="img" src="{{ asset('assets/img/fun-facts-1.png') }}">
                       <div>
                       <div class="d-flex justify-content-center">
                            <h2 class="count" data-number="100"></h2>
                            <span>+</span>
                       </div>
                       <h3 class="text">Client Served</h3>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="count-text">
                        <img alt="img" src="{{ asset('assets/img/fun-facts-2.png') }}">
                       <div>
                       <div class="d-flex justify-content-center">
                            <h2 class="count" data-number="99"></h2>
                            <span>%</span>
                       </div>
                       <h3 class="text">Success Rate</h3>
                      </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="count-text mb-sm-0">
                        <img alt="img" src="{{ asset('assets/img/fun-facts-3.png') }}">
                       <div>
                       <div class="d-flex justify-content-center">
                            <h2 class="count" data-number="2"></h2>
                            <span>k</span>
                       </div>
                       <h3 class="text">Happy Pets</h3>
                      </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="count-text mb-0">
                        <img alt="img" src="{{ asset('assets/img/fun-facts-4.png') }}">
                       <div>
                       <div class="d-flex justify-content-center">
                            <h2 class="count" data-number="400"></h2>
                            <span>+</span>
                       </div>
                       <h3 class="text">Products</h3>
                      </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<div class="gap">
    <div class="container">
        <div class="heading">
            <img src="{{ asset('assets/img/heading-img.png') }}" alt="heading-img">
            <h6>{{ $aboutContent ? $aboutContent->gallery_subtitle : 'Gallery Photos' }}</h6>
            <h2>{{ $aboutContent ? $aboutContent->gallery_title : 'Pet Care Memories' }}</h2>
        </div>
        <div class="row">
            @if($aboutContent && $aboutContent->gallery_images && count($aboutContent->gallery_images) > 0)
                @foreach($aboutContent->gallery_images as $index => $gallery)
                    @if($index < 3)
                    <div class="col-lg-4 col-md-6">
                        <div class="about-gallery-img {{ $index == 2 ? 'mb-lg-0' : '' }}">
                            <a href="{{ Storage::url($gallery['image']) }}" data-fancybox="gallery">
                               <i class="fa-solid fa-plus"></i>
                            </a>
                            <figure><img alt="{{ $gallery['caption'] ?? 'gallery' }}" src="{{ Storage::url($gallery['image']) }}"></figure>
                        </div> 
                    </div>
                    @endif
                @endforeach
            @else
                <div class="col-lg-4 col-md-6">
                    <div class="about-gallery-img">
                        <a href="{{ asset('assets/img/gallery-img-1.jpg') }}" data-fancybox="gallery">
                           <i class="fa-solid fa-plus"></i>
                        </a><figure><img alt="girl" src="{{ asset('assets/img/gallery-img-1.jpg') }}"></figure>
                    </div> 
                    <div class="about-gallery-img mb-lg-0">
                        <a href="{{ asset('assets/img/gallery-img-3.jpg') }}" data-fancybox="gallery">
                           <i class="fa-solid fa-plus"></i>
                        </a><figure><img alt="girl" src="{{ asset('assets/img/gallery-img-3.jpg') }}"></figure>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-gallery-img">
                        <a href="{{ asset('assets/img/gallery-img-4.jpg') }}" data-fancybox="gallery">
                           <i class="fa-solid fa-plus"></i>
                        </a><figure><img alt="girl" src="{{ asset('assets/img/gallery-img-4.jpg') }}"></figure>
                    </div>
                    <div class="about-gallery-img">
                        <a href="{{ asset('assets/img/gallery-img-5.jpg') }}" data-fancybox="gallery">
                           <i class="fa-solid fa-plus"></i>
                        </a><figure><img alt="girl" src="{{ asset('assets/img/gallery-img-5.jpg') }}"></figure>
                    </div>
                    <div class="about-gallery-img mb-lg-0">
                        <a href="{{ asset('assets/img/gallery-img-6.jpg') }}" data-fancybox="gallery">
                           <i class="fa-solid fa-plus"></i>
                        </a><figure><img alt="girl" src="{{ asset('assets/img/gallery-img-6.jpg') }}"></figure>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-gallery-img">
                        <a href="{{ asset('assets/img/gallery-img-7.jpg') }}" data-fancybox="gallery">
                           <i class="fa-solid fa-plus"></i>
                        </a><figure><img alt="girl" src="{{ asset('assets/img/gallery-img-7.jpg') }}"></figure>
                    </div>
                    <div class="about-gallery-img mb-lg-0">
                        <a href="{{ asset('assets/img/gallery-img-2.jpg') }}" data-fancybox="gallery">
                           <i class="fa-solid fa-plus"></i>
                        </a><figure><img alt="girl" src="{{ asset('assets/img/gallery-img-2.jpg') }}"></figure>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="gap">
    <div class="container">
        <div class="mockup">
            <h3>{{ $aboutContent ? $aboutContent->register_title : 'Register your pet with us and Get 5% off their next order' }}</h3>
            <div class="mockup-img">
                @if($aboutContent && $aboutContent->register_image)
                    <img src="{{ Storage::url($aboutContent->register_image) }}" alt="register">
                @else
                    <img src="{{ asset('assets/img/mockup.png') }}" alt="mockup">
                @endif
            </div>
            <div class="mockup-text">
                <p>{{ $aboutContent ? $aboutContent->register_description : 'We are your local dog home boarding service giving you complete' }}</p>
                <a href="#" class="button">Register Now</a>
            </div>
        </div>
    </div>
</div>

<style>
/* Mission Vision Section Styles */
.nav-tabs .nav-link {
    border: none !important;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
    background: linear-gradient(135deg, #fa441d, #ff6b35) !important;
    color: white !important;
}

.nav-tabs .nav-link.active {
    background: linear-gradient(135deg, #fa441d, #ff6b35) !important;
    color: white !important;
}

.nav-tabs .nav-link:not(.active) {
    background: #f8f9fa !important;
    color: #666 !important;
}

.img-zoom-hover {
    transition: transform 0.3s ease;
}

.img-zoom-hover:hover {
    transform: scale(1.02);
}

.small-divider {
    margin: 0;
}

@media (max-width: 768px) {
    .nav-tabs .nav-link {
        border-radius: 25px !important;
        margin: 5px !important;
        padding: 10px 20px !important;
    }
    
    #mission-home {
        padding: 40px 0 !important;
    }
    
    .col-lg-5, .col-lg-7 {
        margin-bottom: 30px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tabs
    var triggerTabList = [].slice.call(document.querySelectorAll('#nav-tab a'));
    triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl);
        triggerEl.addEventListener('click', function (event) {
            event.preventDefault();
            tabTrigger.show();
        });
    });
});
</script>
@endsection
