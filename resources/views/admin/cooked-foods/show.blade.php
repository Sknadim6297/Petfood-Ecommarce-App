@extends('admin.layouts.app')

@section('title', 'View Cooked Food Item')
@section('page-title', 'View Cooked Food Item')

@push('styles')
<style>
    .detail-section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }
    
    .detail-section h5 {
        color: #374151;
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 0.75rem;
        margin-bottom: 1.5rem;
    }
    
    .food-image {
        width: 100%;
        max-width: 400px;
        height: 300px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .category-badge {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .category-fish { background-color: #dbeafe; color: #1e40af; }
    .category-chicken { background-color: #fef3c7; color: #92400e; }
    .category-meat { background-color: #fee2e2; color: #991b1b; }
    .category-egg { background-color: #fef9c3; color: #a16207; }
    .category-other { background-color: #f3f4f6; color: #374151; }
    
    .price-display {
        font-size: 2rem;
        font-weight: 700;
        color: #059669;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        padding: 1rem 2rem;
        border-radius: 12px;
        text-align: center;
        border: 2px solid #10b981;
    }
    
    .status-badge {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-weight: 600;
    }
    
    .status-active {
        background-color: #d1fae5;
        color: #059669;
    }
    
    .status-inactive {
        background-color: #f3f4f6;
        color: #6b7280;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #374151;
        min-width: 120px;
    }
    
    .info-value {
        color: #6b7280;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }
        
        .action-buttons .btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0">{{ $cookedFood->name }}</h2>
                <p class="text-muted mb-0">View cooked food item details</p>
            </div>
            <div class="action-buttons">
                <a href="{{ route('admin.cooked-foods.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
                <a href="{{ route('admin.cooked-foods.edit', $cookedFood) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Item
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Basic Information -->
                <div class="detail-section">
                    <h5><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                    
                    <div class="info-item">
                        <div class="info-label">Item Name:</div>
                        <div class="info-value">{{ $cookedFood->name }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">URL Slug:</div>
                        <div class="info-value">
                            <code>{{ $cookedFood->slug }}</code>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Category:</div>
                        <div class="info-value">
                            @php
                                $categoryIcons = [
                                    'fish' => 'fas fa-fish',
                                    'chicken' => 'fas fa-drumstick-bite',
                                    'meat' => 'fas fa-hamburger',
                                    'egg' => 'fas fa-egg',
                                    'other' => 'fas fa-utensils'
                                ];
                            @endphp
                            <span class="category-badge category-{{ $cookedFood->category }}">
                                <i class="{{ $categoryIcons[$cookedFood->category] ?? 'fas fa-utensils' }}"></i>
                                {{ $cookedFood->category_label }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Status:</div>
                        <div class="info-value">
                            <span class="status-badge status-{{ $cookedFood->status }}">
                                <i class="fas {{ $cookedFood->status === 'active' ? 'fa-check' : 'fa-times' }} me-1"></i>
                                {{ ucfirst($cookedFood->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Created:</div>
                        <div class="info-value">{{ $cookedFood->created_at->format('M d, Y \a\t h:i A') }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Last Updated:</div>
                        <div class="info-value">{{ $cookedFood->updated_at->format('M d, Y \a\t h:i A') }}</div>
                    </div>
                </div>

                <!-- Description -->
                <div class="detail-section">
                    <h5><i class="fas fa-align-left me-2"></i>Description</h5>
                    <div class="text-muted">
                        {{ $cookedFood->description }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Image -->
                <div class="detail-section text-center">
                    <h5><i class="fas fa-image me-2"></i>Item Image</h5>
                    <img src="{{ $cookedFood->image_url }}" 
                         alt="{{ $cookedFood->name }}" 
                         class="food-image">
                </div>

                <!-- Price -->
                <div class="detail-section">
                    <h5><i class="fas fa-rupee-sign me-2"></i>Price</h5>
                    <div class="price-display">
                        {{ $cookedFood->formatted_price }}
                    </div>
                </div>

                <!-- Actions -->
                <div class="detail-section">
                    <h5><i class="fas fa-cogs me-2"></i>Actions</h5>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.cooked-foods.edit', $cookedFood) }}" 
                           class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Item
                        </a>
                        
                        <button type="button" 
                                class="btn btn-{{ $cookedFood->status === 'active' ? 'warning' : 'success' }}"
                                onclick="toggleStatus({{ $cookedFood->id }}, '{{ $cookedFood->status }}')">
                            <i class="fas {{ $cookedFood->status === 'active' ? 'fa-pause' : 'fa-play' }} me-2"></i>
                            {{ $cookedFood->status === 'active' ? 'Deactivate' : 'Activate' }}
                        </button>
                        
                        <form action="{{ route('admin.cooked-foods.destroy', $cookedFood) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this item? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Delete Item
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(itemId, currentStatus) {
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    const action = currentStatus === 'active' ? 'deactivate' : 'activate';
    
    if (confirm(`Are you sure you want to ${action} this item?`)) {
        fetch(`/admin/cooked-foods/${itemId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                // Refresh the page to update the status
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showToast('Failed to update status', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred', 'error');
        });
    }
}
</script>
@endpush
