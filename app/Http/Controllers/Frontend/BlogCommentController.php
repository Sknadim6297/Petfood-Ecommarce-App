<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'name' => 'required_unless:user_id,!=,null|string|max:255',
            'email' => 'required_unless:user_id,!=,null|email|max:255',
        ]);

        $data = [
            'blog_id' => $blog->id,
            'comment' => $request->comment,
            'is_approved' => false, // Comments need approval by default
        ];

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
        }

        BlogComment::create($data);

        return redirect()->back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }

    public function destroy(BlogComment $comment)
    {
        // Only allow users to delete their own comments (if logged in)
        if (Auth::check() && $comment->user_id == Auth::id()) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }
}
