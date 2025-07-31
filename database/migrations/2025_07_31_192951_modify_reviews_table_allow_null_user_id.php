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
        Schema::table('reviews', function (Blueprint $table) {
            // First, drop the unique constraint
            $table->dropUnique(['product_id', 'user_id']);
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Then drop the foreign key constraint
            $table->dropForeign(['user_id']);
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Modify user_id to be nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Add the foreign key constraint back
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Make user_id non-nullable again
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Add back the foreign key and unique constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['product_id', 'user_id']);
        });
    }
};
