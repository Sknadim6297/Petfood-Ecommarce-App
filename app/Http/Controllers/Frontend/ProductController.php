<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get all active categories with product counts
        $categories = Category::active()
            ->withCount(['products' => function ($query) {
                $query->active()->inStock();
            }])
            ->ordered()
            ->get();

        // Build the products query
        $query = Product::with('category')->active();

        // Filter by category if specified
        if ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
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

        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get related products from same category
        $relatedProducts = Product::with('category')
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
        $query = Product::with('category')
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

        return view('frontend.products.search', compact('products', 'categories', 'searchTerm'));
    }
}
