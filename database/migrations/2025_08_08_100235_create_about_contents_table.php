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
        Schema::create('about_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Welcome to The Pet Care Company');
            $table->text('description');
            $table->string('banner_image')->nullable();
            $table->string('about_image')->nullable();
            $table->json('features')->nullable(); // For the list items
            
            // Mission & Vision
            $table->text('mission_title')->default('Our Mission');
            $table->text('mission_content');
            $table->string('mission_image')->nullable();
            $table->text('vision_title')->default('Our Vision');
            $table->text('vision_content');
            $table->string('vision_image')->nullable();
            
            // Statistics
            $table->json('statistics')->nullable(); // For counters
            
            // Gallery
            $table->json('gallery_images')->nullable();
            $table->string('gallery_title')->default('Pet Care Memories');
            $table->string('gallery_subtitle')->default('Gallery Photos');
            
            // Registration section
            $table->string('register_title')->default('Register your pet with us and Get 5% off their next order');
            $table->text('register_description')->default('We are your local dog home boarding service giving you complete');
            $table->string('register_image')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_contents');
    }
};
