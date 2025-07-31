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
        Schema::table('products', function (Blueprint $table) {
            // Brand relationship
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null')->after('category_id');
            
            // Additional product information
            $table->text('additional_information')->nullable()->after('description');
            $table->decimal('weight', 8, 2)->nullable()->after('additional_information');
            $table->date('manufactured_date')->nullable()->after('weight');
            $table->date('expiry_date')->nullable()->after('manufactured_date');
            
            // SEO fields
            $table->string('meta_title')->nullable()->after('sort_order');
            $table->text('meta_keywords')->nullable()->after('meta_title');
            $table->text('meta_description')->nullable()->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn([
                'brand_id',
                'additional_information',
                'weight',
                'manufactured_date',
                'expiry_date',
                'meta_title',
                'meta_keywords',
                'meta_description'
            ]);
        });
    }
};
