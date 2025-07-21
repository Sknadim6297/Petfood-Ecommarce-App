@extends('frontend.layouts.layout')

@section('title', $category->name . ' - Blog Category')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>{{ $category->name }}</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                        <li class="breadcrumb-item"><a href="{{ route('blog') }}">Our blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
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
                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="blog-style-two">
                                <figure>
                                    @if($blog->image_url)
                                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                                    @else
                                        <img src="{{ asset('assets/img/blog-4.jpg') }}" alt="{{ $blog->title }}">
                                    @endif
                                </figure>
                                <div class="blog-text-two">
                                    <a href="{{ route('blog.category', $blog->category->slug) }}"><h6>{{ $blog->category->name }}</h6></a>
                                    <h5>{{ $blog->formatted_published_date }}</h5>
                                    <h4>/   {{ $blog->views_count }} Views</h4>
                                    <a href="{{ route('blog.show', $blog->slug) }}"><h3>{{ Str::limit($blog->title, 50) }}</h3></a>
                                    <p>{{ Str::limit($blog->description, 120) }}</p>
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="button">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $blogs->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <h3>No posts found in {{ $category->name }}</h3>
                        <p class="text-muted">There are no published posts in this category yet.</p>
                        <a href="{{ route('blog') }}" class="button">View All Posts</a>
                    </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <div class="sidebar">
                    <h3>Recent Posts</h3>
                    <div class="boder-bar"></div>
                    <ul class="recent-post">
                        @forelse($recentBlogs as $recentBlog)
                        <li class="{{ $loop->last ? 'end' : '' }}">
                            @if($recentBlog->image_url)
                                <img alt="recent-posts-img" src="{{ $recentBlog->image_url }}">
                            @else
                                <img alt="recent-posts-img" src="{{ asset('assets/img/recent-posts-1.jpg') }}">
                            @endif
                            <div>
                                <span>{{ $recentBlog->formatted_published_date }}</span>
                                <a href="{{ route('blog.show', $recentBlog->slug) }}">{{ Str::limit($recentBlog->title, 40) }}</a>
                            </div>
                        </li>
                        @empty
                        <li>
                            <p class="text-muted">No recent posts available.</p>
                        </li>
                        @endforelse
                    </ul>
                </div>
                
                <div class="sidebar">
                    <h3>Categories</h3>
                    <div class="boder-bar"></div>
                    <ul class="categories">
                        @forelse($categories as $cat)
                        <li class="{{ $loop->last ? 'end' : '' }}">
                            <a href="{{ route('blog.category', $cat->slug) }}" class="{{ $cat->id === $category->id ? 'active' : '' }}">
                                {{ $cat->name }}<span>{{ $cat->blogs_count }}</span>
                            </a>
                        </li>
                        @empty
                        <li>
                            <a href="#">No categories available<span>0</span></a>
                        </li>
                        @endforelse
                    </ul>
                </div>
                
                <div class="sidebar sidebar-two">
                    <h3>Newsletter</h3>
                    <div class="boder-bar"></div>
                    <p>Enter your email and get recent news and updates.</p>
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
