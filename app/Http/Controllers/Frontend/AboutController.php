<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutContent;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get the latest active content (newest first)
        $aboutContent = AboutContent::where('is_active', true)
                                  ->orderBy('created_at', 'desc')
                                  ->first();
        
        // If no content exists, create default content
        if (!$aboutContent) {
            $aboutContent = $this->createDefaultContent();
        }
        
        return view('frontend.pages.about', compact('aboutContent'));
    }
    
    private function createDefaultContent()
    {
        return AboutContent::create([
            'title' => 'Welcome to The Pet Care Company',
            'description' => 'Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore et.Lorem ipsumsit amet, consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur.',
            'mission_title' => 'Our Mission',
            'mission_content' => 'To Promote sales of pet products and services in digital platform through E COMMERCE and ensuring delivery of pet products and services at the door step of pet lovers',
            'vision_title' => 'Our Vision',
            'vision_content' => 'To become No. 1 E-COMMERCE portal for pet products and services in India.',
            'features' => [
                'Graceful goldfish, to small, cute kittens',
                'Feeders are either veterinary qualified staff',
                'Experienced pet owners and animal lovers',
                'Hungry horses: whatever the size of your pet'
            ],
            'statistics' => [
                ['number' => '100', 'suffix' => '+', 'title' => 'Clients Served', 'icon' => 'fun-facts-1.png'],
                ['number' => '99', 'suffix' => '%', 'title' => 'Success Rate', 'icon' => 'fun-facts-2.png'],
                ['number' => '2', 'suffix' => 'k', 'title' => 'Happy Pets', 'icon' => 'fun-facts-3.png'],
                ['number' => '400', 'suffix' => '+', 'title' => 'Products', 'icon' => 'fun-facts-4.png']
            ],
            'gallery_title' => 'Pet Care Memories',
            'gallery_subtitle' => 'Gallery Photos',
            'register_title' => 'Register your pet with us and Get 5% off their next order',
            'register_description' => 'We are your local dog home boarding service giving you complete',
            'is_active' => true
        ]);
    }
}
