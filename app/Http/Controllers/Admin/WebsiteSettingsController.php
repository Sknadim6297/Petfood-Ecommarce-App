<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingsController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::first() ?? new WebsiteSetting();
        return view('admin.website-settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_logo_white' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'footer_description' => 'nullable|string',
            'footer_copyright' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'instagram_handle' => 'nullable|string|max:50',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'working_hours_weekdays' => 'nullable|string|max:100',
            'working_hours_weekdays_time' => 'nullable|string|max:50',
            'working_hours_weekend' => 'nullable|string|max:100',
            'working_hours_weekend_time' => 'nullable|string|max:50',
            'support_text' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['_token', 'company_logo', 'company_logo_white']);

        // Handle file uploads
        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('website/logo', 'public');
        }

        if ($request->hasFile('company_logo_white')) {
            $data['company_logo_white'] = $request->file('company_logo_white')->store('website/logo', 'public');
        }

        // Get existing settings or create new
        $settings = WebsiteSetting::first();
        
        if ($settings) {
            $settings->update($data);
        } else {
            $data['is_active'] = true;
            WebsiteSetting::create($data);
        }

        return redirect()->route('admin.website.settings.index')
            ->with('success', 'Website settings updated successfully!');
    }

    public function update(Request $request, $id)
    {
        $settings = WebsiteSetting::findOrFail($id);
        
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $data = $request->except(['_token', '_method']);
        $settings->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $settings = WebsiteSetting::findOrFail($id);
        
        // Delete associated files if they exist
        if ($settings->company_logo) {
            Storage::disk('public')->delete($settings->company_logo);
        }
        if ($settings->company_logo_white) {
            Storage::disk('public')->delete($settings->company_logo_white);
        }
        
        $settings->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Settings deleted successfully!'
        ]);
    }
}
