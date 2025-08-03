<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'pet_type',
        'subject',
        'message',
        'status',
        'replied_at',
        'admin_notes'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'unread' => '<span class="badge bg-warning">Unread</span>',
            'read' => '<span class="badge bg-info">Read</span>',
            'replied' => '<span class="badge bg-success">Replied</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M j, Y \a\t g:i A');
    }
}
