@extends('admin.layouts.app')

@section('title', 'Cooked Foods Management')
@section('page-title', 'Cooked Foods')

@push('styles')
<style>
    .food-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e2e8f0;
    }
    
    .category-badge {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
        border-radius: 1rem;
        font-weight: 600;
    }
    
    .category-fish { background-color: #dbeafe; color: #1e40af; }
    .category-chicken { background-color: #fef3c7; color: #92400e; }
    .category-meat { background-color: #fee2e2; color: #991b1b; }
    .category-egg { background-color: #fef9c3; color: #a16207; }
    .category-other { background-color: #f3f4f6; color: #374151; }
    
    .price-tag {
        font-size: 1.1rem;
        font-weight: 700;
        color: #059669;
    }
    
    .status-toggle {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .status-toggle:hover {
        transform: scale(1.1);
    }
    
    .table-actions {
        white-space: nowrap;
    }
    
    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .search-filters {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0">Cooked Foods Management</h2>
                <p class="text-muted mb-0">Manage your cooked food items</p>
            </div>
            <a href="{{ route('admin.cooked-foods.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Item
            </a>
        </div>

        <!-- Search and Filters -->
        <div class="search-filters">
            <form method="GET" action="{{ route('admin.cooked-foods.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search Items</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" 
                                   class="form-control" 
                                   id="search" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search by name or description...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">All Categories</option>
                            @foreach(\App\Models\CookedFood::getCategories() as $key => $label)
                                <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary flex-fill">
                                <i class="fas fa-filter"></i>
                            </button>
                            <a href="{{ route('admin.cooked-foods.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Cooked Foods Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-utensils me-2"></i>Cooked Food Items
                    <span class="badge bg-primary ms-2">{{ $cookedFoods->total() }}</span>
                </h5>
            </div>
            <div class="card-body p-0">
                @if($cookedFoods->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 80px;">Image</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th style="width: 200px;">Description</th>
                                    <th style="width: 100px;">Status</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cookedFoods as $item)
                                <tr>
                                    <td>
                                        <img src="{{ $item->image_url }}" 
                                             alt="{{ $item->name }}" 
                                             class="food-image">
                                    </td>
                                    <td>
                                        <div>
                                            <h6 class="mb-1">{{ $item->name }}</h6>
                                            <small class="text-muted">{{ $item->slug }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="category-badge category-{{ $item->category }}">
                                            {{ $item->category_label }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="price-tag">{{ $item->formatted_price }}</span>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;" 
                                             title="{{ $item->description }}">
                                            {{ Str::limit($item->description, 50) }}
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm status-toggle {{ $item->status === 'active' ? 'btn-success' : 'btn-secondary' }}"
                                                onclick="toggleStatus({{ $item->id }}, '{{ $item->status }}')"
                                                title="Click to toggle status">
                                            <i class="fas {{ $item->status === 'active' ? 'fa-check' : 'fa-times' }}"></i>
                                            {{ ucfirst($item->status) }}
                                        </button>
                                    </td>
                                    <td class="table-actions">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.cooked-foods.show', $item) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.cooked-foods.edit', $item) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Edit Item">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.cooked-foods.destroy', $item) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="Delete Item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <div class="text-muted">
                            Showing {{ $cookedFoods->firstItem() }} to {{ $cookedFoods->lastItem() }} 
                            of {{ $cookedFoods->total() }} results
                        </div>
                        {{ $cookedFoods->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No cooked food items found</h5>
                        <p class="text-muted mb-4">Start by adding your first cooked food item</p>
                        <a href="{{ route('admin.cooked-foods.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Item
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(itemId, currentStatus) {
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
</script>
@endpush
