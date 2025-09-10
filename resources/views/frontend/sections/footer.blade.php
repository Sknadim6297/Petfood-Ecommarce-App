<div class="gap">
    <div class="container">
        @php
            $websiteSettings = \App\Models\WebsiteSetting::getSettings();
        @endphp
        <div class="insta-img">
            <h3><i class="fa-brands fa-instagram"></i>Follow {{ $websiteSettings['instagram_handle'] ?? $websiteSettings['company_name'] ?? '@domain.com' }}</h3>
            @if(!empty($websiteSettings['instagram_url']))
                <a href="{{ $websiteSettings['instagram_url'] }}" target="_blank" class="button">Follow Us</a>
            @else
                <a href="#" class="button">Follow Us</a>
            @endif
        </div>
            <ul class="image-gallery">
              <li>
                <a href="{{ asset('assets/img/gallery-1.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-1.jpg') }}"></figure></a>
              </li>
              <li>
                <a href="{{ asset('assets/img/gallery-2.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-2.jpg') }}"></figure></a>
              </li>
              <li>
                <a href="{{ asset('assets/img/gallery-3.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-3.jpg') }}"></figure></a>
              </li>
              <li>
                <a href="{{ asset('assets/img/gallery-4.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-4.jpg') }}"></figure></a>
              </li>
              <li>
                <a href="{{ asset('assets/img/gallery-5.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-5.jpg') }}"></figure></a>
              </li>
              <li>
                <a href="{{ asset('assets/img/gallery-6.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-6.jpg') }}"></figure></a>
              </li>
              <li>
                <a href="{{ asset('assets/img/gallery-7.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-7.jpg') }}"></figure></a>
              </li>
            </ul>
    </div>
</div>
<footer style="background-color: #fff8e5; background-image:url({{ asset('assets/img/background.png') }})">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        @if(!empty($websiteSettings['footer_logo']))
                            <img src="{{ asset('storage/' . $websiteSettings['footer_logo']) }}" alt="{{ $websiteSettings['company_name'] ?? 'Logo' }}" class="footer-logo">
                        @elseif(!empty($websiteSettings['logo']))
                            <img src="{{ asset('storage/' . $websiteSettings['logo']) }}" alt="{{ $websiteSettings['company_name'] ?? 'Logo' }}" class="footer-logo">
                        @else
                            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="footer-logo">
                        @endif
                    </a>
                    <p>{{ $websiteSettings['footer_description'] ?? 'At vero eos et accusam justo duo dolo res et ea rebum. Stet clita kasd guber gren. Aenean sollici tudin lorem qsben elit clita.' }}</p>
                    <div class="phone">
                          <i>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <path d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z
                               M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z"></path>
                            </svg>
                          </i><a href="mailto:{{ $websiteSettings['email'] ?? 'username@domain.com' }}">{{ $websiteSettings['email'] ?? 'username@domain.com' }}</a>
                    </div>
                        <div class="phone d-flax align-items-center">
                          <i>
                              <svg version="1.1" xml:space="preserve" width="682.66669" height="682.66669" viewBox="0 0 682.66669 682.66669" xmlns="http://www.w3.org/2000/svg"><clipPath clipPathUnits="userSpaceOnUse"><path d="M 0,512 H 512 V 0 H 0 Z"></path></clipPath><g transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)"><g><g clip-path="url(#clipPath2333)"><g transform="translate(256,92)"><path d="m 0,0 c -126.964,143.662 -160,165.23 -160,240 0,88.366 71.634,160 160,160 88.365,0 160,-71.634 160,-160 C 160,165.854 130.212,147.337 0,0 Z" style="fill:none;stroke:#000;stroke-width:40;stroke-linecap:square;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"></path></g><g transform="translate(316,372)"><path d="m 0,0 -80,-80 -40,40" style="fill:none;stroke:#000;stroke-width:40;stroke-linecap:square;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"></path></g></g></g></g>
                              </svg>
                            </i>
                          <p>{{ $websiteSettings['address'] ?? 'Eighth Avenue 487, New York' }}</p>
                        </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="widget-title">
                  <h3>Quick Links</h3>
                  <div class="boder"></div>
                    <ul>
                      <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('home') }}">Home</a></li>
                      <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('about') }}">About</a></li>
                      <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('gallery') }}">Photo Gallery</a></li>
                      <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('products.index') }}">Our Products</a></li>
                      <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('cooked-foods.index') }}">Cooked Foods</a></li>
                      <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('blog') }}">Our Blog</a></li>
                      <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                  </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="working-hours">
                    <div class="widget-title">
                      <h3>working hours</h3>
                      <div class="boder"></div>
                      <div class="working-time">
                          @if(!empty($websiteSettings['working_hours_weekdays']) && !empty($websiteSettings['working_hours_weekdays_time']))
                              <h6 class="pt-0">{{ $websiteSettings['working_hours_weekdays'] }} <span>{{ $websiteSettings['working_hours_weekdays_time'] }}</span></h6>
                              @if(!empty($websiteSettings['working_hours_weekend']) && !empty($websiteSettings['working_hours_weekend_time']))
                                  <h6>{{ $websiteSettings['working_hours_weekend'] }}<span>{{ $websiteSettings['working_hours_weekend_time'] }}</span></h6>
                              @endif
                          @else
                              <h6 class="pt-0">Monday - Saturday <span>08AM - 10PM</span></h6>
                              <h6>Sunday<span>08AM - 10PM</span></h6>
                          @endif
                          <div class="call-us">
                              <img src="{{ asset('assets/img/hadphon.png') }}" alt="hadphon">
                              <div>
                                  <a href="tel:{{ $websiteSettings['phone'] ?? '+021 01283492' }}">{{ $websiteSettings['phone'] ?? '+021 01283492' }}</a>
                                  <span>{{ $websiteSettings['support_text'] ?? 'Got Questions? Call us 24/7' }}</span>
                              </div>
                          </div>
                          <ul class="social-icon">
                            @if(!empty($websiteSettings['facebook_url']))
                              <li><a href="{{ $websiteSettings['facebook_url'] }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            @endif
                            @if(!empty($websiteSettings['twitter_url']))
                              <li><a href="{{ $websiteSettings['twitter_url'] }}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                            @endif
                            @if(!empty($websiteSettings['instagram_url']))
                              <li><a href="{{ $websiteSettings['instagram_url'] }}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            @endif
                            @if(!empty($websiteSettings['linkedin_url']))
                              <li><a href="{{ $websiteSettings['linkedin_url'] }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            @endif
                            @if(!empty($websiteSettings['youtube_url']))
                              <li><a href="{{ $websiteSettings['youtube_url'] }}" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                            @endif
                              @if(!empty($websiteSettings['phone']))
                                <li><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $websiteSettings['phone']) }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                              @endif
                          </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>{{ $websiteSettings['footer_copyright'] ?? 'Petnet - Copyright 2023. Design by Sk Nadim' }}</p>
            <a href="#"><img src="{{ asset('assets/img/visa.jpg') }}" alt="cad"></a>
        </div>
    </div>
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-2">
    <img src="{{ asset('assets/img/dabal-foot-1.png') }}" alt="hero-shaps" class="img-3">
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-4">
</footer>

