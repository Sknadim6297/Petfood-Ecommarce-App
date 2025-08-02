<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        $contactSettings = ContactSetting::getSettings();
        
        return view('admin.website.contact.index', compact('contactSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'page_title' => 'required|string|max:255',
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'email_address' => 'required|email|max:255',
            'phone_number' => 'required|string|max:255',
            'working_hours' => 'required|string|max:255',
            'working_days' => 'required|string|max:255',
            'office1_address' => 'required|string',
            'office2_address' => 'required|string',
            'form_title' => 'required|string|max:255',
            'awards_title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $contactSettings = ContactSetting::firstOrNew(['id' => 1]);
        
        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($contactSettings->banner_image) {
                Storage::disk('public')->delete($contactSettings->banner_image);
            }
            
            $path = $request->file('banner_image')->store('contact', 'public');
            $contactSettings->banner_image = $path;
        }

        // Update all fields
        $contactSettings->fill($request->except(['banner_image', '_token']));
        $contactSettings->show_awards = $request->has('show_awards');
        $contactSettings->is_active = $request->has('is_active');
        $contactSettings->save();

        return redirect()->route('admin.website.contact.index')
            ->with('success', 'Contact page settings updated successfully!');
    }
}
