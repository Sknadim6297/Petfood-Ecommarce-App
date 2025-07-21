@extends('frontend.layouts.layout')

@section('title', $blog->meta_title ?: $blog->title)

@if($blog->meta_description)
@section('meta-description', $blog->meta_description)
@endif

@if($blog->meta_keywords)
@section('meta-keywords', $blog->meta_keywords)
@endif

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>{{ $blog->title }}</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                        <li class="breadcrumb-item"><a href="{{ route('blog') }}">Our blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 30) }}</li>
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
                <div class="blog-details">
                    <div class="blog-style-two">
                        <figure>
                            @if($blog->image_url)
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                            @else
                                <img src="{{ asset('assets/img/blog-4.jpg') }}" alt="{{ $blog->title }}">
                            @endif
                        </figure>
                        <div class="blog-text-two">
                            @if($blog->category)
                                <a href="{{ route('blog.category', $blog->category->slug) }}"><h6>{{ $blog->category->name }}</h6></a>
                            @else
                                <a href="#"><h6>General</h6></a>
                            @endif
                            <h5>{{ $blog->formatted_published_date }}</h5>
                            <h4>/   {{ $blog->views_count }} Views</h4>
                            <a href="#"><h3>{{ $blog->title }}</h3></a>
                            <p>{{ $blog->description }}</p>
                        </div>
                    </div>
                    
                    <div class="blog-content mt-4">
                        <div style="white-space: pre-line;">{!! $blog->content !!}</div>
                    </div>

                    @if($blog->tags && count($blog->tags) > 0)
                    <div class="blog-tags mt-4">
                        <h5>Tags:</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($blog->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Related Posts Section -->
                    @if($relatedPosts && $relatedPosts->count() > 0)
                    <div class="related-posts mt-5">
                        <h3>Related Posts</h3>
                        <div class="boder-bar"></div>
                        <div class="row mt-4">
                            @foreach($relatedPosts->take(2) as $relatedPost)
                            <div class="col-lg-6 col-md-6">
                                <div class="blog-style-two">
                                    <figure>
                                        @if($relatedPost->image_url)
                                            <img src="{{ $relatedPost->image_url }}" alt="{{ $relatedPost->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/blog-4.jpg') }}" alt="{{ $relatedPost->title }}">
                                        @endif
                                    </figure>
                                    <div class="blog-text-two">
                                        @if($relatedPost->category)
                                            <a href="{{ route('blog.category', $relatedPost->category->slug) }}"><h6>{{ $relatedPost->category->name }}</h6></a>
                                        @endif
                                        <h5>{{ $relatedPost->formatted_published_date }}</h5>
                                        <h4>/   {{ $relatedPost->views_count }} Views</h4>
                                        <a href="{{ route('blog.show', $relatedPost->slug) }}"><h3>{{ Str::limit($relatedPost->title, 40) }}</h3></a>
                                        <p>{{ Str::limit($relatedPost->description, 100) }}</p>
                                        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="button">Read More</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="share-post">
                        <h5>Share Post:</h5>
                        <ul class="social-icon">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                          </ul>
                    </div>

                    @if($blog->comments_enabled)
                    <div class="comment">
                        <h3>Comments</h3>
                        <div class="boder-bar"></div>
                        <ul>
                            <li>
                                <img alt="girl" src="{{ asset('assets/img/comment-1.jpg') }}">
                                <div class="comment-data">
                                    <h4>Sample User</h4>
                                    <span>{{ now()->format('F d, Y') }}</span>
                                    <p class="pt-4">Comments will be displayed here when comment system is integrated.</p>
                                </div>
                                <a href="#" class="button">Reply</a>
                            </li>
                        </ul>
                    </div>
                    <div class="comment">
                    <h3>Leave A Comment</h3>
                        <div class="boder-bar"></div>
                    <form class="leave" method="POST" action="#">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="name" placeholder="Full Name" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="email" name="email" placeholder="Email Address" required>
                            </div>
                        </div>
                        <textarea name="message" placeholder="Your Message" required></textarea>
                        <button type="submit" class="button mt-4 mb-lg-0 mb-5">Post Comment</button>
                    </form>
                </div>
                @endif
                </div>
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
                    <div class="sidebar sidebar-two">
                        <h3>Newsletter</h3>
                        <div class="boder-bar"></div>
                        <p>Enter your email and get recent news 
                            and update.</p>
                        <form>
                            <input type="email" name="email" placeholder="Enter your email address..." required>
                            <button type="submit" class="button">Subscribe</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
