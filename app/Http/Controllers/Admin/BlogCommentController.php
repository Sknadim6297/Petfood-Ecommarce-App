<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogComment::with(['blog', 'user']);

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'approved') {
                $query->approved();
            } elseif ($request->status === 'pending') {
                $query->pending();
            }
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('blog', function($blogQuery) use ($search) {
                      $blogQuery->where('title', 'like', "%{$search}%");
                  });
            });
        }

        $comments = $query->latest()->paginate(20)->withQueryString();

        return view('admin.content.blog-comments.index', compact('comments'));
    }

    public function show(BlogComment $comment)
    {
        $comment->load(['blog', 'user']);
        return view('admin.content.blog-comments.show', compact('comment'));
    }

    public function approve(BlogComment $comment)
    {
        $comment->update([
            'is_approved' => true,
            'approved_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment approved successfully.'
        ]);
    }

    public function reject(BlogComment $comment)
    {
        $comment->update([
            'is_approved' => false,
            'approved_at' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment rejected successfully.'
        ]);
    }

    public function destroy(BlogComment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.content.blog-comments.index')
                        ->with('success', 'Comment deleted successfully.');
    }
}
