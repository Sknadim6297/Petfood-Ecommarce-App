<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ImageLibrary;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show the about page
     */
    public function about()
    {
        return view('frontend.pages.about');
    }

    /**
     * Show the services page
     */
    public function services()
    {
        return view('frontend.pages.services');
    }

    /**
     * Show the service details page
     */
    public function serviceDetails()
    {
        return view('frontend.pages.service-details');
    }

    /**
     * Show the contact page
     */
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    /**
     * Show the how we work page
     */
    public function howWeWork()
    {
        return view('frontend.pages.how-we-work');
    }

    /**
     * Show the gallery page with dynamic images
     */
    public function gallery()
    {
        // Get all active images from the image library
        $images = ImageLibrary::where('status', true)
            ->where('mime_type', 'like', 'image/%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.pages.gallery', compact('images'));
    }

    /**
     * Show the team page
     */
    public function team()
    {
        return view('frontend.pages.team');
    }

    /**
     * Show the pricing page
     */
    public function pricing()
    {
        return view('frontend.pages.pricing');
    }

    /**
     * Show the history page
     */
    public function history()
    {
        return view('frontend.pages.history');
    }
}
