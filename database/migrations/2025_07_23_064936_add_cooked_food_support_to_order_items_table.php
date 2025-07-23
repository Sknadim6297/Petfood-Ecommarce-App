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
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('cooked_food_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('item_type')->default('product')->after('product_id'); // 'product' or 'cooked_food'
            
            // Make product_id nullable since we might have cooked food items
            $table->foreignId('product_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['cooked_food_id']);
            $table->dropColumn(['cooked_food_id', 'item_type']);
            
            // Make product_id not nullable again
            $table->foreignId('product_id')->nullable(false)->change();
        });
    }
};
