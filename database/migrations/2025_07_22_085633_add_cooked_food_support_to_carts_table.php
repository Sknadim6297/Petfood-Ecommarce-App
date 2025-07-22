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
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('cooked_food_id')->nullable()->after('product_id');
            $table->enum('item_type', ['product', 'cooked_food'])->default('product')->after('cooked_food_id');
            
            // Make product_id nullable since we can have cooked food items
            $table->unsignedBigInteger('product_id')->nullable()->change();
            
            // Add foreign key for cooked foods
            $table->foreign('cooked_food_id')->references('id')->on('cooked_foods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['cooked_food_id']);
            $table->dropColumn(['cooked_food_id', 'item_type']);
        });
    }
};
