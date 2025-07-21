<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tags',
        'status',
        'featured',
        'comments_enabled',
        'views_count',
        'blog_category_id',
        'user_id',
        'published_at'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'comments_enabled' => 'boolean',
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        
        // If image path starts with 'uploads/', add 'storage/' prefix
        if (Str::startsWith($this->image, 'uploads/')) {
            return asset('storage/' . $this->image);
        }
        
        // If image path starts with 'storage/', use as is
        if (Str::startsWith($this->image, 'storage/')) {
            return asset($this->image);
        }
        
        // Otherwise, assume it's just the filename and add full path
        return asset('storage/uploads/blogs/' . $this->image);
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status 
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>';
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 100);
    }

    public function getFormattedPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : 'Not Published';
    }

    // Mutators
    public function incrementViews()
    {
        $this->increment('views_count');
    }
}
