<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
     * Show the gallery page
     */
    public function gallery()
    {
        return view('frontend.pages.gallery');
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

    /**
     * Show the blog page
     */
    public function blog()
    {
        return view('frontend.blog.index');
    }

    /**
     * Show the blog details page
     */
    public function blogDetails()
    {
        return view('frontend.blog.details');
    }
}
