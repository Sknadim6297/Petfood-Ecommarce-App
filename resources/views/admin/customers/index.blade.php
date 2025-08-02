@extends('admin.layouts.app')

@section('title', 'Customer Management')

@push('styles')
<style>
/* ========================================
   CUSTOMER MANAGEMENT STYLES
======================================== */
.customers-management-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.customers-header {
    background: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-left: 4px solid #fe5716;
}

.customers-header h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 28px;
}

.customers-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    border-left: 4px solid #fe5716;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: #fe5716;
    margin-bottom: 5px;
    font-family: 'Poppins', sans-serif;
}

.stat-label {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
}

.customers-table-wrapper {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.customers-table-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.table-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 18px;
    margin: 0;
}

.table-controls {
    display: flex;
    gap: 15px;
    align-items: center;
    flex-wrap: wrap;
}

.search-box {
    position: relative;
    min-width: 250px;
}

.search-input {
    width: 100%;
    padding: 10px 15px 10px 40px;
    border: 1px solid #ddd;
    border-radius: 25px;
    font-size: 14px;
    background: white;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #fe5716;
    outline: none;
    box-shadow: 0 0 0 3px rgba(254, 87, 22, 0.1);
}

.search-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.filter-select {
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 25px;
    font-size: 14px;
    background: white;
    min-width: 150px;
}

.customers-table {
    width: 100%;
    border-collapse: collapse;
}

.customers-table th {
    background: #f8f9fa;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #e9ecef;
    font-size: 14px;
}

.customers-table td {
    padding: 20px 15px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.customers-table tr:hover {
    background: rgba(254, 87, 22, 0.02);
}

.customer-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.customer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(45deg, #fe5716, #ff7a3d);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 18px;
    flex-shrink: 0;
}

.customer-details h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 16px;
}

.customer-details .customer-email {
    color: #6c757d;
    font-size: 14px;
}

.customer-phone {
    color: #6c757d;
    font-size: 12px;
    font-style: italic;
}

.customer-date {
    color: #6c757d;
    font-size: 14px;
}

.customer-stats {
    text-align: center;
}

.stat-value {
    font-weight: 700;
    color: #2c3e50;
    font-size: 16px;
    display: block;
}

.stat-currency {
    color: #fe5716;
}

.stat-sub {
    color: #6c757d;
    font-size: 12px;
    margin-top: 2px;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease;
}

.status-badge.active {
    background: #d1f2eb;
    color: #00695c;
}

.status-badge.inactive {
    background: #f8d7da;
    color: #721c24;
}

.status-badge:hover {
    transform: scale(1.05);
}

.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.btn-action {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 70px;
    text-align: center;
}

.btn-view {
    background: #007bff;
    color: white;
}

.btn-view:hover {
    background: #0056b3;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.btn-delete:hover {
    background: #c82333;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.pagination-wrapper {
    padding: 20px 25px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 64px;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: #495057;
    margin-bottom: 10px;
}

/* Customer Statistics Cards */
.stat-card.total-customers {
    border-left-color: #3498db;
}

.stat-card.active-customers {
    border-left-color: #2ecc71;
}

.stat-card.new-customers {
    border-left-color: #e74c3c;
}

.stat-card.customers-with-orders {
    border-left-color: #f39c12;
}

.stat-card.total-customers .stat-number {
    color: #3498db;
}

.stat-card.active-customers .stat-number {
    color: #2ecc71;
}

.stat-card.new-customers .stat-number {
    color: #e74c3c;
}

.stat-card.customers-with-orders .stat-number {
    color: #f39c12;
}

/* Order Summary */
.order-summary {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.order-count {
    font-weight: 600;
    color: #2c3e50;
}

.last-order {
    font-size: 11px;
    color: #8b9dc3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .customers-management-wrapper {
        padding: 15px;
    }
    
    .customers-header {
        padding: 20px;
    }
    
    .customers-stats {
        grid-template-columns: 1fr;
    }
    
    .customers-table-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .table-controls {
        flex-direction: column;
        gap: 10px;
    }
    
    .search-box {
        min-width: auto;
    }
    
    .customers-table {
        font-size: 12px;
    }
    
    .customers-table th,
    .customers-table td {
        padding: 10px 8px;
    }
    
    .customer-info {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
    }
    
    .customer-avatar {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }
}