<!-- Progress Scroll to Top Button -->
<div class="progress-wrap" id="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="m50,1a49,49 0 0,1 0,98a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
    <span id="progress-value"><i class="fa-solid fa-up-long"></i></span>
</div>

<style>
/* Progress Scroll to Top Button */
.progress-wrap {
    position: fixed;
    right: 30px;
    bottom: 30px;
    height: 55px;
    width: 55px;
    cursor: pointer;
    display: block;
    border-radius: 50px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    z-index: 10000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(15px);
    transition: all 200ms linear;
    background: linear-gradient(45deg, #fa441d, #e63612);
}

.progress-wrap.active-progress {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.progress-wrap::after {
    position: absolute;
    font-family: "Font Awesome 6 Free";
    content: "\f077";
    text-align: center;
    line-height: 55px;
    font-size: 16px;
    color: white;
    left: 0;
    top: 0;
    height: 55px;
    width: 55px;
    cursor: pointer;
    display: block;
    z-index: 1;
    transition: all 200ms linear;
    font-weight: 900;
}

.progress-wrap:hover::after {
    opacity: 0;
}

.progress-wrap svg path {
    fill: none;
    stroke: #fa441d;
    stroke-width: 3;
    box-sizing: border-box;
    transition: all 200ms linear;
}

.progress-wrap svg.progress-circle path {
    stroke: white;
    stroke-dasharray: 307.919;
    stroke-dashoffset: 307.919;
}

.progress-wrap #progress-value {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 16px;
    opacity: 0;
    transition: all 200ms linear;
    z-index: 2;
    font-weight: 900;
}

.progress-wrap:hover #progress-value {
    opacity: 1;
}

.progress-wrap:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.4);
}

/* Mobile responsive */
@media (max-width: 768px) {
    .progress-wrap {
        right: 20px;
        bottom: 20px;
        height: 45px;
        width: 45px;
    }
    
    .progress-wrap::after {
        line-height: 45px;
        height: 45px;
        width: 45px;
        font-size: 14px;
    }
    
    .progress-wrap #progress-value {
        font-size: 14px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Progress scroll to top
    const progressPath = document.querySelector('.progress-wrap path');
    const pathLength = progressPath.getTotalLength();
    const progressWrap = document.querySelector('.progress-wrap');
    
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
    
    const updateProgress = function() {
        const scroll = window.pageYOffset;
        const height = document.documentElement.scrollHeight - window.innerHeight;
        const progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
    }
    
    updateProgress();
    
    window.addEventListener('scroll', updateProgress);
    
    // Show/hide progress wrap
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 150) {
            progressWrap.classList.add('active-progress');
        } else {
            progressWrap.classList.remove('active-progress');
        }
    });
    
    // Click to scroll to top
    progressWrap.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        return false;
    });
});
</script>