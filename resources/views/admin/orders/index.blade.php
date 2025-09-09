@extends('admin.layouts.app')

@section('title', 'Orders Management')

@push('styles')
<style>
/* ========================================
   ADMIN ORDERS MANAGEMENT STYLES
======================================== */
.orders-management-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.orders-header {
    background: white;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 25px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-left: 4px solid #fe5716;
}

.orders-header h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 28px;
}

.orders-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    border-left: 4px solid #fe5716;
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: #fe5716;
    margin-bottom: 5px;
}

.stat-label {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
}

.orders-table-wrapper {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.table-scroll-container {
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    scrollbar-width: thin;
    scrollbar-color: #fe5716 #f1f1f1;
}

.table-scroll-container::-webkit-scrollbar {
    height: 8px;
}

.table-scroll-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-scroll-container::-webkit-scrollbar-thumb {
    background: #fe5716;
    border-radius: 10px;
}

.table-scroll-container::-webkit-scrollbar-thumb:hover {
    background: #e04d0d;
}

.orders-table-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 18px;
    margin: 0;
}

.filter-controls {
    display: flex;
    gap: 15px;
    align-items: center;
}

.filter-select {
    padding: 8px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    background: white;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
}

.orders-table th {
    background: #f8f9fa;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #e9ecef;
    font-size: 14px;
    white-space: nowrap; /* Prevent header text wrapping */
}

.orders-table td {
    padding: 20px 15px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
    white-space: nowrap; /* Prevent cell content wrapping */
}

.orders-table tr:hover {
    background: rgba(254, 87, 22, 0.02);
}

/* Allow items column to wrap on mobile */
.order-items-preview {
    white-space: normal !important;
    min-width: 200px;
    max-width: 250px;
}

.order-id {
    font-weight: 600;
    color: #fe5716;
    text-decoration: none;
}

.order-id:hover {
    color: #e04a15;
    text-decoration: underline;
}

.customer-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.customer-name {
    font-weight: 600;
    color: #2c3e50;
}

.customer-email {
    font-size: 12px;
    color: #6c757d;
}

.order-date {
    color: #6c757d;
    font-size: 14px;
}

.order-amount {
    font-weight: 700;
    color: #2c3e50;
    font-size: 16px;
}

/* Coupon Display Styles for Admin */
.admin-coupon-info {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
    padding: 4px 8px;
    border-radius: 15px;
    border: 1px solid #c3e6cb;
    font-size: 11px;
    font-weight: 600;
    color: #28a745;
    margin-top: 3px;
}

