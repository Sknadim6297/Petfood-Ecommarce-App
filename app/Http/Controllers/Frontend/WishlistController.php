<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CookedFood;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }

        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with(['product.category', 'cookedFood'])
            ->latest()
            ->get();
        
        return view('frontend.wishlist.index', compact('wishlistItems'));
    }

    /**
     * Add product to wishlist
     */
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to your wishlist.',
                'redirect' => route('login')
            ]);
        }

        // Debug logging
        Log::info('Wishlist add request', [
            'request_data' => $request->all(),
            'product_id' => $request->product_id,
            'user_id' => Auth::id()
        ]);

        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = Auth::user();
        $productId = $request->product_id;

                // Check if already in wishlist
        $existingWishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();
            
        if ($existingWishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Product is already in your wishlist.'
            ]);
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $productId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist!',
            'action' => 'added',
            'wishlist_count' => Wishlist::where('user_id', $user->id)->count()
        ]);
    }

    /**
     * Remove product from wishlist
     */
    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first.',
                'redirect' => route('login')
            ]);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = Auth::user();
        $productId = $request->product_id;

        // Remove from wishlist
        $deleted = Wishlist::where('user_id', $user->id)
                          ->where('product_id', $productId)
                          ->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist.',
                'wishlist_count' => Wishlist::where('user_id', $user->id)->count()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in wishlist.'
        ]);
    }

    /**
     * Toggle wishlist (add if not exists, remove if exists)
     */
    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to manage your wishlist.',
                'redirect' => route('login')
            ]);
        }

        $itemType = $request->input('item_type', 'product');
        $itemId = $request->input('item_id');

        if ($itemType === 'cooked_food') {
            $request->validate([
                'item_id' => 'required|exists:cooked_foods,id'
            ]);
        } else {
            $request->validate([
                'item_id' => 'required|exists:products,id'
            ]);
        }

        $user = Auth::user();

        // Build query conditions
        $conditions = ['user_id' => $user->id, 'item_type' => $itemType];
        
        if ($itemType === 'cooked_food') {
            $conditions['cooked_food_id'] = $itemId;
        } else {
            $conditions['product_id'] = $itemId;
        }

        $wishlistItem = Wishlist::where($conditions)->first();

        if ($wishlistItem) {
            // Remove from wishlist
            $wishlistItem->delete();
            $added = false;
            $message = ($itemType === 'cooked_food' ? 'Cooked food' : 'Product') . ' removed from wishlist.';
        } else {
            // Add to wishlist
            $wishlistData = [
                'user_id' => $user->id,
                'item_type' => $itemType
            ];
            
            if ($itemType === 'cooked_food') {
                $wishlistData['cooked_food_id'] = $itemId;
                $wishlistData['product_id'] = null;
            } else {
                $wishlistData['product_id'] = $itemId;
                $wishlistData['cooked_food_id'] = null;
            }
            
            Wishlist::create($wishlistData);
            $added = true;
            $message = ($itemType === 'cooked_food' ? 'Cooked food' : 'Product') . ' added to wishlist!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'added' => $added,
            'action' => $added ? 'added' : 'removed',
            'in_wishlist' => $added,
            'wishlist_count' => Wishlist::where('user_id', $user->id)->count()
        ]);
    }

    /**
     * Get wishlist count
     */
    public function getCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        return response()->json([
            'count' => Wishlist::where('user_id', Auth::id())->count()
        ]);
    }

    /**
     * Clear entire wishlist
     */
    public function clear()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first.',
                'redirect' => route('login')
            ]);
        }

        Wishlist::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Wishlist cleared successfully.'
        ]);
    }

    /**
     * Get user's wishlisted product IDs for updating UI
     */
    public function getUserProducts(Request $request)
    {
        // If this is a direct browser request (not AJAX), redirect to wishlist page
        if (!$request->ajax() && !$request->wantsJson()) {
            return redirect()->route('wishlist.index');
        }
        
        if (!Auth::check()) {
            return response()->json([
                'success' => true,
                'product_ids' => []
            ]);
        }

        $productIds = Wishlist::where('user_id', Auth::id())
                             ->pluck('product_id')
                             ->toArray();

        return response()->json([
            'success' => true,
            'product_ids' => $productIds
        ]);
    }
}
