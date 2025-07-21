<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageLibraryController extends Controller
{
    public function index(Request $request)
    {
        $query = ImageLibrary::with('user');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('original_name', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        // File type filter
        if ($request->filled('type')) {
            switch ($request->type) {
                case 'image':
                    $query->where('mime_type', 'like', 'image/%');
                    break;
                case 'document':
                    $query->whereIn('mime_type', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
                    break;
            }
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['title', 'created_at', 'size', 'original_name'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $images = $query->paginate(12)->withQueryString();

        return view('admin.content.image-library.index', compact('images'));
    }

    public function create()
    {
        return view('admin.content.image-library.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,webp,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // 10MB max
            'title.*' => 'nullable|string|max:255',
            'alt_text.*' => 'nullable|string|max:255',
            'description.*' => 'nullable|string',
            'tags.*' => 'nullable|string',
            'status.*' => 'nullable|boolean'
        ]);

        $uploadedFiles = [];
        $failedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                try {
                    // Check if file is valid first
                    if (!$file->isValid()) {
                        $failedFiles[] = [
                            'name' => $file->getClientOriginalName(),
                            'error' => $this->getUploadErrorMessage($file->getError())
                        ];
                        continue;
                    }

                    $originalName = $file->getClientOriginalName();
                    $filename = time() . '_' . $index . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    
                    // Create uploads directory if it doesn't exist
                    $uploadPath = public_path('uploads/library');
                    if (!file_exists($uploadPath)) {
                        if (!mkdir($uploadPath, 0755, true)) {
                            throw new \Exception('Failed to create upload directory');
                        }
                    }
                    
                    // Use alternative upload method for better reliability
                    $imageContent = file_get_contents($file->getPathname());
                    if ($imageContent === false) {
                        throw new \Exception('Could not read uploaded file');
                    }
                    
                    $fullPath = $uploadPath . DIRECTORY_SEPARATOR . $filename;
                    if (file_put_contents($fullPath, $imageContent) === false) {
                        throw new \Exception('Failed to write file to destination');
                    }
                    
                    $filePath = 'uploads/library/' . $filename;
                    $fileUrl = asset($filePath);

                    // Get image dimensions if it's an image
                    $width = null;
                    $height = null;
                    if (str_starts_with($file->getMimeType(), 'image/')) {
                        $imageSize = getimagesize(public_path($filePath));
                        if ($imageSize) {
                            $width = $imageSize[0];
                            $height = $imageSize[1];
                        }
                    }

                    // Handle tags
                    $tags = null;
                    if (!empty($request->tags[$index])) {
                        $tags = array_map('trim', explode(',', $request->tags[$index]));
                    }

                    $imageData = [
                        'title' => $request->title[$index] ?? pathinfo($originalName, PATHINFO_FILENAME),
                        'filename' => $filename,
                        'original_name' => $originalName,
                        'path' => $filePath,
                        'url' => $fileUrl,
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getSize(),
                        'width' => $width,
                        'height' => $height,
                        'alt_text' => $request->alt_text[$index] ?? null,
                        'description' => $request->description[$index] ?? null,
                        'tags' => $tags,
                        'status' => isset($request->status[$index]) ? (bool)$request->status[$index] : true,
                        'user_id' => session('admin_user')['id'] ?? 1
                    ];

                    $uploadedFiles[] = ImageLibrary::create($imageData);
                    
                } catch (\Exception $e) {
                    $failedFiles[] = [
                        'name' => $originalName,
                        'error' => $e->getMessage()
                    ];
                }
            }
        }

        // Check if this is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            if (count($uploadedFiles) > 0) {
                return response()->json([
                    'success' => true,
                    'message' => count($uploadedFiles) . ' file(s) uploaded successfully',
                    'uploaded' => collect($uploadedFiles)->map(function($file) {
                        return [
                            'id' => $file->id,
                            'title' => $file->title,
                            'filename' => $file->filename,
                            'url' => $file->url
                        ];
                    })->toArray(),
                    'failed' => $failedFiles
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No files were uploaded',
                    'failed' => $failedFiles
                ], 422);
            }
        }

        // Regular form submission
        $message = count($uploadedFiles) === 1 
            ? 'File uploaded successfully.' 
            : count($uploadedFiles) . ' files uploaded successfully.';

        return redirect()->route('admin.content.image-library.index')
                        ->with('success', $message);
    }

    public function show(ImageLibrary $imageLibrary)
    {
        $imageLibrary->load('user');
        $image = $imageLibrary; // Add this line to match the view variable name
        return view('admin.content.image-library.show', compact('image'));
    }

    public function edit(ImageLibrary $imageLibrary)
    {
        return view('admin.content.image-library.edit', compact('imageLibrary'));
    }

    public function update(Request $request, ImageLibrary $imageLibrary)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $data = $request->only(['title', 'alt_text', 'description', 'status']);

        // Handle tags
        if ($request->filled('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }

        $imageLibrary->update($data);

        return redirect()->route('admin.content.image-library.index')
                        ->with('success', 'File updated successfully.');
    }

    public function destroy(ImageLibrary $imageLibrary)
    {
        // Delete file from storage
        if (file_exists(public_path($imageLibrary->path))) {
            unlink(public_path($imageLibrary->path));
        }

        $imageLibrary->delete();

        return redirect()->route('admin.content.image-library.index')
                        ->with('success', 'File deleted successfully.');
    }

    public function toggleStatus(ImageLibrary $imageLibrary)
    {
        $imageLibrary->update(['status' => !$imageLibrary->status]);

        $status = $imageLibrary->status ? 'activated' : 'deactivated';
        
        return response()->json([
            'success' => true,
            'message' => "File {$status} successfully.",
            'status' => $imageLibrary->status
        ]);
    }

    public function download(ImageLibrary $imageLibrary)
    {
        $filePath = public_path($imageLibrary->path);
        
        if (file_exists($filePath)) {
            return response()->download($filePath, $imageLibrary->original_name);
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:image_library,id'
        ]);

        $images = ImageLibrary::whereIn('id', $request->ids)->get();
        
        foreach ($images as $image) {
            // Delete file from storage
            if (file_exists(public_path($image->path))) {
                unlink(public_path($image->path));
            }
            $image->delete();
        }

        $count = count($request->ids);
        $message = $count === 1 ? 'File deleted successfully.' : "{$count} files deleted successfully.";

        return response()->json([
            'success' => true,
            'message' => $message
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
