<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_description', 
        'company_logo',
        'company_logo_white',
        'email',
        'phone',
        'address',
        'facebook_url',
        'twitter_url', 
        'instagram_url',
        'instagram_handle',
        'linkedin_url',
        'youtube_url',
        'footer_description',
        'footer_copyright',
        'payment_image',
        'working_hours_weekdays',
        'working_hours_weekdays_time',
        'working_hours_weekend', 
        'working_hours_weekend_time',
        'support_text',
        'show_instagram_gallery',
        'instagram_gallery_title',
        'show_quick_links',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_analytics_id',
        'facebook_pixel_id'
    ];

    protected $casts = [
        'quick_links' => 'array',
        'show_instagram_gallery' => 'boolean',
        'is_active' => 'boolean'
    ];

    /**
     * Get the active website settings
     */
    public static function getSettings()
    {
        $settings = self::where('is_active', true)->first() ?? self::first();
        
        if (!$settings) {
            // Create default settings if none exist
            $settings = self::create([
                'company_name' => 'PetNet',
                'email' => 'info@petnet.com',
                'phone' => '+021 01283492',
                'address' => 'Eighth Avenue 487, New York',
                'footer_copyright' => 'PetNet - Copyright 2025. Design by Sk Nadim',
                'instagram_handle' => '@petnet',
                'working_hours_weekdays' => 'Monday - Saturday',
                'working_hours_weekdays_time' => '08AM - 10PM',
                'working_hours_weekend' => 'Sunday',
                'working_hours_weekend_time' => '08AM - 10PM',
                'support_text' => 'Got Questions? Call us 24/7',
                'is_active' => true
            ]);
        }
        
        // Convert to array and add computed properties for backward compatibility
        $settingsArray = $settings->toArray();
        
        // Add mapped properties for template compatibility
        $settingsArray['tagline'] = $settings->company_description;
        $settingsArray['logo'] = $settings->company_logo;
        $settingsArray['footer_logo'] = $settings->company_logo_white;
        $settingsArray['about_description'] = $settings->footer_description;
        $settingsArray['copyright_text'] = $settings->footer_copyright;
        $settingsArray['whatsapp_number'] = $settings->phone;
        
        // Format working hours for display
        if ($settings->working_hours_weekdays && $settings->working_hours_weekdays_time) {
            $settingsArray['working_hours'] = $settings->working_hours_weekdays . ' ' . $settings->working_hours_weekdays_time;
            if ($settings->working_hours_weekend && $settings->working_hours_weekend_time) {
                $settingsArray['working_hours'] .= ', ' . $settings->working_hours_weekend . ' ' . $settings->working_hours_weekend_time;
            }
        }
        
        // Format quick links for template
        if ($settings->quick_links) {
            $settingsArray['quick_links'] = json_encode($settings->quick_links);
        }
        
        return $settingsArray;
    }

    /**
     * Get social media links as array
     */
    public function getSocialLinksAttribute()
    {
        return [
            'facebook' => $this->facebook_url,
            'twitter' => $this->twitter_url,
            'instagram' => $this->instagram_url,
            'linkedin' => $this->linkedin_url,
            'youtube' => $this->youtube_url,
        ];
    }

    /**
     * Get default quick links
     */
    public function getQuickLinksArrayAttribute()
    {
        return $this->quick_links ?? [
            ['title' => 'Dog Boarding Services', 'url' => '#'],
            ['title' => 'Cat Boarding Services', 'url' => '#'],
            ['title' => 'Spa and Grooming Services', 'url' => '#'],
            ['title' => 'Care for Puppy', 'url' => '#'],
            ['title' => 'Service at a Resort', 'url' => '#'],
            ['title' => 'Veterinary Service', 'url' => '#'],
        ];
    }
}
