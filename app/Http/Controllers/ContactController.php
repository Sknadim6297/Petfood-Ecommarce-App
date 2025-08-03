<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'pet_type' => 'nullable|string|max:100',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $contactQuery = ContactQuery::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'pet_type' => $request->pet_type,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // Optional: Send email notification to admin
            // Mail::to(config('mail.admin_email'))->send(new NewContactQuery($contactQuery));

            return back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error sending your message. Please try again.');
        }
    }
}
