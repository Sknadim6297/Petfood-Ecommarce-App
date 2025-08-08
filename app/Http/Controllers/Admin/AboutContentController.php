<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutContentController extends Controller
{
    public function index()
    {
        $aboutContents = AboutContent::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.content.about.index', compact('aboutContents'));
    }

    public function create()
    {
        return view('admin.content.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'mission_title' => 'nullable|string|max:255',
            'mission_content' => 'nullable|string',
            'vision_title' => 'nullable|string|max:255',
            'vision_content' => 'nullable|string',
            'gallery_title' => 'nullable|string|max:255',
            'gallery_subtitle' => 'nullable|string|max:255',
            'register_title' => 'nullable|string|max:255',
            'register_description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mission_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vision_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'register_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'gallery.*.caption' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = $request->only([
            'title', 'description', 'mission_title', 'mission_content', 
            'vision_title', 'vision_content', 'gallery_title', 'gallery_subtitle',
            'register_title', 'register_description'
        ]);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Handle image uploads
        $imageFields = ['main_image', 'mission_image', 'vision_image', 'register_image', 'banner_image', 'about_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('about', 'public');
            }
        }

        // Handle JSON fields
        $data['features'] = $this->processFeatures($request);
        $data['statistics'] = $this->processStatistics($request);
        $data['gallery_images'] = $this->processGallery($request);

        $aboutContent = AboutContent::create($data);

        return redirect()->route('admin.about-content.index')->with('success', 'About content created successfully.');
    }

    public function show(AboutContent $aboutContent)
    {
        return view('admin.content.about.show', compact('aboutContent'));
    }

    public function edit(AboutContent $aboutContent)
    {
        return view('admin.content.about.edit', compact('aboutContent'));
    }

    public function update(Request $request, AboutContent $aboutContent)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'mission_title' => 'nullable|string|max:255',
            'mission_content' => 'nullable|string',
            'vision_title' => 'nullable|string|max:255',
            'vision_content' => 'nullable|string',
            'gallery_title' => 'nullable|string|max:255',
            'gallery_subtitle' => 'nullable|string|max:255',
            'register_title' => 'nullable|string|max:255',
            'register_description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mission_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vision_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'register_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'gallery.*.caption' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = $request->only([
            'title', 'description', 'mission_title', 'mission_content', 
            'vision_title', 'vision_content', 'gallery_title', 'gallery_subtitle',
            'register_title', 'register_description'
        ]);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Handle image uploads
        $imageFields = ['main_image', 'mission_image', 'vision_image', 'register_image', 'banner_image', 'about_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old image
                if ($aboutContent->$field) {
                    Storage::disk('public')->delete($aboutContent->$field);
                }
                $data[$field] = $request->file($field)->store('about', 'public');
            }
        }

        // Handle JSON fields
        $data['features'] = $this->processFeatures($request);
        $data['statistics'] = $this->processStatistics($request);
        $data['gallery_images'] = $this->processGalleryUpdate($request, $aboutContent);

        $aboutContent->update($data);

        return redirect()->route('admin.about-content.index')->with('success', 'About content updated successfully.');
    }

    public function destroy(AboutContent $aboutContent)
    {
        // Delete associated images
        $imageFields = ['main_image', 'mission_image', 'vision_image', 'register_image', 'banner_image', 'about_image'];
        foreach ($imageFields as $field) {
            if ($aboutContent->$field) {
                Storage::disk('public')->delete($aboutContent->$field);
            }
        }

        // Delete gallery images
        if ($aboutContent->gallery_images) {
            foreach ($aboutContent->gallery_images as $image) {
                if (isset($image['image'])) {
                    Storage::disk('public')->delete($image['image']);
                }
            }
        }

        $aboutContent->delete();

        return redirect()->route('admin.about-content.index')->with('success', 'About content deleted successfully.');
    }

    private function processFeatures($request)
    {
        $features = [];
        if ($request->has('features') && is_array($request->features)) {
            foreach ($request->features as $feature) {
                if (!empty($feature['title']) && !empty($feature['description'])) {
                    $features[] = [
                        'title' => $feature['title'],
                        'description' => $feature['description'],
                        'icon' => $feature['icon'] ?? null
                    ];
                }
            }
        }
        return $features;
    }

    private function processStatistics($request)
    {
        $statistics = [];
        if ($request->has('statistics') && is_array($request->statistics)) {
            foreach ($request->statistics as $stat) {
                if (!empty($stat['number']) && !empty($stat['label'])) {
                    $statistics[] = [
                        'number' => $stat['number'],
                        'label' => $stat['label']
                    ];
                }
            }
        }
        return $statistics;
    }

    private function processGallery($request)
    {
        $gallery = [];
        if ($request->has('gallery') && is_array($request->gallery)) {
            foreach ($request->gallery as $index => $item) {
                // Check if there's an uploaded file for this gallery item
                if ($request->hasFile("gallery.{$index}.image")) {
                    $file = $request->file("gallery.{$index}.image");
                    $path = $file->store('gallery', 'public');
                    $gallery[] = [
                        'image' => $path,
                        'caption' => $item['caption'] ?? ''
                    ];
                }
            }
        }
        return $gallery;
    }

    private function processGalleryUpdate($request, $aboutContent)
    {
        $gallery = [];
        
        // Keep existing gallery images if no new ones are uploaded
        if ($aboutContent->gallery_images) {
            $gallery = $aboutContent->gallery_images;
        }
        
        // Add new gallery images
        if ($request->has('gallery') && is_array($request->gallery)) {
            foreach ($request->gallery as $index => $item) {
                // Check if there's an uploaded file for this gallery item
                if ($request->hasFile("gallery.{$index}.image")) {
                    $file = $request->file("gallery.{$index}.image");
                    $path = $file->store('gallery', 'public');
                    $gallery[] = [
                        'image' => $path,
                        'caption' => $item['caption'] ?? ''
                    ];
                }
            }
        }
        
        return $gallery;
    }
}
