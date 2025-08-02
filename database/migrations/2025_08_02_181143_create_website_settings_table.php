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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            
            // Company Information
            $table->string('company_name')->default('PetNet');
            $table->text('company_description')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_logo_white')->nullable(); // For dark backgrounds
            
            // Contact Information
            $table->string('email')->default('info@petnet.com');
            $table->string('phone')->default('+021 01283492');
            $table->text('address')->default('Eighth Avenue 487, New York');
            
            // Social Media Links
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('instagram_handle')->default('@petnet');
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();
            
            // Footer Settings
            $table->text('footer_description')->nullable();
            $table->string('footer_copyright')->default('PetNet - Copyright 2025. Design by Sk Nadim');
            $table->string('payment_image')->nullable();
            
            // Working Hours
            $table->string('working_hours_weekdays')->default('Monday - Saturday');
            $table->string('working_hours_weekdays_time')->default('08AM - 10PM');
            $table->string('working_hours_weekend')->default('Sunday');
            $table->string('working_hours_weekend_time')->default('08AM - 10PM');
            $table->string('support_text')->default('Got Questions? Call us 24/7');
            
            // Instagram Gallery
            $table->boolean('show_instagram_gallery')->default(true);
            $table->string('instagram_gallery_title')->default('Follow @petnet');
            
            // Quick Links (JSON for flexible management)
            $table->json('quick_links')->nullable();
            
            // Meta
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
