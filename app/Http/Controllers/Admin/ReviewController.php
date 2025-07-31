<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews
     */
    public function index(Request $request)
    {
        $query = Review::with(['product', 'user']);

        // Filter by approval status
        if ($request->has('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        // Filter by product
        if ($request->has('product_id') && $request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        // Filter by rating
        if ($request->has('rating') && $request->rating) {
            $query->where('rating', $request->rating);
        }

        // Search by reviewer name or comment
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(20);
        $products = Product::orderBy('name')->get();

        return view('admin.reviews.index', compact('reviews', 'products'));
    }

    /**
     * Display the specified review
     */
    public function show(Review $review)
    {
        $review->load(['product', 'user']);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Approve a review
     */
    public function approve(Review $review)
    {
        DB::beginTransaction();
        try {
            $review->update(['is_approved' => true]);
            $this->updateProductRating($review->product);
            
            DB::commit();
            return redirect()->back()->with('success', 'Review approved successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to approve review.');
        }
    }

    /**
     * Reject/Unapprove a review
     */
    public function reject(Review $review)
    {
        DB::beginTransaction();
        try {
            $review->update(['is_approved' => false]);
            $this->updateProductRating($review->product);
            
            DB::commit();
            return redirect()->back()->with('success', 'Review rejected successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to reject review.');
        }
    }

    /**
     * Remove the specified review from storage
     */
    public function destroy(Review $review)
    {
        DB::beginTransaction();
        try {
            $product = $review->product;
            $review->delete();
            $this->updateProductRating($product);
            
            DB::commit();
            return redirect()->back()->with('success', 'Review deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to delete review.');
        }
    }

    /**
     * Bulk approve reviews
     */
    public function bulkApprove(Request $request)
    {
        $reviewIds = $request->review_ids;
        
        if (!$reviewIds) {
            return redirect()->back()->with('error', 'No reviews selected.');
        }

        DB::beginTransaction();
        try {
            $reviews = Review::whereIn('id', $reviewIds)->get();
            
            foreach ($reviews as $review) {
                $review->update(['is_approved' => true]);
                $this->updateProductRating($review->product);
            }
            
            DB::commit();
            return redirect()->back()->with('success', count($reviewIds) . ' reviews approved successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to approve reviews.');
        }
    }

    /**
     * Bulk delete reviews
     */
    public function bulkDelete(Request $request)
    {
        $reviewIds = $request->review_ids;
        
        if (!$reviewIds) {
            return redirect()->back()->with('error', 'No reviews selected.');
        }

        DB::beginTransaction();
        try {
            $reviews = Review::whereIn('id', $reviewIds)->get();
            $products = collect();
            
            foreach ($reviews as $review) {
                $products->push($review->product);
                $review->delete();
            }
            
            // Update ratings for affected products
            foreach ($products->unique('id') as $product) {
                $this->updateProductRating($product);
            }
            
            DB::commit();
            return redirect()->back()->with('success', count($reviewIds) . ' reviews deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to delete reviews.');
        }
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
                'rating' => 0,
                'reviews_count' => $totalReviews
            ]);
        }
    }
}
