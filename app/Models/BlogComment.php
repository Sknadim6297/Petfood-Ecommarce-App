<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'user_id',
        'name',
        'email',
        'comment',
        'is_approved',
        'approved_at'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'approved_at' => 'datetime',
    ];

    // Relationships
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    // Accessors
    public function getAuthorNameAttribute()
    {
        return $this->user ? $this->user->name : $this->name;
    }

    public function getAuthorEmailAttribute()
    {
        return $this->user ? $this->user->email : $this->email;
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_approved 
            ? '<span class="badge bg-success">Approved</span>'
            : '<span class="badge bg-warning">Pending</span>';
    }
}