.admin-coupon-info i {
    font-size: 10px;
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

.status-badge.pending {
    background: #fff3cd;
    color: #856404;
}

.status-badge.confirmed {
    background: #d1ecf1;
    color: #0c5460;
}

.status-badge.processing {
    background: #d4edda;
    color: #155724;
}

.status-badge.shipped {
    background: #cce7ff;
    color: #004085;
}

.status-badge.delivered {
    background: #d1f2eb;
    color: #00695c;
}

.status-badge.cancelled {
    background: #f8d7da;
    color: #721c24;
}

.status-badge:hover {
    transform: scale(1.05);
}

.order-items-preview {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.item-preview {
    font-size: 12px;
    color: #6c757d;
}

.items-count {
    font-size: 11px;
    color: #8b9dc3;
    font-style: italic;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-action {
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-view {
    background: #007bff;
    color: white;
}

.btn-view:hover {
    background: #0056b3;
    color: white;
    text-decoration: none;
}

.btn-edit {
    background: #28a745;
    color: white;
}

.btn-edit:hover {
    background: #1e7e34;
    color: white;
    text-decoration: none;
}

/* Modern Pagination Styling */
.admin-pagination-wrapper {
    padding: 25px;
    background: linear-gradient(145deg, #f8f9fa, #ffffff);
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.pagination-info {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
}

.pagination-info strong {
    color: #2c3e50;
    font-weight: 600;
}

.admin-pagination {
    display: flex;
    align-items: center;
    gap: 8px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.admin-pagination .page-item {
    list-style: none;
}

.admin-pagination .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    height: 42px;
    padding: 0 12px;
    background: #ffffff;
    color: #495057;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
    position: relative;
    overflow: hidden;
}

.admin-pagination .page-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(254, 87, 22, 0.1), transparent);
    transition: left 0.5s;
}

.admin-pagination .page-link:hover::before {
    left: 100%;
}

.admin-pagination .page-link:hover {
    background: #fff5f2;
    color: #fe5716;
    border-color: #fe5716;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 6px 20px rgba(254, 87, 22, 0.2);
}

.admin-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #fe5716, #ff7a3d);
    color: #ffffff;
    border-color: #fe5716;
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.3);
    transform: translateY(-1px);
}

.admin-pagination .page-item.active .page-link:hover {
    background: linear-gradient(135deg, #e54e14, #fe5716);
    transform: translateY(-2px) scale(1.05);
}

.admin-pagination .page-item.disabled .page-link {
    opacity: 0.5;
    pointer-events: none;
    background: #f8f9fa;
    color: #adb5bd;
    border-color: #dee2e6;
    cursor: not-allowed;
}

.admin-pagination .page-link i {
    font-size: 12px;
}

.admin-pagination .page-link[aria-label="Previous"] i {
    margin-right: 4px;
}

.admin-pagination .page-link[aria-label="Next"] i {
    margin-left: 4px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-pagination-wrapper {
        flex-direction: column;
        text-align: center;
        padding: 20px;
        gap: 12px;
    }
    
    .admin-pagination .page-link {
        min-width: 38px;
        height: 38px;
        font-size: 13px;
        border-radius: 10px;
    }
    
    .pagination-info {
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .admin-pagination {
        gap: 4px;
    }
    
    .admin-pagination .page-link {
        min-width: 34px;
        height: 34px;
        font-size: 12px;
        padding: 0 8px;
    }
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

/* Status Update Modal */
.status-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.status-modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    min-width: 400px;
}

.status-modal h3 {
    color: #2c3e50;
    margin-bottom: 20px;
}

.status-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.status-form select {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

.status-form-buttons {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
}

.btn-modal {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-modal.cancel {
    background: #6c757d;
    color: white;
}

.btn-modal.save {
    background: #fe5716;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .orders-management-wrapper {
        padding: 10px;
    }
    
    .orders-header {
        padding: 20px;
    }
    
    .orders-stats {
        grid-template-columns: 1fr;
    }
    
    .orders-table-header {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .filter-controls {
        flex-direction: column;
        gap: 10px;
    }
    
    .orders-table {
        font-size: 12px;
        min-width: 800px; /* Ensure minimum width for horizontal scroll */
    }
    
    .orders-table th,
    .orders-table td {
        padding: 10px 8px;
        white-space: nowrap; /* Prevent text wrapping */
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }
    
    .action-buttons .btn {
        font-size: 11px;
        padding: 5px 10px;
        min-width: 60px; /* Ensure buttons are touch-friendly */
        margin: 2px 0; /* Add some spacing between stacked buttons */
    }
    
    /* Improve touch targets for mobile */
    .orders-table td {
        min-height: 60px; /* Ensure adequate touch target size */
    }
    
    /* Make order ID links more touch-friendly */
    .order-id {
        display: inline-block;
        padding: 5px;
        margin: -5px;
    }
    
    /* Add scroll hint for mobile */
    .table-scroll-container::after {
        content: "← Scroll horizontally to see more →";
        display: block;
        text-align: center;
        font-size: 12px;
        color: #6c757d;
        padding: 10px;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        font-style: italic;
    }
    
    .status-modal-content {
        min-width: 90%;
        margin: 20px;
    }
}

/* Hide scroll hint on larger screens */
@media (min-width: 769px) {
    .table-scroll-container::after {
        display: none;
    }
}
</style>
@endpush

@section('content')
<div class="orders-management-wrapper">
    <!-- Page Header -->
    <div class="orders-header">
        <h1><i class="fas fa-shopping-bag me-3"></i>Orders Management</h1>
        <p class="mb-0">Manage all customer orders and track their status</p>
    </div>

    <!-- Statistics Cards -->
    <div class="orders-stats">
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Order::where('status', 'pending')->count() }}</div>
            <div class="stat-label">Pending Orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Order::where('status', 'processing')->count() }}</div>
            <div class="stat-label">Processing</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Order::where('status', 'shipped')->count() }}</div>
            <div class="stat-label">Shipped</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Order::where('status', 'delivered')->count() }}</div>
            <div class="stat-label">Delivered</div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="orders-table-wrapper">
        <div class="orders-table-header">
            <h3 class="table-title">All Orders ({{ $orders->total() }})</h3>
            <div class="filter-controls">
                <select class="filter-select" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <select class="filter-select" id="dateFilter">
                    <option value="">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                </select>
            </div>
        </div>

        @if($orders->count() > 0)
        <div class="table-scroll-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Items</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="order-id">
                            #{{ $order->order_number }}
                        </a>
                    </td>
                    <td>
                        <div class="customer-info">
                            <div class="customer-name">{{ $order->user->name }}</div>
                            <div class="customer-email">{{ $order->user->email }}</div>
                        </div>
                    </td>
                    <td>
                        <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                        <div class="order-date">{{ $order->created_at->format('h:i A') }}</div>
                    </td>
                    <td>
                        <div class="order-items-preview">
                            @foreach($order->orderItems->take(2) as $item)
                            <div class="item-preview">
                                @if($item->item_type === 'cooked_food' && $item->cookedFood)
                                    {{ $item->cookedFood->name }} ({{ $item->quantity }}x) <span class="badge bg-success">Cooked Food</span>
                                @elseif($item->product)
                                    {{ $item->product->name }} ({{ $item->quantity }}x) <span class="badge bg-primary">Product</span>
                                @else
                                    Unknown Item ({{ $item->quantity }}x) <span class="badge bg-warning">Error</span>
                                @endif
                            </div>
                            @endforeach
                            @if($order->orderItems->count() > 2)
                            <div class="items-count">+{{ $order->orderItems->count() - 2 }} more items</div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="order-amount">₹{{ number_format($order->total_amount, 2) }}</div>
                        @if($order->coupon_code && $order->discount_amount > 0)
                        <div class="admin-coupon-info">
                            <i class="fas fa-tag"></i> {{ $order->coupon_code }} (-₹{{ number_format($order->discount_amount, 2) }})
                        </div>
                        @endif
                    </td>
                    <td>
                        <div class="status-badge {{ $order->payment_status }}">
                            {{ ucfirst($order->payment_status) }}
                        </div>
                    </td>
                    <td>
                        <button class="status-badge {{ $order->status }}" onclick="openStatusModal({{ $order->id }}, '{{ $order->status }}')">
                            {{ ucfirst($order->status) }}
                        </button>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-action btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div> <!-- Close table-scroll-container -->

        <!-- Custom Admin Pagination -->
        <div class="admin-pagination-wrapper">
            <div class="pagination-info">
                <span>Showing <strong>{{ $orders->firstItem() }}</strong> to <strong>{{ $orders->lastItem() }}</strong> of <strong>{{ $orders->total() }}</strong> orders</span>
            </div>
            
            @if ($orders->hasPages())
            <nav aria-label="Order pagination">
                <ul class="admin-pagination">
                    {{-- Previous Page Link --}}
                    @if ($orders->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-label="Previous">
                                <i class="fas fa-chevron-left"></i> Previous
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $start = max(1, $orders->currentPage() - 2);
                        $end = min($orders->lastPage(), $orders->currentPage() + 2);
                    @endphp

                    {{-- First Page --}}
                    @if($start > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $orders->url(1) }}">1</a>
                        </li>
                        @if($start > 2)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                    @endif

                    {{-- Page Numbers --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $orders->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->url($page) }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endfor

                    {{-- Last Page --}}
                    @if($end < $orders->lastPage())
                        @if($end < $orders->lastPage() - 1)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $orders->url($orders->lastPage()) }}">{{ $orders->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($orders->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
                                Next <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" aria-label="Next">
                                Next <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
            @endif
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-shopping-bag"></i>
            <h3>No Orders Yet</h3>
            <p>Orders will appear here when customers start placing them.</p>
        </div>
        @endif
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="status-modal">
    <div class="status-modal-content">
        <h3>Update Order Status</h3>
        <form id="statusForm" class="status-form">
            <input type="hidden" id="orderId">
            <label for="orderStatus">Select New Status:</label>
            <select id="orderStatus" name="status" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <div class="status-form-buttons">
                <button type="button" class="btn-modal cancel" onclick="closeStatusModal()">Cancel</button>
                <button type="submit" class="btn-modal save">Update Status</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Status Modal Functions
function openStatusModal(orderId, currentStatus) {
    document.getElementById('orderId').value = orderId;
    document.getElementById('orderStatus').value = currentStatus;
    document.getElementById('statusModal').style.display = 'block';
}

function closeStatusModal() {
    document.getElementById('statusModal').style.display = 'none';
}

// Handle status form submission
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const orderId = document.getElementById('orderId').value;
    const status = document.getElementById('orderStatus').value;
    
    fetch(`/admin/orders/${orderId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page to show updated status
            location.reload();
        } else {
            alert('Error updating order status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating order status');
    });
});

// Close modal when clicking outside
document.getElementById('statusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});

// Filter functionality (basic implementation)
document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement filtering logic here
    const selectedStatus = this.value;
    if (selectedStatus) {
        window.location.href = `?status=${selectedStatus}`;
    } else {
        window.location.href = window.location.pathname;
    }
});
</script>
@endpush
