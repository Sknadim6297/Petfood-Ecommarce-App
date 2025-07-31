<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Store a new review
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if user already reviewed this product
        if (Auth::check()) {
            $existingReview = Review::where('product_id', $request->product_id)
                                  ->where('user_id', Auth::id())
                                  ->first();
            
            if ($existingReview) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already reviewed this product.'
                ], 422);
            }
        }

        DB::beginTransaction();
        try {
            // Create the review
            $review = Review::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_approved' => false // Reviews need approval by default
            ]);

            // Update product rating and review count (including unapproved reviews for count)
            $this->updateProductRating($product);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your review! It will be published after approval.',
                'review' => $review
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    /**
     * Get reviews for a product
     */
    public function getProductReviews($productId)
    {
        $reviews = Review::where('product_id', $productId)
                        ->where('is_approved', true)
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return response()->json($reviews);
    }

    /**
     * Update product rating and review count
     */
    private function updateProductRating(Product $product)
    {
        $approvedReviews = $product->reviews()->where('is_approved', true)->get();
        $totalReviews = $product->reviews()->count();
        
        if ($approvedReviews->count() > 0) {
            $averageRating = $approvedReviews->avg('rating');
            $product->update([
                'rating' => round($averageRating, 1),
                'reviews_count' => $totalReviews
            ]);
        } else {
            $product->update([
                'reviews_count' => $totalReviews
            ]);
        }
    }
}
