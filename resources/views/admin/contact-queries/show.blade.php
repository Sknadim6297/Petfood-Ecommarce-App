@extends('admin.layouts.app')

@section('title', 'Contact Query Details')

@push('styles')
<style>
/* Enhanced Contact Query Show Page Styles - Using Admin Theme Colors */
.query-header {
    background: linear-gradient(135deg, var(--pet-orange) 0%, var(--primary-dark) 100%);
    color: white;
    padding: 2rem;
    border-radius: var(--border-radius);
    margin-bottom: 2rem;
    box-shadow: var(--shadow-lg);
}

.query-header h3 {
    margin: 0;
    font-weight: 600;
}

.query-header .breadcrumb-nav {
    margin-top: 1rem;
    opacity: 0.9;
}

.query-header .breadcrumb-nav a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.query-header .breadcrumb-nav a:hover {
    color: white;
}

.content-card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.content-card .card-header {
    background: linear-gradient(135deg, var(--light-color), #e9ecef);
    border-bottom: 2px solid #dee2e6;
    padding: 1.25rem 1.5rem;
}

.content-card .card-header h5 {
    margin: 0;
    font-weight: 600;
    color: var(--dark-color);
}

.content-card .card-body {
    padding: 1.5rem;
}

.message-content {
    background: var(--light-color);
    border-left: 4px solid var(--pet-orange);
    padding: 1.5rem;
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
    line-height: 1.6;
    font-size: 1rem;
}

.status-actions {
    background: var(--light-color);
    padding: 1rem;
    border-radius: var(--border-radius);
    border: 1px solid #dee2e6;
}

.btn-enhanced {
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius);
    font-weight: 500;
    border: none;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-enhanced:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-read {
    background: var(--secondary-color);
    color: white;
}

.btn-read:hover {
    background: var(--dark-color);
    color: white;
}

.btn-replied {
    background: var(--success-color);
    color: white;
}

.btn-replied:hover {
    background: var(--pet-green);
    color: white;
}

.btn-delete {
    background: var(--danger-color);
    color: white;
}

.btn-delete:hover {
    background: #dc2626;
    color: white;
}

.btn-back {
    background: var(--secondary-color);
    color: white;
}

.btn-back:hover {
    background: var(--dark-color);
    color: white;
}

.info-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 0.25rem;
}

.info-value {
    color: var(--secondary-color);
    margin: 0;
}

.info-value a {
    color: var(--pet-orange);
    text-decoration: none;
}

.info-value a:hover {
    text-decoration: underline;
}

