<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CookedFood;
use Illuminate\Http\Request;

class CookedFoodController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories with counts
        $categories = ['fish', 'chicken', 'meat', 'egg', 'other'];
        $categoryCounts = [];
        
        foreach ($categories as $category) {
            $categoryCounts[$category] = CookedFood::active()
                ->where('category', $category)
                ->count();
        }

        // Build the cooked foods query
        $query = CookedFood::active();

        // Filter by category if specified
        if ($request->has('category') && $request->category && in_array($request->category, $categories)) {
            $query->where('category', $request->category);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Apply sorting
        switch ($request->get('sort', 'created_at')) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Paginate results
        $cookedFoods = $query->paginate(12);

        return view('frontend.cooked-foods.index', compact('cookedFoods', 'categories', 'categoryCounts'));
    }

    public function show($slug)
    {
        $cookedFood = CookedFood::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get related cooked foods from same category
        $relatedFoods = CookedFood::where('category', $cookedFood->category)
            ->where('id', '!=', $cookedFood->id)
            ->active()
            ->limit(4)
            ->get();

        return view('frontend.cooked-foods.show', compact('cookedFood', 'relatedFoods'));
    }

    public function showById($id)
    {
        $cookedFood = CookedFood::where('id', $id)
            ->active()
            ->firstOrFail();

        // Get related cooked foods from same category
        $relatedFoods = CookedFood::where('category', $cookedFood->category)
            ->where('id', '!=', $cookedFood->id)
            ->active()
            ->limit(4)
            ->get();

        return view('frontend.cooked-foods.show', compact('cookedFood', 'relatedFoods'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');
        
        if (empty($query)) {
            return redirect()->route('cooked-foods.index');
        }

        $cookedFoods = CookedFood::where(function($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('description', 'like', '%' . $query . '%');
        })
        ->active()
        ->paginate(12);

        $categories = ['fish', 'chicken', 'meat', 'egg', 'other'];
        $categoryCounts = [];
        
        foreach ($categories as $category) {
            $categoryCounts[$category] = CookedFood::active()
                ->where('category', $category)
                ->count();
        }

        return view('frontend.cooked-foods.search', compact('cookedFoods', 'query', 'categories', 'categoryCounts'));
    }

    public function category($category)
    {
        $categories = ['fish', 'chicken', 'meat', 'egg', 'other'];
        
        if (!in_array($category, $categories)) {
            abort(404);
        }

        $cookedFoods = CookedFood::where('category', $category)
            ->active()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categoryCounts = [];
        foreach ($categories as $cat) {
            $categoryCounts[$cat] = CookedFood::active()
                ->where('category', $cat)
                ->count();
        }

        return view('frontend.cooked-foods.category', compact('cookedFoods', 'category', 'categories', 'categoryCounts'));
    }
}
