<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the existing reviews table
        Schema::dropIfExists('reviews');
        
        // Recreate with proper structure
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable(); // Allow null for guest reviews
            $table->string('name');
            $table->string('email');
            $table->integer('rating')->min(1)->max(5);
            $table->text('comment');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            
            // Add foreign key for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // For authenticated users, ensure one review per user per product
            // For guests, we'll handle this in the application logic
            $table->index(['product_id', 'user_id']);
            $table->index(['email', 'product_id']); // For guest review checking
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the recreated table
        Schema::dropIfExists('reviews');
        
        // Recreate the original structure
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->integer('rating')->min(1)->max(5);
            $table->text('comment');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            
            // Ensure one review per user per product
            $table->unique(['product_id', 'user_id']);
        });
    }
};
