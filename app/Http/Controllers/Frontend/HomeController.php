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
        // Get active categories for "Browse By Categories" section
        $categories = Category::active()
            ->withCount(['products' => function ($query) {
                $query->active();
            }])
            ->ordered()
            ->limit(6)
            ->get();

        // Get featured products for "Healthy Products" section
        $featuredProducts = Product::with(['category', 'brand'])
            ->active()
            ->inStock()
            ->featured()
            ->limit(5)
            ->get();

        // Get healthy products for "Healthy Products" section
        $healthyProducts = Product::with(['category', 'brand'])
            ->active()
            ->inStock()
            ->healthy()
            ->limit(8)
            ->get();

        // Get deal of the week
        $dealOfWeek = Product::with(['category', 'brand'])
            ->active()
            ->inStock()
            ->dealOfWeek()
            ->first();

        // If no deal of week product, get one with highest discount
        if (!$dealOfWeek) {
            $dealOfWeek = Product::with(['category', 'brand'])
                ->active()
                ->inStock()
                ->whereNotNull('sale_price')
                ->orderByRaw('((price - sale_price) / price) DESC')
                ->first();
        }

        return view('frontend.index', compact('categories', 'featuredProducts', 'healthyProducts', 'dealOfWeek'));
    }
}
