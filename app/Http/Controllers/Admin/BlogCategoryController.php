<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogCategory::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['name', 'created_at', 'sort_order'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $categories = $query->paginate(10)->withQueryString();

        return view('admin.content.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.content.blog-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->only(['name', 'description', 'status', 'sort_order']);
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            if ($image->isValid()) {
                try {
                    // Create uploads directory if it doesn't exist
                    $uploadPath = public_path('uploads/blog-categories');
                    if (!file_exists($uploadPath)) {
                        if (!mkdir($uploadPath, 0755, true)) {
                            throw new \Exception('Failed to create upload directory');
                        }
                    }
                    
                    $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                    
                    // Use alternative upload method for better reliability
                    $imageContent = file_get_contents($image->getPathname());
                    if ($imageContent === false) {
                        throw new \Exception('Could not read uploaded file');
                    }
                    
                    $fullPath = $uploadPath . DIRECTORY_SEPARATOR . $imageName;
                    if (file_put_contents($fullPath, $imageContent) === false) {
                        throw new \Exception('Failed to write file to destination');
                    }
                    
                    $data['image'] = 'uploads/blog-categories/' . $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Failed to upload image: ' . $e->getMessage());
                }
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid image file uploaded.');
            }
        }

        BlogCategory::create($data);

        return redirect()->route('admin.content.blog-categories.index')
                        ->with('success', 'Blog category created successfully.');
    }

    public function show(BlogCategory $blogCategory)
    {
        $blogCategory->load('blogs');
        return view('admin.content.blog-categories.show', compact('blogCategory'));
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.content.blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blogCategory->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->only(['name', 'description', 'status', 'sort_order']);
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blogCategory->image && file_exists(public_path($blogCategory->image))) {
                unlink(public_path($blogCategory->image));
            }

            $image = $request->file('image');
            
            if ($image->isValid()) {
                try {
                    $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                    
                    // Use alternative upload method for better reliability
                    $imageContent = file_get_contents($image->getPathname());
                    if ($imageContent === false) {
                        throw new \Exception('Could not read uploaded file');
                    }
                    
                    $uploadPath = public_path('uploads/blog-categories');
                    $fullPath = $uploadPath . DIRECTORY_SEPARATOR . $imageName;
                    if (file_put_contents($fullPath, $imageContent) === false) {
                        throw new \Exception('Failed to write file to destination');
                    }
                    
                    $data['image'] = 'uploads/blog-categories/' . $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Failed to upload image: ' . $e->getMessage());
                }
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid image file uploaded.');
            }
        }

        $blogCategory->update($data);

        return redirect()->route('admin.content.blog-categories.index')
                        ->with('success', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        // Delete image if exists
        if ($blogCategory->image && file_exists(public_path($blogCategory->image))) {
            unlink(public_path($blogCategory->image));
        }

        $blogCategory->delete();

        return redirect()->route('admin.content.blog-categories.index')
                        ->with('success', 'Blog category deleted successfully.');
    }

    public function toggleStatus(BlogCategory $blogCategory)
    {
        $blogCategory->update(['status' => !$blogCategory->status]);

        $status = $blogCategory->status ? 'activated' : 'deactivated';
        
        return response()->json([
            'success' => true,
            'message' => "Blog category {$status} successfully.",
            'status' => $blogCategory->status
        ]);
    }
}
