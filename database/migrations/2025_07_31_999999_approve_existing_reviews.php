<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Review;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing reviews to be approved for testing
        Review::query()->update(['is_approved' => true]);
        
        // Add some test reviews if none exist
        if (Review::count() == 0) {
            $products = \App\Models\Product::limit(3)->get();
            
            foreach ($products as $product) {
                Review::create([
                    'product_id' => $product->id,
                    'user_id' => null,
                    'name' => 'Test Customer',
                    'email' => 'test@example.com',
                    'rating' => rand(4, 5),
                    'comment' => 'This is a great product! I really love it and would recommend it to anyone looking for quality pet food.',
                    'is_approved' => true,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
