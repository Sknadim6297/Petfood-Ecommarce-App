<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'user']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('blog_category_id', $request->category);
        }

        // Featured filter
        if ($request->filled('featured')) {
            $query->where('featured', $request->featured === 'yes');
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['title', 'created_at', 'views_count', 'published_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $blogs = $query->paginate(10)->withQueryString();
        $categories = BlogCategory::active()->ordered()->get();

        return view('admin.content.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::active()->ordered()->get();
        return view('admin.content.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Debug: Log incoming request data
        Log::info('Blog Store Request Data:', [
            'all_data' => $request->all(),
            'files' => $request->allFiles(),
            'has_category' => $request->has('blog_category_id'),
            'category_value' => $request->blog_category_id,
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'status' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'comments_enabled' => 'nullable|boolean',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->only([
            'title', 'description', 'content', 'blog_category_id', 'comments_enabled'
        ]);
        
        // Handle boolean fields properly
        $data['status'] = $request->has('status') ? true : false;
        $data['featured'] = $request->has('featured') ? true : false;
        $data['comments_enabled'] = $request->has('comments_enabled') ? true : false;
        
        $data['slug'] = Str::slug($request->title);
        
        // Use session-based admin authentication (consistent with admin middleware)
        $adminUser = session('admin_user');
        if (!$adminUser || !session('is_admin')) {
            Log::error('Admin not authenticated in blog creation', [
                'is_admin' => session('is_admin'),
                'admin_user' => $adminUser,
                'auth_check' => Auth::check(),
                'session_keys' => array_keys(session()->all())
            ]);
            
            return redirect()->route('admin.login')
                ->with('error', 'Please login as admin to continue.');
        }
        
        // Use admin user ID or default to 1 if session doesn't have user ID
        $data['user_id'] = $adminUser['id'] ?? 1;
        $data['published_at'] = $request->published_at ?: now();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            Log::info('File upload attempt', [
                'original_name' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
                'mime_type' => $image->getMimeType(),
                'temp_path' => $image->getPathname(),
                'is_valid' => $image->isValid(),
                'error' => $image->getError()
            ]);
            
            // Check if file is valid
            if ($image->isValid()) {
                try {
                    // Create uploads directory if it doesn't exist
                    $uploadPath = storage_path('app/public/uploads/blogs');
                    if (!file_exists($uploadPath)) {
                        if (!mkdir($uploadPath, 0755, true)) {
                            throw new \Exception('Failed to create upload directory');
                        }
                    }
                    
                    $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                    
                    // Use Laravel's storage method for proper file handling
                    $storedPath = $image->storeAs('uploads/blogs', $imageName, 'public');
                    
                    if (!$storedPath) {
                        throw new \Exception('Failed to store file');
                    }
                    
                    $data['image'] = $storedPath;
                    Log::info('File uploaded successfully', ['path' => $storedPath]);
                    
                } catch (\Exception $e) {
                    Log::error('File upload exception', [
                        'error' => $e->getMessage(),
                        'temp_path' => $image->getPathname(),
                        'exists' => file_exists($image->getPathname())
                    ]);
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Failed to upload image: ' . $e->getMessage());
                }
            } else {
                $errorMessage = $this->getUploadErrorMessage($image->getError());
                Log::error('Invalid file upload', [
                    'error_code' => $image->getError(),
                    'error_message' => $errorMessage,
                    'file_size' => $image->getSize(),
                    'temp_path' => $image->getPathname()
                ]);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid image file: ' . $errorMessage);
            }
        }

        Blog::create($data);

        return redirect()->route('admin.content.blogs.index')
                        ->with('success', 'Blog post created successfully.');
    }

    public function show(Blog $blog)
    {
        $blog->load(['category', 'user', 'comments.user']);
        return view('admin.content.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::active()->ordered()->get();
        return view('admin.content.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->only([
            'title', 'description', 'content', 'blog_category_id',
            'meta_title', 'meta_description', 'status', 'featured', 'published_at'
        ]);
        
        $data['slug'] = Str::slug($request->title);

        // Handle tags
        if ($request->filled('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $storedPath = $image->storeAs('uploads/blogs', $imageName, 'public');
            $data['image'] = $storedPath;
        }

        $blog->update($data);

        return redirect()->route('admin.content.blogs.index')
                        ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        // Delete image if exists
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.content.blogs.index')
                        ->with('success', 'Blog post deleted successfully.');
    }

    public function toggleStatus(Blog $blog)
    {
        $blog->update(['status' => !$blog->status]);

        $status = $blog->status ? 'activated' : 'deactivated';
        
        return response()->json([
            'success' => true,
            'message' => "Blog post {$status} successfully.",
            'status' => $blog->status
        ]);
    }

    public function toggleFeatured(Blog $blog)
    {
        $blog->update(['featured' => !$blog->featured]);

        $featured = $blog->featured ? 'marked as featured' : 'unmarked as featured';
        
        return response()->json([
            'success' => true,
            'message' => "Blog post {$featured} successfully.",
            'featured' => $blog->featured
        ]);
    }

    /**
     * Get human-readable upload error message
     */
    private function getUploadErrorMessage($errorCode)
    {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form';
            case UPLOAD_ERR_PARTIAL:
                return 'The uploaded file was only partially uploaded';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was uploaded';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing a temporary folder';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write file to disk';
            case UPLOAD_ERR_EXTENSION:
                return 'A PHP extension stopped the file upload';
            default:
                return 'Unknown upload error';
        }
    }
}
