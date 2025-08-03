@extends('admin.layouts.app')

@section('title', 'Contact Queries Management')

@push('styles')
<style>
/* Enhanced Contact Queries Styling - Using Admin Theme Colors */
.contact-queries-header {
    background: linear-gradient(135deg, var(--pet-orange) 0%, var(--primary-dark) 100%);
    color: white;
    padding: 1.5rem;
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-lg);
}

.contact-queries-header h3 {
    margin: 0;
    font-weight: 600;
}

.contact-queries-header .subtitle {
    opacity: 0.9;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.stats-row {
    background: var(--light-color);
    padding: 1rem;
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
}

.stat-card {
    text-align: center;
    padding: 1rem;
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-md);
    transition: var(--transition);
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--secondary-color);
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-card.total .stat-number { color: var(--pet-purple); }
.stat-card.unread .stat-number { color: var(--warning-color); }
.stat-card.read .stat-number { color: var(--info-color); }
.stat-card.replied .stat-number { color: var(--success-color); }

.search-filter-section {
    background: #fff;
    padding: 1.5rem;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-sm);
    margin-bottom: 1.5rem;
}

.enhanced-table {
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.table-header-enhanced {
    background: var(--light-color);
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
}

.bulk-actions-enhanced {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.bulk-select-enhanced {
    min-width: 180px;
    border-radius: 6px;
}

.btn-bulk-apply {
    background: linear-gradient(135deg, var(--pet-orange), var(--primary-dark));
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    transition: var(--transition);
}

.btn-bulk-apply:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--pet-purple));
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(250, 68, 29, 0.4);
}

.table-enhanced {
    margin: 0;
}

