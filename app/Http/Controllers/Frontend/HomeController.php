<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get main categories only for "Browse By Categories" section
        $categories = Category::whereNull('parent_id') // Only main categories
            ->active()
            ->withCount(['products' => function ($query) {
                $query->active();
            }])
            ->ordered()
            ->limit(6)
            ->get();

        // Get main categories with their subcategories for "Shop By Pet Type" section
        $petTypes = Category::with(['children' => function ($query) {
                $query->active()
                    ->withCount(['products' => function ($productQuery) {
                        $productQuery->active();
                    }])
                    ->ordered(); // Order subcategories
            }])
            ->whereNull('parent_id') // Only main categories
            ->active()
            ->withCount(['products' => function ($query) {
                $query->active();
            }])
            ->ordered()
            ->get(); // Get all main categories with subcategories

        // Get featured products for "Healthy Products" section
        $featuredProducts = Product::with(['category', 'brand'])
            ->active()
            ->inStock()
            ->featured()
            ->limit(5)
            ->get();

        // Get healthy products for "Healthy Products" section
        $healthyProducts = Product::with(['category', 'subcategory', 'brand'])
            ->active()
            ->inStock()
            ->healthy()
            ->limit(8)
            ->get();

        // Get deal of the week
        $dealOfWeek = Product::with(['category', 'subcategory', 'brand'])
            ->active()
            ->inStock()
            ->dealOfWeek()
            ->first();

        // If no deal of week product, get one with highest discount
        if (!$dealOfWeek) {
            $dealOfWeek = Product::with(['category', 'subcategory', 'brand'])
                ->active()
                ->inStock()
                ->whereNotNull('sale_price')
                ->orderByRaw('((price - sale_price) / price) DESC')
                ->first();
        }

        return view('frontend.index', compact('categories', 'petTypes', 'featuredProducts', 'healthyProducts', 'dealOfWeek'));
    }
}