.status-badge-enhanced {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.status-badge-enhanced.unread {
    background: rgba(245, 158, 11, 0.2);
    color: var(--warning-color);
    border: 1px solid var(--warning-color);
}

.status-badge-enhanced.read {
    background: rgba(59, 130, 246, 0.2);
    color: var(--info-color);
    border: 1px solid var(--info-color);
}

.status-badge-enhanced.replied {
    background: rgba(16, 185, 129, 0.2);
    color: var(--success-color);
    border: 1px solid var(--success-color);
}

.pet-badge-show {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: capitalize;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.pet-badge-show.dog {
    background: rgba(254, 220, 79, 0.2);
    color: var(--pet-yellow);
    border: 1px solid var(--pet-yellow);
}

.pet-badge-show.cat {
    background: rgba(59, 130, 246, 0.2);
    color: var(--info-color);
    border: 1px solid var(--info-color);
}

.pet-badge-show.both {
    background: rgba(34, 197, 94, 0.2);
    color: var(--success-color);
    border: 1px solid var(--success-color);
}

.customer-avatar-large {
    width: 60px;
    height: 60px;
    border-radius: var(--border-radius);
    background: linear-gradient(135deg, var(--pet-orange), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.quick-actions {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-top: 1rem;
}

.loading-spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.btn-loading {
    position: relative;
    color: transparent !important;
}

.btn-loading::after {
    content: "";
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    border: 2px solid transparent;
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@media (max-width: 768px) {
    .query-header {
        padding: 1.5rem;
        text-align: center;
    }
    
    .quick-actions {
        flex-direction: column;
    }
    
    .btn-enhanced {
        justify-content: center;
    }
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Enhanced Header -->
    <div class="query-header">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h3><i class="fas fa-envelope-open-text me-2"></i>Contact Query Details</h3>
                <div class="breadcrumb-nav">
                    <a href="{{ route('admin.contact-queries.index') }}">
                        <i class="fas fa-arrow-left me-1"></i>Back to Contact Queries
                    </a>
                </div>
            </div>
            <div class="text-end">
                <div class="mb-2">
                    <span class="status-badge-enhanced {{ $contactQuery->status }}">
                        @if($contactQuery->status === 'unread')
                            <i class="fas fa-exclamation-circle"></i>
                        @elseif($contactQuery->status === 'read')
                            <i class="fas fa-eye"></i>
                        @else
                            <i class="fas fa-check-circle"></i>
                        @endif
                        {{ ucfirst($contactQuery->status) }}
                    </span>
                </div>
                <small>Query #{{ $contactQuery->id }}</small>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <!-- Message Content -->
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="fas fa-comment-alt me-2"></i>Message Content</h5>
                </div>
                <div class="card-body">
                    <h4 class="mb-3 text-primary">{{ $contactQuery->subject }}</h4>
                    <div class="message-content">
                        {{ $contactQuery->message }}
                    </div>
                    
                    <div class="status-actions">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <strong>Current Status:</strong> 
                                <span class="status-badge-enhanced {{ $contactQuery->status }}">
                                    @if($contactQuery->status === 'unread')
                                        <i class="fas fa-exclamation-circle"></i>
                                    @elseif($contactQuery->status === 'read')
                                        <i class="fas fa-eye"></i>
                                    @else
                                        <i class="fas fa-check-circle"></i>
                                    @endif
                                    {{ ucfirst($contactQuery->status) }}
                                </span>
                            </div>
                            <div class="quick-actions">
                                @if($contactQuery->status === 'unread')
                                    <button onclick="updateQueryStatus({{ $contactQuery->id }}, 'read')" 
                                            class="btn btn-enhanced btn-read">
                                        <i class="fas fa-eye"></i>Mark as Read
                                    </button>
                                @endif
                                
                                @if($contactQuery->status !== 'replied')
                                    <button onclick="updateQueryStatus({{ $contactQuery->id }}, 'replied')" 
                                            class="btn btn-enhanced btn-replied">
                                        <i class="fas fa-check"></i>Mark as Replied
                                    </button>
                                @endif
                                
                                <button onclick="deleteQuery({{ $contactQuery->id }})" 
                                        class="btn btn-enhanced btn-delete">
                                    <i class="fas fa-trash"></i>Delete Query
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Contact Actions -->
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="mailto:{{ $contactQuery->email }}?subject=Re: {{ urlencode($contactQuery->subject) }}&body=Dear {{ urlencode($contactQuery->name) }},

Thank you for contacting us. 

Best regards,
PetNet Team" 
                               class="btn btn-enhanced w-100" style="background: #007bff; color: white;">
                                <i class="fas fa-reply"></i>Reply via Email
                            </a>
                        </div>
                        @if($contactQuery->phone)
                        <div class="col-md-6 mb-3">
                            <a href="tel:{{ $contactQuery->phone }}" 
                               class="btn btn-enhanced w-100" style="background: #28a745; color: white;">
                                <i class="fas fa-phone"></i>Call Customer
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="fas fa-user me-2"></i>Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="customer-avatar-large mx-auto">
                            {{ strtoupper(substr($contactQuery->name, 0, 2)) }}
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <p class="info-value">{{ $contactQuery->name }}</p>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Email Address</div>
                        <p class="info-value">
                            <a href="mailto:{{ $contactQuery->email }}">{{ $contactQuery->email }}</a>
                        </p>
                    </div>
                    
                    @if($contactQuery->phone)
                    <div class="info-item">
                        <div class="info-label">Phone Number</div>
                        <p class="info-value">
                            <a href="tel:{{ $contactQuery->phone }}">{{ $contactQuery->phone }}</a>
                        </p>
                    </div>
                    @endif
                    
                    @if($contactQuery->pet_type)
                    <div class="info-item">
                        <div class="info-label">Pet Interest</div>
                        <p class="info-value">
                            <span class="pet-badge-show {{ $contactQuery->pet_type }}">
                                <i class="fas fa-{{ $contactQuery->pet_type === 'dog' ? 'dog' : ($contactQuery->pet_type === 'cat' ? 'cat' : 'paw') }}"></i>
                                {{ ucfirst($contactQuery->pet_type) }}
                            </span>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Query Metadata -->
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle me-2"></i>Query Information</h5>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <div class="info-label">Query ID</div>
                        <p class="info-value">#{{ $contactQuery->id }}</p>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Submitted On</div>
                        <p class="info-value">{{ $contactQuery->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Time Ago</div>
                        <p class="info-value">{{ $contactQuery->created_at->diffForHumans() }}</p>
                    </div>
                    
                    @if($contactQuery->replied_at)
                    <div class="info-item">
                        <div class="info-label">Replied On</div>
                        <p class="info-value text-success">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ $contactQuery->replied_at->format('F j, Y \a\t g:i A') }}
                        </p>
                    </div>
                    @endif
                    
                    <div class="info-item">
                        <div class="info-label">Last Updated</div>
                        <p class="info-value">{{ $contactQuery->updated_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    
                    @if($contactQuery->admin_notes)
                    <div class="info-item">
                        <div class="info-label">Admin Notes</div>
                        <div class="info-value">
                            <div class="p-2 bg-warning bg-opacity-10 rounded border">
                                {{ $contactQuery->admin_notes }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="d-grid">
                <a href="{{ route('admin.contact-queries.index') }}" class="btn btn-enhanced btn-back">
                    <i class="fas fa-arrow-left"></i>Back to All Queries
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-trash-alt text-danger" style="font-size: 3rem;"></i>
                </div>
                <h6 class="mb-3">Delete Contact Query</h6>
                <p class="text-muted">Are you sure you want to permanently delete this contact query from <strong>{{ $contactQuery->name }}</strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone!
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <form id="delete-form" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Enhanced JavaScript for Contact Query Show Page
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success alerts
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            successAlert.classList.add('fade');
            setTimeout(() => {
                successAlert.remove();
            }, 150);
        }, 5000);
    }
});

function updateQueryStatus(queryId, status) {
    // Show confirmation
    const statusText = status.charAt(0).toUpperCase() + status.slice(1);
    if (!confirm(`Are you sure you want to mark this query as ${statusText}?`)) {
        return;
    }

    // Show loading state
    const button = event.target.closest('.btn-enhanced');
    const originalContent = button.innerHTML;
    button.classList.add('btn-loading');
    button.disabled = true;

    // Make API request
    fetch(`/admin/contact-queries/${queryId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Show success notification
            showNotification(`Query status updated to ${statusText} successfully!`, 'success');
            
            // Reload page after short delay
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            throw new Error(data.message || 'Unknown error occurred');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Reset button state
        button.classList.remove('btn-loading');
        button.disabled = false;
        button.innerHTML = originalContent;
        
        // Show error notification
        showNotification('Error updating query status: ' + error.message, 'error');
    });
}

function deleteQuery(id) {
    const form = document.getElementById('delete-form');
    form.action = `/admin/contact-queries/${id}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        max-width: 500px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-radius: 8px;
        border: none;
    `;
    
    const icon = type === 'success' ? 'check-circle' : 
                 type === 'error' ? 'exclamation-circle' : 
                 type === 'warning' ? 'exclamation-triangle' : 'info-circle';
    
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${icon} me-2" style="font-size: 1.2rem;"></i>
            <div>${message}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 150);
    }, 5000);
}

// Add smooth scroll behavior for internal links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading state to email and phone buttons
document.querySelectorAll('a[href^="mailto:"], a[href^="tel:"]').forEach(link => {
    link.addEventListener('click', function() {
        const originalText = this.innerHTML;
        this.innerHTML = '<span class="loading-spinner me-2"></span>' + originalText;
        
        setTimeout(() => {
            this.innerHTML = originalText;
        }, 2000);
    });
});

// Handle delete form submission with loading state
const deleteForm = document.getElementById('delete-form');
if (deleteForm) {
    deleteForm.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;
    });
}

// Add hover effects to action buttons
const actionButtons = document.querySelectorAll('.btn-enhanced');
actionButtons.forEach(button => {
    button.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
    });
    
    button.addEventListener('mouseleave', function() {
        if (!this.classList.contains('btn-loading')) {
            this.style.transform = 'translateY(0)';
        }
    });
});

// Initialize tooltips if Bootstrap is available
if (typeof bootstrap !== 'undefined') {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}
</script>
@endsection