.table-enhanced thead th {
    background: var(--light-color);
    border: none;
    padding: 1rem;
    font-weight: 600;
    color: var(--dark-color);
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-enhanced tbody tr {
    border: none;
    transition: var(--transition);
}

.table-enhanced tbody tr:hover {
    background-color: var(--light-color);
}

.table-enhanced tbody td {
    padding: 1rem;
    border: none;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.customer-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.customer-avatar {
    width: 40px;
    height: 40px;
    border-radius: var(--border-radius);
    background: linear-gradient(135deg, var(--pet-orange), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

.customer-details h6 {
    margin: 0 0 0.25rem 0;
    font-weight: 600;
    color: var(--dark-color);
}

.customer-email {
    color: var(--pet-orange);
    text-decoration: none;
    font-size: 0.875rem;
}

.customer-phone {
    color: var(--secondary-color);
    font-size: 0.8rem;
    margin-top: 0.125rem;
}

.subject-content {
    max-width: 300px;
}

.subject-title {
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 0.25rem;
    line-height: 1.4;
}

.message-preview {
    color: var(--secondary-color);
    font-size: 0.875rem;
    line-height: 1.4;
}

.pet-badge-enhanced {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: capitalize;
    gap: 0.25rem;
}

.pet-badge-enhanced.dog {
    background: rgba(254, 220, 79, 0.2);
    color: var(--pet-yellow);
    border: 1px solid var(--pet-yellow);
}

.pet-badge-enhanced.cat {
    background: rgba(59, 130, 246, 0.2);
    color: var(--info-color);
    border: 1px solid var(--info-color);
}

.pet-badge-enhanced.both {
    background: rgba(34, 197, 94, 0.2);
    color: var(--success-color);
    border: 1px solid var(--success-color);
}

.status-badge-enhanced {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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

.date-info {
    color: var(--secondary-color);
    font-size: 0.875rem;
}

.date-primary {
    color: var(--dark-color);
    font-weight: 600;
    margin-bottom: 0.125rem;
}

.action-buttons-enhanced {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn-action-enhanced {
    padding: 0.5rem;
    border: none;
    border-radius: 6px;
    font-size: 0.875rem;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
}

.btn-view-enhanced {
    background: var(--info-color);
    color: white;
}

.btn-view-enhanced:hover {
    background: var(--pet-blue);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-mark-read {
    background: var(--secondary-color);
    color: white;
}

.btn-mark-read:hover {
    background: var(--dark-color);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
}

.btn-mark-replied {
    background: var(--success-color);
    color: white;
}

.btn-mark-replied:hover {
    background: var(--pet-green);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
}

.btn-delete-enhanced {
    background: var(--danger-color);
    color: white;
}

.btn-delete-enhanced:hover {
    background: #dc2626;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.empty-state-enhanced {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--secondary-color);
}

.empty-icon {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 1rem;
}

.filter-tabs-enhanced {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.filter-tab-enhanced {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.875rem;
    transition: var(--transition);
    border: 1px solid #dee2e6;
    background: white;
    color: var(--dark-color);
}

.filter-tab-enhanced:hover {
    border-color: var(--pet-orange);
    color: var(--pet-orange);
    transform: translateY(-1px);
}

.filter-tab-enhanced.active {
    background: var(--pet-orange);
    border-color: var(--pet-orange);
    color: white;
    box-shadow: 0 2px 8px rgba(250, 68, 29, 0.3);
}

.checkbox-enhanced {
    width: 18px;
    height: 18px;
    border-radius: 4px;
    border: 2px solid #dee2e6;
    transition: var(--transition);
}

.checkbox-enhanced:checked {
    background: var(--pet-orange);
    border-color: var(--pet-orange);
}

@media (max-width: 768px) {
    .search-filter-section {
        padding: 1rem;
    }
    
    .filter-tabs-enhanced {
        flex-direction: column;
    }
    
    .bulk-actions-enhanced {
        flex-direction: column;
        align-items: stretch;
    }
    
    .customer-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .action-buttons-enhanced {
        flex-direction: column;
        gap: 0.25rem;
    }
}

/* Loading and Animation States */
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

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Status indicators */
.status-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 0.5rem;
}

.status-indicator.unread { background: var(--warning-color); }
.status-indicator.read { background: var(--info-color); }
.status-indicator.replied { background: var(--success-color); }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Enhanced Header -->
    <div class="contact-queries-header">
        <h3><i class="fas fa-envelope-open-text me-2"></i>Contact Queries Management</h3>
        <div class="subtitle">Manage and respond to customer inquiries efficiently</div>
    </div>

    <!-- Stats Row -->
    <div class="stats-row">
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card total">
                    <div class="stat-number">{{ $stats['total'] }}</div>
                    <div class="stat-label">Total Queries</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card unread">
                    <div class="stat-number">{{ $stats['unread'] }}</div>
                    <div class="stat-label">Unread</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card read">
                    <div class="stat-number">{{ $stats['read'] }}</div>
                    <div class="stat-label">Read</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card replied">
                    <div class="stat-number">{{ $stats['replied'] }}</div>
                    <div class="stat-label">Replied</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="search-filter-section">
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('admin.contact-queries.index') }}" class="d-flex gap-2">
                    <input type="text" class="form-control" name="search" placeholder="Search by name, email, or subject..." value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.contact-queries.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
            <div class="col-md-6">
                <div class="filter-tabs-enhanced">
                    <a href="{{ route('admin.contact-queries.index') }}" 
                       class="filter-tab-enhanced {{ !request('status') ? 'active' : '' }}">
                        All ({{ $stats['total'] }})
                    </a>
                    <a href="{{ route('admin.contact-queries.index', ['status' => 'unread']) }}" 
                       class="filter-tab-enhanced {{ request('status') == 'unread' ? 'active' : '' }}">
                        <span class="status-indicator unread"></span>Unread ({{ $stats['unread'] }})
                    </a>
                    <a href="{{ route('admin.contact-queries.index', ['status' => 'read']) }}" 
                       class="filter-tab-enhanced {{ request('status') == 'read' ? 'active' : '' }}">
                        <span class="status-indicator read"></span>Read ({{ $stats['read'] }})
                    </a>
                    <a href="{{ route('admin.contact-queries.index', ['status' => 'replied']) }}" 
                       class="filter-tab-enhanced {{ request('status') == 'replied' ? 'active' : '' }}">
                        <span class="status-indicator replied"></span>Replied ({{ $stats['replied'] }})
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Table -->
    <div class="enhanced-table">
        @if($contactQueries->count() > 0)
            <!-- Bulk Actions Header -->
            <div class="table-header-enhanced">
                <form id="bulk-action-form" method="POST" action="{{ route('admin.contact-queries.bulk-action') }}">
                    @csrf
                    <div class="bulk-actions-enhanced">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input checkbox-enhanced" id="select-all" onchange="toggleAllCheckboxes(this)">
                            <label for="select-all" class="form-check-label fw-medium">Select All</label>
                        </div>
                        <select name="action" class="form-select bulk-select-enhanced" required>
                            <option value="">Choose Bulk Action</option>
                            <option value="mark_read">Mark as Read</option>
                            <option value="mark_replied">Mark as Replied</option>
                            <option value="delete">Delete Selected</option>
                        </select>
                        <button type="submit" class="btn btn-bulk-apply" onclick="return confirmBulkAction()">
                            <i class="fas fa-bolt me-1"></i>Apply Action
                        </button>
                    </div>
                </form>
            </div>

            <!-- Enhanced Table -->
            <div class="table-responsive">
                <table class="table table-enhanced">
                    <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th>Customer</th>
                            <th>Subject & Message</th>
                            <th>Pet Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contactQueries as $query)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input checkbox-enhanced query-checkbox" 
                                       name="selected_ids[]" value="{{ $query->id }}" form="bulk-action-form">
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($query->name, 0, 2)) }}
                                    </div>
                                    <div class="customer-details">
                                        <h6>{{ $query->name }}
                                            @if($query->status === 'unread')
                                                <span class="badge bg-warning ms-1" style="font-size: 0.65rem;">NEW</span>
                                            @endif
                                        </h6>
                                        <a href="mailto:{{ $query->email }}" class="customer-email">{{ $query->email }}</a>
                                        @if($query->phone)
                                            <div class="customer-phone">
                                                <i class="fas fa-phone me-1"></i>{{ $query->phone }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="subject-content">
                                <div class="subject-title">{{ $query->subject }}</div>
                                <div class="message-preview">{{ Str::limit($query->message, 80) }}</div>
                            </td>
                            <td>
                                @if($query->pet_type)
                                    <span class="pet-badge-enhanced {{ $query->pet_type }}">
                                        <i class="fas fa-{{ $query->pet_type === 'dog' ? 'dog' : ($query->pet_type === 'cat' ? 'cat' : 'paw') }}"></i>
                                        {{ ucfirst($query->pet_type) }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge-enhanced {{ $query->status }}">
                                    {{ ucfirst($query->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="date-info">
                                    <div class="date-primary">{{ $query->created_at->format('M j, Y') }}</div>
                                    <div>{{ $query->created_at->format('g:i A') }}</div>
                                    @if($query->replied_at)
                                        <small class="text-success">
                                            <i class="fas fa-check-circle me-1"></i>Replied {{ $query->replied_at->diffForHumans() }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons-enhanced">
                                    <a href="{{ route('admin.contact-queries.show', $query) }}" 
                                       class="btn btn-action-enhanced btn-view-enhanced" 
                                       title="View Details" data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($query->status === 'unread')
                                        <button onclick="updateQueryStatus({{ $query->id }}, 'read')" 
                                                class="btn btn-action-enhanced btn-mark-read" 
                                                title="Mark as Read" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @endif
                                    
                                    @if($query->status !== 'replied')
                                        <button onclick="updateQueryStatus({{ $query->id }}, 'replied')" 
                                                class="btn btn-action-enhanced btn-mark-replied" 
                                                title="Mark as Replied" data-bs-toggle="tooltip">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                    
                                    <button onclick="deleteQuery({{ $query->id }})" 
                                            class="btn btn-action-enhanced btn-delete-enhanced" 
                                            title="Delete Query" data-bs-toggle="tooltip">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($contactQueries->hasPages())
                <div class="px-3 py-3 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Showing {{ $contactQueries->firstItem() }} to {{ $contactQueries->lastItem() }} 
                            of {{ $contactQueries->total() }} entries
                        </div>
                        <div>
                            {{ $contactQueries->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="empty-state-enhanced">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h5>No Contact Queries Found</h5>
                <p class="text-muted">
                    @if(request('search') || request('status'))
                        No queries match your current filters. Try adjusting your search criteria.
                    @else
                        Contact queries will appear here once customers submit the contact form.
                    @endif
                </p>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.contact-queries.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-times me-1"></i>Clear Filters
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Enhanced Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
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
                <h6 class="mb-3">Are you sure you want to delete this contact query?</h6>
                <p class="text-muted">This action cannot be undone. All information related to this query will be permanently removed.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <form id="delete-form" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete Query
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Enhanced JavaScript functionality for Contact Queries
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add loading states to buttons
    const actionButtons = document.querySelectorAll('.btn-action-enhanced');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (!this.classList.contains('btn-delete-enhanced')) {
                this.classList.add('btn-loading');
                setTimeout(() => {
                    this.classList.remove('btn-loading');
                }, 2000);
            }
        });
    });

    // Enhanced bulk action form handling
    const bulkForm = document.getElementById('bulk-action-form');
    if (bulkForm) {
        bulkForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-bulk-apply');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;
        });
    }

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

function updateQueryStatus(id, status) {
    // Show confirmation
    const statusText = status.charAt(0).toUpperCase() + status.slice(1);
    if (!confirm(`Are you sure you want to mark this query as ${statusText}?`)) {
        return;
    }

    // Show loading state
    const button = event.target.closest('.btn-action-enhanced');
    const originalContent = button.innerHTML;
    button.classList.add('btn-loading');
    button.disabled = true;

    // Make API request
    fetch(`/admin/contact-queries/${id}/status`, {
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
            // Show success message
            showNotification('Query status updated successfully!', 'success');
            
            // Reload page after short delay
            setTimeout(() => {
                location.reload();
            }, 1000);
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
        
        // Show error message
        showNotification('Error updating query status: ' + error.message, 'error');
    });
}

function deleteQuery(id) {
    const form = document.getElementById('delete-form');
    form.action = `/admin/contact-queries/${id}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function toggleAllCheckboxes(source) {
    const checkboxes = document.querySelectorAll('.query-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
    
    // Update bulk action button state
    updateBulkActionState();
}

function updateBulkActionState() {
    const selectedCheckboxes = document.querySelectorAll('.query-checkbox:checked');
    const bulkActionBtn = document.querySelector('.btn-bulk-apply');
    const bulkSelect = document.querySelector('.bulk-select-enhanced');
    
    if (selectedCheckboxes.length > 0) {
        bulkActionBtn.disabled = false;
        bulkSelect.disabled = false;
    } else {
        bulkActionBtn.disabled = true;
        bulkSelect.disabled = true;
    }
}

function confirmBulkAction() {
    const selectedCheckboxes = document.querySelectorAll('.query-checkbox:checked');
    if (selectedCheckboxes.length === 0) {
        showNotification('Please select at least one query.', 'warning');
        return false;
    }

    const action = document.querySelector('[name="action"]').value;
    if (!action) {
        showNotification('Please select an action to perform.', 'warning');
        return false;
    }

    const actionText = action.replace('_', ' ').toLowerCase();
    const count = selectedCheckboxes.length;
    
    return confirm(`Are you sure you want to ${actionText} ${count} selected quer${count === 1 ? 'y' : 'ies'}?`);
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
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    `;
    
    const icon = type === 'success' ? 'check-circle' : 
                 type === 'error' ? 'exclamation-circle' : 
                 type === 'warning' ? 'exclamation-triangle' : 'info-circle';
    
    notification.innerHTML = `
        <i class="fas fa-${icon} me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('fade');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 150);
    }, 5000);
}

// Add event listeners to checkboxes for bulk action state
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('query-checkbox')) {
        updateBulkActionState();
    }
});

// Initialize bulk action state on page load
document.addEventListener('DOMContentLoaded', function() {
    updateBulkActionState();
});
</script>
@endsection
