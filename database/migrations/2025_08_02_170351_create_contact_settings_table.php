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
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->default('Contact Us');
            $table->text('page_subtitle')->nullable();
            $table->string('banner_image')->nullable();
            
            // Hero Section
            $table->string('hero_title')->default('We would love to hear from you.');
            $table->text('hero_description')->default('Expert Pet Care with a personal touch');
            
            // Contact Info Cards
            $table->string('email_title')->default('Email Address.');
            $table->string('email_address')->default('info@petnet.com');
            
            $table->string('phone_title')->default('Phone Number.');
            $table->string('phone_number')->default('+09 121 359 6224');
            $table->string('phone_subtitle')->default('24/7 Support team');
            
            $table->string('hours_title')->default('Working Hours.');
            $table->string('working_hours')->default('9:00 AM - 5:00 PM');
            $table->string('working_days')->default('Monday - Friday');
            
            // Find Branch Section
            $table->string('branch_title')->default('Find a dog walker or pet care');
            $table->text('branch_description')->default('Place your trust in We Love Pets, an award-winning dog walking and pet care');
            $table->string('branch_placeholder')->default('Enter address or postcode...');
            
            // Office Locations
            $table->string('office1_title')->default('Head Office United State:');
            $table->text('office1_address')->default('#201 1218 9th Avenue SE, Calgary, AB T2G 0T1');
            
            $table->string('office2_title')->default('Head Office United State:');
            $table->text('office2_address')->default('#201 1218 9th Avenue SE, Calgary, AB T2G 0T1');
            
            // Contact Form
            $table->string('form_title')->default('Book Your Place or Find out More');
            $table->text('form_textarea_placeholder')->default('Please let us know which day package you\'re interested');
            
            // Awards Section
            $table->string('awards_title')->default('Awards Winning Company');
            $table->boolean('show_awards')->default(true);
            
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
        Schema::dropIfExists('contact_settings');
    }
};
