@extends('frontend.layouts.layout')

@section('title', 'Blog Details')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url(assets/img/banner.png)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Blog Details</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                      </li>
                        <li class="breadcrumb-item"><a href="our-blog.html">Our blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
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
                <div class="blog-details">
                    <div class="blog-style-two">
                        <figure>
                            <img src="assets/img/blog-4.jpg" alt="img">
                        </figure>
                        <div class="blog-text-two">
                            <a href="#"><h6>Animal Care</h6></a> <h5>Dec 20, 2023</h5><h4>/   3 Comments</h4>
                            <a href="blog-details.html"><h3>How to get Rid of Fleas on kittens</h3></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  ore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br><br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco lorim epsome sit laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in volup tate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dodolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia dserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                        </div>
                    </div>
                    <ul class="list">
                        <li><img src="assets/img/list.png" alt="list">Graceful goldfish, to small, cute kittens</li>
                        <li><img src="assets/img/list.png" alt="list">Feeders are either veterinary qualified staf</li>
                        <li><img src="assets/img/list.png" alt="list">Experienced pet owners and animal lovers</li>
                        <li><img src="assets/img/list.png" alt="list">Hungry horses: whatever the size of your pe</li>
                    </ul>
                    <div class="video position-relative">
                        <a data-fancybox="" href="https://www.youtube.com/watch?v=xKxrkht7CpY">
                            <i>
                              <svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11 8.49951L0.5 0.27227L0.5 16.7268L11 8.49951Z" fill="#000"></path>
                              </svg>
                            </i>
                        </a>
                        <img src="assets/img/blog-video.jpg" alt="img">
                    </div>
                    <div class="client-help">
                            <p>“ We help our clients from the definition of their strategy to the realization of their digital ecosystem. At the heart of our approach is the constant search for the juncture between aesthetic. ”</p>
                        <a href="#">Willimes Domson</a>
                        <span>Product Management</span>
                    </div>
                    <p>boris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
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
                                  <figure>
                                      <img src="assets/img/about-2.jpg" alt="img">
                                  </figure>
                              </div>
                      </div>
                  </div>
                    <p>boris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br><br>Lorem ipsum dolor sit amet, consectetur a dipiscing elit, sed do eiusmod tempor incididunt ut labore et dolre magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut</p>
                    <div class="share-post">
                        <h5>Share Post:</h5>
                        <ul class="social-icon">
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                          </ul>
                    </div>
                    <div class="willimes-marko">
                        <img alt="girl" src="assets/img/boy.jpg">
                        <div>
                            <div class="social-media-Intege">
                                <h4>Willimes Marko</h4>
                                <ul class="social-icon">
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <p>Integer sollicitudin ligula non enim sodales Sewid commodo tempor are risus ineuismod    varius nullam Sed condimentum est libero</p>
                        </div>
                    </div>
                    <div class="comment">
                        <h3>Comments</h3>
                        <div class="boder-bar"></div>
                        <ul>
                            <li>
                                <img alt="girl" src="assets/img/comment-1.jpg">
                                <div class="comment-data">
                                    <h4>Willimes Marko</h4>
                                    <span>January 7, 2023</span>
                                    <p class="pt-4">Integer sollicitudin ligula non enim sodales, non lacinia Sewid commodo 
                                        are risus in euismod varius nullam feugiat ultrices.</p>
                                </div>
                                <a href="#" class="button">Reply</a>
                            </li>
                            <li class="reply-comment">
                                <img alt="man" src="assets/img/comment-2.jpg">
                                <div class="comment-data">
                                    <h4>Walkar Jamson</h4>
                                    <span>January 7, 2023</span>
                                    <p class="pt-4">Integer sollicitudin ligula non enim sodales, non lacinia Sewid commodo 
                                        are risus in euismod varius nullam feugiat ultrices.</p>
                                </div>
                                <a href="#" class="button">Reply</a>
                            </li>
                            <li>
                                <img alt="man" src="assets/img/comment-3.jpg">
                                <div class="comment-data">
                                    <h4>Willimes Marko</h4>
                                    <span>January 7, 2023</span>
                                    <p class="pt-4">Integer sollicitudin ligula non enim sodales, non lacinia Sewid commodo 
                                        are risus in euismod varius nullam feugiat ultrices.</p>
                                </div>
                                <a href="#" class="button">Reply</a>
                            </li>
                        </ul>
                    </div>
                    <div class="comment">
                    <h3>Leave A Comments</h3>
                        <div class="boder-bar"></div>
                    <form class="leave">
                        <div class="row">

                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="Name" placeholder="Full Name">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="Email Address" placeholder="Email Address">
                            </div>
                        </div>
                        <textarea placeholder="Your Message"></textarea>
                        <button class="button mt-4 mb-lg-0 mb-5">Post Comment</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="col-lg-4 ">
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