/* Animation enhancements */
.customers-table-wrapper {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.customer-info {
    animation: slideInLeft 0.4s ease-out;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>
@endpush

@section('content')
<div class="customers-management-wrapper">
    <!-- Page Header -->
    <div class="customers-header">
        <h1><i class="fas fa-users me-3"></i>Customer Management</h1>
        <p class="mb-0">Manage all registered customers and their activities</p>
    </div>

    <!-- Statistics Cards -->
    <div class="customers-stats">
        <div class="stat-card total-customers">
            <div class="stat-number">{{ \App\Models\User::count() }}</div>
            <div class="stat-label">Total Customers</div>
        </div>
        <div class="stat-card active-customers">
            <div class="stat-number">{{ \App\Models\User::where('is_active', true)->count() }}</div>
            <div class="stat-label">Active Customers</div>
        </div>
        <div class="stat-card new-customers">
            <div class="stat-number">{{ \App\Models\User::whereDate('created_at', today())->count() }}</div>
            <div class="stat-label">New Today</div>
        </div>
        <div class="stat-card customers-with-orders">
            <div class="stat-number">{{ \App\Models\User::whereHas('orders')->count() }}</div>
            <div class="stat-label">With Orders</div>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="customers-table-wrapper">
        <div class="customers-table-header">
            <h3 class="table-title">All Customers ({{ $customers->total() }})</h3>
            <div class="table-controls">
                <form method="GET" action="{{ route('admin.customers.index') }}" class="d-flex gap-3 align-items-center">
                    <div class="search-box">
                        <i class="search-icon fas fa-search"></i>
                        <input type="text" 
                               name="search" 
                               class="search-input" 
                               placeholder="Search customers..." 
                               value="{{ request('search') }}">
                    </div>
                    
                    <select name="date_filter" class="filter-select">
                        <option value="">All Time</option>
                        <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                        <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>This Week</option>
                        <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>This Month</option>
                        <option value="year" {{ request('date_filter') == 'year' ? 'selected' : '' }}>This Year</option>
                    </select>
                    
                    <select name="order_filter" class="filter-select">
                        <option value="">All Customers</option>
                        <option value="with_orders" {{ request('order_filter') == 'with_orders' ? 'selected' : '' }}>With Orders</option>
                        <option value="no_orders" {{ request('order_filter') == 'no_orders' ? 'selected' : '' }}>No Orders</option>
                    </select>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    
                    @if(request()->hasAny(['search', 'date_filter', 'order_filter']))
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Clear
                    </a>
                    @endif
                </form>
            </div>
        </div>

        @if($customers->count() > 0)
        <table class="customers-table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Registration</th>
                    <th>Orders</th>
                    <th>Total Spent</th>
                    <th>Wishlist</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>
                        <div class="customer-info">
                            <div class="customer-avatar">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                            <div class="customer-details">
                                <h6>{{ $customer->name }}</h6>
                                <div class="customer-email">{{ $customer->email }}</div>
                                @if($customer->phone)
                                <div class="customer-phone">{{ $customer->phone }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="customer-date">{{ $customer->created_at->format('M d, Y') }}</div>
                        <div class="customer-date">{{ $customer->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        <div class="customer-stats">
                            <span class="stat-value">{{ $customer->orders_count }}</span>
                            @if($customer->orders->count() > 0)
                            <div class="stat-sub">
                                Last: {{ $customer->orders->first()->created_at->format('M d') }}
                            </div>
                            @else
                            <div class="stat-sub">No orders yet</div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="customer-stats">
                            <span class="stat-value stat-currency">
                                ₹{{ number_format($customer->orders->sum('total_amount'), 2) }}
                            </span>
                            @if($customer->orders_count > 0)
                            <div class="stat-sub">
                                Avg: ₹{{ number_format($customer->orders->avg('total_amount'), 2) }}
                            </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="customer-stats">
                            <span class="stat-value">{{ $customer->wishlists_count }}</span>
                            <div class="stat-sub">items</div>
                        </div>
                    </td>
                    <td>
                        <button class="status-badge {{ $customer->is_active ? 'active' : 'inactive' }}" 
                                onclick="toggleCustomerStatus({{ $customer->id }}, {{ $customer->is_active ? 'false' : 'true' }})">
                            {{ $customer->is_active ? 'Active' : 'Inactive' }}
                        </button>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn-action btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                            @if($customer->orders_count == 0)
                            <button class="btn-action btn-delete" onclick="deleteCustomer({{ $customer->id }})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $customers->appends(request()->query())->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-users"></i>
            <h3>No Customers Found</h3>
            <p>No customers match your current filters.</p>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Toggle customer status
function toggleCustomerStatus(customerId, newStatus) {
    if (confirm('Are you sure you want to change this customer\'s status?')) {
        fetch(`/admin/customers/${customerId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                location.reload();
            } else {
                showToast(data.message || 'Error updating customer status', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error updating customer status', 'error');
        });
    }
}

// Delete customer
function deleteCustomer(customerId) {
    if (confirm('Are you sure you want to delete this customer? This action cannot be undone.')) {
        fetch(`/admin/customers/${customerId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                location.reload();
            } else {
                showToast(data.message || 'Error deleting customer', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error deleting customer', 'error');
        });
    }
}

// Auto-submit search form on input
let searchTimeout;
document.querySelector('.search-input').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        this.form.submit();
    }, 500);
});
</script>
@endpush
