<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLibrary extends Model
{
    use HasFactory;

    protected $table = 'image_library';

    protected $fillable = [
        'title',
        'filename',
        'original_name',
        'path',
        'url',
        'mime_type',
        'size',
        'width',
        'height',
        'alt_text',
        'description',
        'tags',
        'status',
        'user_id'
    ];

    protected $casts = [
        'status' => 'boolean',
        'tags' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeImages($query)
    {
        return $query->where('mime_type', 'like', 'image/%');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        return $this->status 
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>';
    }

    public function getFormattedSizeAttribute()
    {
        $bytes = $this->size;
        
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    public function getDimensionsAttribute()
    {
        if ($this->width && $this->height) {
            return $this->width . ' x ' . $this->height . ' px';
        }
        return 'Unknown';
    }
}
