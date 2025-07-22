<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogComment;
use App\Models\Blog;
use App\Models\User;

class BlogCommentSeeder extends Seeder
{
    public function run()
    {
        $blogs = Blog::all();
        
        if ($blogs->count() > 0) {
            // Create some sample comments
            foreach ($blogs->take(2) as $blog) {
                // Approved comment from registered user (if users exist)
                $user = User::first();
                if ($user) {
                    BlogComment::create([
                        'blog_id' => $blog->id,
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'comment' => 'This is a great blog post! Thanks for sharing such valuable information.',
                        'is_approved' => true,
                        'approved_at' => now(),
                    ]);
                }
                
                // Guest comment (pending approval)
                BlogComment::create([
                    'blog_id' => $blog->id,
                    'user_id' => null,
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'comment' => 'I found this article very helpful. Looking forward to more content like this!',
                    'is_approved' => false,
                ]);
                
                // Another approved guest comment
                BlogComment::create([
                    'blog_id' => $blog->id,
                    'user_id' => null,
                    'name' => 'Sarah Wilson',
                    'email' => 'sarah@example.com',
                    'comment' => 'Excellent points made in this post. This really changed my perspective on the topic.',
                    'is_approved' => true,
                    'approved_at' => now(),
                ]);
            }
        }
    }
}
