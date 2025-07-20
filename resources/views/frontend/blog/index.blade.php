@extends('frontend.layouts.layout')

@section('title', 'Our Blog')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url(assets/img/banner.png)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Our Blog</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                      </li>
                        <li class="breadcrumb-item active" aria-current="page">Our Blog</li>
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
<section class="gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-style our-blog">
                    <figure>
                        <img src="assets/img/our-blog-1.jpg" alt="img">
                    </figure>
                    <a href="#"><h6>Animal Care</h6></a>
                    <div class="blog-style-text">
                        <h5>23<span>May,2023</span></h5>
                        <div>
                            <a href="#"><h3>Pets benefit our mental health</h3></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ore magna aliqua</p>
                            <div class="d-flex align-items-center">
                                <img src="assets/img/man.jpg" alt="man">
                                <h4>Willimes Domson</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-style our-blog">
                    <figure>
                        <img src="assets/img/our-blog-2.jpg" alt="img">
                    </figure>
                    <a href="#"><h6>Animal Care</h6></a>
                    <div class="blog-style-text">
                        <h5>23<span>May,2023</span></h5>
                        <div>
                            <a href="#"><h3>Caring for your dog</h3></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ore magna aliqua</p>
                            <div class="d-flex align-items-center">
                                <img src="assets/img/man.jpg" alt="man">
                                <h4>Willimes Domson</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-style our-blog">
                    <figure>
                        <img src="assets/img/our-blog-3.jpg" alt="img">
                    </figure>
                    <a href="#"><h6>Animal Care</h6></a>
                    <div class="blog-style-text">
                        <h5>23<span>May,2023</span></h5>
                        <div>
                            <a href="#"><h3>The Best High Fiber Dog Food</h3></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ore magna aliqua</p>
                            <div class="d-flex align-items-center">
                                <img src="assets/img/man.jpg" alt="man">
                                <h4>Willimes Domson</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-style our-blog">
                    <figure>
                        <img src="assets/img/our-blog-4.jpg" alt="img">
                    </figure>
                    <a href="#"><h6>Animal Care</h6></a>
                    <div class="blog-style-text">
                        <h5>23<span>May,2023</span></h5>
                        <div>
                            <a href="#"><h3>Benefits of adopting a rescue pet</h3></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ore magna aliqua</p>
                            <div class="d-flex align-items-center">
                                <img src="assets/img/man.jpg" alt="man">
                                <h4>Willimes Domson</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-style our-blog">
                    <figure>
                        <img src="assets/img/our-blog-5.jpg" alt="img">
                    </figure>
                    <a href="#"><h6>Animal Care</h6></a>
                    <div class="blog-style-text">
                        <h5>23<span>May,2023</span></h5>
                        <div>
                            <a href="#"><h3>Why walking shelter dogs</h3></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ore magna aliqua</p>
                            <div class="d-flex align-items-center">
                                <img src="assets/img/man.jpg" alt="man">
                                <h4>Willimes Domson</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="pagination">
                  <li class="prev"><a href="#"><i class='fa-solid fa-arrow-left'></i></a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">......</a></li>
                  <li><a href="#">18</a></li>
                  <li class="next"><a href="#"><i class='fa-solid fa-arrow-right'></i></a></li>
               </ul>
            </div>
            <div class="col-lg-4">
                    <div class="sidebar">
                        <h3>Recent Posts</h3>
                        <div class="boder-bar"></div>
                        <ul class="recent-post">
                            <li>
                                <img alt="recent-posts-img" src="assets/img/recent-posts-1.jpg">
                                <div>
                                    <span>March 25, 2023</span>
                                    <a href="#">Market Your Brand For The Metaverse</a>
                                </div>
                            </li>
                            <li>
                                <img alt="recent-posts-img" src="assets/img/recent-posts-2.jpg">
                                <div>
                                    <span>March 25, 2023</span>
                                    <a href="#">Market Your Brand For The Metaverse</a>
                                </div>
                            </li>
                            <li class="end">
                                <img alt="recent-posts-img" src="assets/img/recent-posts-3.jpg">
                                <div>
                                    <span>March 25, 2023</span>
                                    <a href="#">Market Your Brand For The Metaverse</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar">
                        <h3>Categories</h3>
                        <div class="boder-bar"></div>
                        <ul class="categories">
                            <li>
                                <a href="#">Creative<span>23</span></a>
                            </li>
                            <li>
                                <a href="#">Photography<span>10</span></a>
                            </li>
                            <li>
                                <a href="#">Marketing<span>09</span></a>
                            </li>
                            <li>
                                <a href="#">Unique Ideas<span>14</span></a>
                            </li>
                            <li>
                                <a href="#">Portfolio<span>12</span></a>
                            </li>
                            <li class="end">
                                <a href="#">Identity<span>11</span></a>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="sidebar">
                        <h3>Instagram</h3>
                        <div class="boder-bar"></div>
                        <ul class="instagram-posts">
                          <li>
                            <a href="assets/img/gallery-image-1.jpg" data-fancybox="gallery"><figure><img alt="girl" src="assets/img/gallery-image-1.jpg"></figure></a>
                          </li>
                          <li>
                            <a href="assets/img/gallery-image-2.jpg" data-fancybox="gallery"><figure><img alt="girl" src="assets/img/gallery-image-2.jpg"></figure></a>
                          </li>
                          <li>
                            <a href="assets/img/gallery-image-3.jpg" data-fancybox="gallery"><figure><img alt="girl" src="assets/img/gallery-image-3.jpg"></figure></a>
                          </li>
                          <li>
                            <a href="assets/img/gallery-image-4.jpg" data-fancybox="gallery"><figure><img alt="girl" src="assets/img/gallery-image-4.jpg"></figure></a>
                          </li>
                          <li>
                            <a href="assets/img/gallery-image-5.jpg" data-fancybox="gallery"><figure><img alt="girl" src="assets/img/gallery-image-5.jpg"></figure></a>
                          </li>
                          <li>
                            <a href="assets/img/gallery-image-6.jpg" data-fancybox="gallery"><figure><img alt="girl" src="assets/img/gallery-image-6.jpg"></figure></a>
                          </li>
                        </ul>
                        <h5><i class="fa-brands fa-instagram"></i>Follow @winsfolio</h5>
                    </div>
                    <div class="sidebar">
                        <h3>Quick Links</h3>
                        <div class="boder-bar"></div>
                        <ul class="quick-links">
                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Dog Boarding Services</a></li>
                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Cat Boarding Services</a></li>
                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Spa and Grooming Services</a></li>
                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Care for Puppy</a></li>
                            <li class="pb-0"><a href="#"><i class="fa-solid fa-angle-right"></i>Service at a Resort</a></li>
                            
                        </ul>
                    </div>
                    <div class="sidebar">
                        <h3>Meta</h3>
                        <div class="boder-bar"></div>
                        <ul class="Meta">
                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Log in</a></li>
                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Entries feed</a></li>
                            <li><a href="#"><i class="fa-solid fa-angle-right"></i>Comments feed</a></li>
                            <li class="pb-0 end"><a href="#"><i class="fa-solid fa-angle-right"></i>WordPress.org</a></li>
                        </ul>
                    </div>
                    <div class="sidebar sidebar-two">
                        <h3>Newsletter</h3>
                        <div class="boder-bar"></div>
                        <p>Enter your email and get recent news 
                            and update.</p>
                        <form>
                            <input type="text" name="email" placeholder="Enter your email address...">
                            <button class="button">Subscribe</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
