<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get all main categories with subcategories and product counts
        $categories = Category::with(['children' => function($query) {
                $query->active()->withCount(['products' => function ($q) {
                    $q->active()->inStock();
                }])->ordered();
            }])
            ->mainCategories()
            ->active()
            ->withCount(['products' => function ($query) {
                $query->active()->inStock();
            }])
            ->ordered()
            ->get();

        // Get all active brands with product counts
        $brands = Brand::active()
            ->withCount(['products' => function ($query) {
                $query->active()->inStock();
            }])
            ->ordered()
            ->get();

        // Build the products query
        $query = Product::with(['category', 'subcategory', 'brand'])->active();

        // Filter by category if specified
        if ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by subcategory if specified
        if ($request->has('subcategory') && $request->subcategory) {
            $subcategory = Category::where('slug', $request->subcategory)->first();
            if ($subcategory) {
                $query->where('subcategory_id', $subcategory->id);
            }
        }

        // Filter by brand if specified
        if ($request->has('brand') && $request->brand) {
            $brand = Brand::where('slug', $request->brand)->first();
            if ($brand) {
                $query->where('brand_id', $brand->id);
            }
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where(function($q) use ($request) {
                $q->where('price', '>=', $request->min_price)
                  ->orWhere('sale_price', '>=', $request->min_price);
            });
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where(function($q) use ($request) {
                $q->where('price', '<=', $request->max_price)
                  ->orWhere('sale_price', '<=', $request->max_price);
            });
        }

        // Apply sorting
        switch ($request->get('sort', 'created_at')) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'price_low':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'featured':
                $query->where('is_featured', true)->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Paginate results
        $products = $query->paginate(12);

        return view('frontend.products.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'subcategory', 'brand', 'reviews' => function($query) {
                $query->approved()->latest()->with('user');
            }])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Calculate average rating
        $approvedReviews = $product->reviews()->approved()->get();
        $product->rating = $approvedReviews->count() > 0 ? $approvedReviews->avg('rating') : 0;
        $product->reviews_count = $approvedReviews->count();

        // Get related products from same category
        $relatedProducts = Product::with(['category', 'subcategory', 'brand'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->inStock()
            ->limit(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }

    public function showById($id)
    {
        $product = Product::with(['category', 'brand', 'reviews' => function($query) {
                $query->approved()->latest()->with('user');
            }])
            ->where('id', $id)
            ->active()
            ->firstOrFail();

        // Calculate average rating
        $approvedReviews = $product->reviews()->approved()->get();
        $product->rating = $approvedReviews->count() > 0 ? $approvedReviews->avg('rating') : 0;
        $product->reviews_count = $approvedReviews->count();

        // Get related products from same category
        $relatedProducts = Product::with(['category', 'brand'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->inStock()
            ->limit(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:2|max:100'
        ]);

        $searchTerm = $request->search;
        
        // Search products by name, description, or category name
        $query = Product::with(['category', 'brand'])
            ->active()
            ->inStock()
            ->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('short_description', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('category', function($subQ) use ($searchTerm) {
                      $subQ->where('name', 'LIKE', "%{$searchTerm}%");
                  });
            });

        // Apply sorting
        switch ($request->get('sort', 'created_at')) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'price_low':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'featured':
                $query->where('is_featured', true)->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);

        // Get all categories for the filter
        $categories = Category::active()
            ->withCount(['products' => function ($query) {
                $query->active()->inStock();
            }])
            ->ordered()
            ->get();

        return view('frontend.products.search', compact('products', 'categories', 'brands', 'query'));
    }

    /**
     * Get subcategories for AJAX requests
     */
    public function getSubcategories(Request $request)
    {
        $categoryId = $request->get('category_id');
        $subcategories = Category::where('parent_id', $categoryId)
            ->active()
            ->ordered()
            ->get(['id', 'name', 'slug']);
        
        return response()->json($subcategories);
    }

    /**
     * Universal search for both products and cooked foods
     */
    public function universalSearch(Request $request)
    {
        $searchTerm = $request->input('search');
        
        if (empty($searchTerm)) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        // Search products
        $products = Product::active()
            ->where(function($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('short_description', 'LIKE', "%{$searchTerm}%");
            })
            ->with('category')
            ->paginate(12, ['*'], 'products_page');

        // Search cooked foods
        $cookedFoods = \App\Models\CookedFood::where(function($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('category', 'LIKE', "%{$searchTerm}%");
            })
            ->paginate(12, ['*'], 'cooked_foods_page');

        $totalResults = $products->total() + $cookedFoods->total();

        return view('frontend.search.results', compact('products', 'cookedFoods', 'searchTerm', 'totalResults'));
    }

    /**
     * Show product details page
     */
    public function details(Request $request)
    {
        // For now, redirect to products index
        // You can implement individual product details later
        return view('frontend.pages.product-details');
    }
}
