<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'banner_image',
        'about_image', 
        'main_image',
        'features',
        'mission_title',
        'mission_content',
        'mission_image',
        'vision_title',
        'vision_content',
        'vision_image',
        'statistics',
        'gallery_images',
        'gallery_title',
        'gallery_subtitle',
        'register_title',
        'register_description',
        'register_image',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'statistics' => 'array',
        'gallery_images' => 'array',
        'is_active' => 'boolean'
    ];

    public function getFeaturesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function getStatisticsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function getGalleryImagesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}
