@extends('frontend.layouts.layout')

@section('title', 'Our Blog')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Our Blog</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
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
<section class="gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if($blogs->count() > 0)
                    @foreach($blogs as $blog)
                        <div class="blog-style our-blog">
                            <figure>
                                @if($blog->image_url)
                                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                                @else
                                    <img src="{{ asset('assets/img/our-blog-1.jpg') }}" alt="{{ $blog->title }}">
                                @endif
                            </figure>
                            @if($blog->category)
                                <a href="{{ route('blog.category', $blog->category->slug) }}"><h6>{{ $blog->category->name }}</h6></a>
                            @endif
                            <div class="blog-style-text">
                                <h5>{{ $blog->created_at->format('d') }}<span>{{ $blog->created_at->format('M,Y') }}</span></h5>
                                <div>
                                    <a href="{{ route('blog.show', $blog->slug) }}"><h3>{{ $blog->title }}</h3></a>
                                    <p>{{ Str::limit(strip_tags($blog->description), 200) }}</p>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/img/man.jpg') }}" alt="author">
                                        <h4>{{ $blog->author ?? 'Admin' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <h3>No blog posts found</h3>
                        <p>Check back later for new content!</p>
                    </div>
                @endif

                @if($blogs->hasPages())
                    <ul class="pagination">
                        @if ($blogs->onFirstPage())
                            <li class="prev disabled"><span><i class='fa-solid fa-arrow-left'></i></span></li>
                        @else
                            <li class="prev"><a href="{{ $blogs->previousPageUrl() }}"><i class='fa-solid fa-arrow-left'></i></a></li>
                        @endif

                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            @if ($page == $blogs->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($blogs->hasMorePages())
                            <li class="next"><a href="{{ $blogs->nextPageUrl() }}"><i class='fa-solid fa-arrow-right'></i></a></li>
                        @else
                            <li class="next disabled"><span><i class='fa-solid fa-arrow-right'></i></span></li>
                        @endif
                    </ul>
                @endif
            </div>
            <div class="col-lg-4">
                    <div class="sidebar">
                        <h3>Recent Posts</h3>
                        <div class="boder-bar"></div>
                        <ul class="recent-post">
                            @if($recentBlogs && $recentBlogs->count() > 0)
                                @foreach($recentBlogs as $recentBlog)
                                    <li class="{{ $loop->last ? 'end' : '' }}">
                                        @if($recentBlog->image_url)
                                            <img alt="recent-posts-img" src="{{ $recentBlog->image_url }}">
                                        @else
                                            <img alt="recent-posts-img" src="{{ asset('assets/img/recent-posts-1.jpg') }}">
                                        @endif
                                        <div>
                                            <span>{{ $recentBlog->created_at->format('F d, Y') }}</span>
                                            <a href="{{ route('blog.show', $recentBlog->slug) }}">{{ Str::limit($recentBlog->title, 50) }}</a>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <img alt="recent-posts-img" src="{{ asset('assets/img/recent-posts-1.jpg') }}">
                                    <div>
                                        <span>No recent posts</span>
                                        <a href="#">Check back later for new content</a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="sidebar">
                        <h3>Categories</h3>
                        <div class="boder-bar"></div>
                        <ul class="categories">
                            @if($categories && $categories->count() > 0)
                                @foreach($categories as $category)
                                    <li class="{{ $loop->last ? 'end' : '' }}">
                                        <a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}<span>{{ $category->blogs_count ?? 0 }}</span></a>
                                    </li>
                                @endforeach
                            @else
                                <li class="end">
                                    <a href="#">No categories<span>0</span></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="sidebar">
                        <h3>Instagram</h3>
                        <div class="boder-bar"></div>
                        <ul class="instagram-posts">
                            @if($galleryImages && $galleryImages->count() > 0)
                                @foreach($galleryImages as $image)
                                    <li>
                                        <a href="{{ asset('storage/' . $image->image) }}" data-fancybox="gallery">
                                            <figure><img alt="gallery" src="{{ asset('storage/' . $image->image) }}"></figure>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <a href="{{ asset('assets/img/gallery-image-1.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-image-1.jpg') }}"></figure></a>
                                </li>
                                <li>
                                    <a href="{{ asset('assets/img/gallery-image-2.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-image-2.jpg') }}"></figure></a>
                                </li>
                                <li>
                                    <a href="{{ asset('assets/img/gallery-image-3.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-image-3.jpg') }}"></figure></a>
                                </li>
                                <li>
                                    <a href="{{ asset('assets/img/gallery-image-4.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-image-4.jpg') }}"></figure></a>
                                </li>
                                <li>
                                    <a href="{{ asset('assets/img/gallery-image-5.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-image-5.jpg') }}"></figure></a>
                                </li>
                                <li>
                                    <a href="{{ asset('assets/img/gallery-image-6.jpg') }}" data-fancybox="gallery"><figure><img alt="girl" src="{{ asset('assets/img/gallery-image-6.jpg') }}"></figure></a>
                                </li>
                            @endif
                        </ul>
                        <h5><i class="fa-brands fa-instagram"></i>Follow @petnet</h5>
                    </div>
                    {{-- <div class="sidebar sidebar-two">
                        <h3>Newsletter</h3>
                        <div class="boder-bar"></div>
                        <p>Enter your email and get recent news 
                            and update.</p>
                        <form>
                            <input type="text" name="email" placeholder="Enter your email address...">
                            <button class="button">Subscribe</button>
                        </form>
                    </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection
