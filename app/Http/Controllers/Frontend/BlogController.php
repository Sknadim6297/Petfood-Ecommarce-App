<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the blog listing page
     */
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'user'])
            ->active()
            ->published()
            ->latest('published_at');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $blogs = $query->paginate(9);
        
        // Get categories for sidebar
        $categories = BlogCategory::withCount(['blogs' => function($q) {
            $q->active()->published();
        }])->get();

        // Get recent posts for sidebar
        $recentBlogs = Blog::with('category')
            ->active()
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get();

        // Get featured posts
        $featuredPosts = Blog::with('category')
            ->active()
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Get gallery images for sidebar
        $galleryImages = \App\Models\ImageLibrary::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.blog.index', compact('blogs', 'categories', 'recentBlogs', 'featuredPosts', 'galleryImages'));
    }

    /**
     * Display the specified blog post
     */
    public function show($slug)
    {
        $blog = Blog::with(['category', 'user', 'approvedComments'])
            ->where('slug', $slug)
            ->active()
            ->published()
            ->firstOrFail();

        // Increment view count
        $blog->incrementViews();

        // Get comments for this blog
        $comments = $blog->approvedComments()->latest()->get();

        // Get related posts
        $relatedPosts = Blog::with('category')
            ->where('id', '!=', $blog->id)
            ->where('blog_category_id', $blog->blog_category_id)
            ->active()
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        // If no related posts in same category, get other recent posts
        if ($relatedPosts->count() < 3) {
            $additionalPosts = Blog::with('category')
                ->where('id', '!=', $blog->id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->active()
                ->published()
                ->latest('published_at')
                ->take(3 - $relatedPosts->count())
                ->get();
            
            $relatedPosts = $relatedPosts->concat($additionalPosts);
        }

        // Get categories for sidebar
        $categories = BlogCategory::withCount(['blogs' => function($q) {
            $q->active()->published();
        }])->get();

        // Get recent posts for sidebar
        $recentBlogs = Blog::with('category')
            ->where('id', '!=', $blog->id)
            ->active()
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get();

        // Get gallery images for sidebar
        $galleryImages = \App\Models\ImageLibrary::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.blog.details', compact('blog', 'comments', 'relatedPosts', 'categories', 'recentBlogs', 'galleryImages'));
    }

    /**
     * Display posts by category
     */
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        
        $blogs = Blog::with(['category', 'user'])
            ->where('blog_category_id', $category->id)
            ->active()
            ->published()
            ->latest('published_at')
            ->paginate(9);

        // Get categories for sidebar
        $categories = BlogCategory::withCount(['blogs' => function($q) {
            $q->active()->published();
        }])->get();

        // Get recent posts for sidebar
        $recentBlogs = Blog::with('category')
            ->active()
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get();

        // Get gallery images for sidebar
        $galleryImages = \App\Models\ImageLibrary::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.blog.category', compact('blogs', 'category', 'categories', 'recentBlogs', 'galleryImages'));
    }
}
