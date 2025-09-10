<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    /**
     * Store a new review
     */
    public function store(Request $request)
    {
        // Debug logging
        Log::info('Review submission attempt', [
            'request_data' => $request->all(),
            'is_ajax' => $request->ajax(),
            'user_id' => Auth::id(),
            'user_authenticated' => Auth::check()
        ]);

        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'required|string|max:1000'
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
            } else {
                // For guest users, check by email and product
                $existingReview = Review::where('product_id', $request->product_id)
                    ->where('email', $request->email)
                    ->whereNull('user_id')
                    ->first();

                if ($existingReview) {
                    return response()->json([
                        'success' => false,
                        'message' => 'A review with this email already exists for this product.'
                    ], 422);
                }
            }

            DB::beginTransaction();

            // Create the review - user_id will be null for guest reviews
            $review = Review::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(), // This will be null for guests
                'name' => $request->name,
                'email' => $request->email,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_approved' => false // Reviews need approval by default
            ]);

            Log::info('Review created successfully', ['review_id' => $review->id]);

            // Update product rating and review count (including unapproved reviews for count)
            $this->updateProductRating($product);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your review! It will be published after approval.',
                'review' => $review
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Review validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Please check all required fields.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Review submission error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
                'debug' => config('app.debug') ? $e->getMessage() : null
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
