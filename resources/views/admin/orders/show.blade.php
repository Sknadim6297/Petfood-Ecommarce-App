@extends('admin.layouts.app')

@section('title', 'Order Details - Admin')

@push('styles')
<style>
/* ========================================
   ADMIN ORDER DETAILS STYLES
======================================== */
.order-details-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

/* Breadcrumb Styling */
.breadcrumb {
    background: white;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}

.breadcrumb-item a {
    color: #fe5716;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #e04a15;
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #6c757d;
}

.order-details-header {
    background: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-left: 4px solid #fe5716;
}

.order-title-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 20px;
}

.order-title-left h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 28px;
}

.order-meta-info {
    color: #6c757d;
    font-size: 14px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.order-title-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
}

.status-management {
    display: flex;
    gap: 15px;
    align-items: center;
}

.current-status {
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.current-status.pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.current-status.confirmed {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.current-status.processing {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.current-status.shipped {
    background: #cce7ff;
    color: #004085;
    border: 1px solid #b3d9ff;
}

.current-status.delivered {
    background: #d1f2eb;
    color: #00695c;
    border: 1px solid #a7f3d0;
}

.current-status.cancelled {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.btn-update-status {
    background: linear-gradient(45deg, #fe5716, #ff7a3d);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-update-status:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.4);
    color: white;
}

.order-actions-top {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-action-top {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-print {
    background: #6f42c1;
    color: white;
}

.btn-download {
    background: #20c997;
    color: white;
}

.btn-email {
    background: #17a2b8;
    color: white;
}

.order-content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 25px;
}

.order-main-content {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.order-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.content-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border: 1px solid #f0f2f5;
    position: relative;
    overflow: hidden;
}

.content-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

.card-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 18px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f8f9fa;
    position: relative;
}

.card-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 40px;
    height: 2px;
    background: linear-gradient(90deg, #fe5716, #ff7a3d);
}

/* Order Items Table */
.order-items-table {
    width: 100%;
    border-collapse: collapse;
}

.order-items-table th {
    background: #f8f9fa;
    padding: 12px;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #e9ecef;
    font-size: 14px;
}

.order-items-table td {
    padding: 15px 12px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.item-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.item-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #f1f3f4;
}

.item-details h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 14px;
}

.item-details .item-meta {
    color: #6c757d;
    font-size: 12px;
}

.quantity-display {
    text-align: center;
    font-weight: 600;
    color: #2c3e50;
}

.price-display {
    text-align: right;
    font-weight: 600;
    color: #fe5716;
}

/* Order Summary */
.order-summary {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    color: #495057;
}

.summary-row.total {
    font-weight: 700;
    font-size: 18px;
    color: #2c3e50;
    border-top: 2px solid #e9ecef;
    margin-top: 15px;
    padding-top: 15px;
}

.summary-row.total .amount {
    color: #fe5716;
}

/* Customer Information */
.customer-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
}

.customer-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
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
}

.customer-info h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
}

.customer-info .text-muted {
    font-size: 14px;
}

.customer-details {
    color: #6c757d;
    line-height: 1.6;
}

.customer-details strong {
    color: #2c3e50;
    display: block;
    margin-bottom: 5px;
}

/* Address Cards */
.address-card {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    margin-bottom: 15px;
}

.address-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.address-content {
    color: #6c757d;
    line-height: 1.6;
}

/* Order Timeline */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #fe5716;
    border: 3px solid white;
    box-shadow: 0 0 0 3px #fe5716;
}

.timeline-item.completed::before {
    background: #28a745;
    box-shadow: 0 0 0 3px #28a745;
}

.timeline-content {
    background: white;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.timeline-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.timeline-time {
    font-size: 12px;
    color: #6c757d;
}

/* Management Actions */
.management-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-top: 20px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    justify-content: center;
}

.action-btn-primary {
    background: linear-gradient(45deg, #fe5716, #ff7a3d);
    color: white;
}

.action-btn-secondary {
    background: #6c757d;
    color: white;
}

.action-btn-success {
    background: #28a745;
    color: white;
}

.action-btn-warning {
    background: #ffc107;
    color: #212529;
}

.action-btn-danger {
    background: #dc3545;
    color: white;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    color: inherit;
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
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    min-width: 500px;
    max-width: 90%;
}

.status-modal h3 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 24px;
}

.status-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    width: 100%;
}

.form-control:focus {
    border-color: #fe5716;
    outline: none;
    box-shadow: 0 0 0 3px rgba(254, 87, 22, 0.1);
}

.status-form-buttons {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 20px;
}

.btn-modal {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
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

.btn-modal:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .order-details-wrapper {
        padding: 15px;
    }
    
    .order-title-section {
        flex-direction: column;
        align-items: stretch;
    }
    
    .order-title-right {
        align-items: flex-start;
    }
    
    .status-management {
        flex-direction: column;
        align-items: stretch;
    }
    
    .order-content-grid {
        grid-template-columns: 1fr;
    }
    
    .management-actions {
        grid-template-columns: 1fr;
    }
    
    .status-modal-content {
        min-width: 90%;
        margin: 20px;
    }
}
</style>
@endpush

@section('content')
<div class="order-details-wrapper">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order #{{ $order->order_number }}</li>
        </ol>
    </nav>

    <!-- Order Header -->
    <div class="order-details-header">
        <div class="order-title-section">
            <div class="order-title-left">
                <h1><i class="fas fa-shopping-cart me-3"></i>Order #{{ $order->order_number }}</h1>
                <div class="order-meta-info">
                    <div><i class="fas fa-calendar me-2"></i>Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</div>
                    <div><i class="fas fa-credit-card me-2"></i>Payment: {{ $order->payment_method == 'cash_on_delivery' ? 'Cash on Delivery' : 'Online Payment' }}</div>
                    <div><i class="fas fa-info-circle me-2"></i>Payment Status: {{ ucfirst($order->payment_status) }}</div>
                </div>
            </div>
            <div class="order-title-right">
                <div class="status-management">
                    <div class="current-status {{ $order->status }}">{{ ucfirst($order->status) }}</div>
                    <button class="btn-update-status" onclick="openStatusModal()">
                        <i class="fas fa-edit me-2"></i>Update Status
                    </button>
                </div>
                <div class="order-actions-top">
                    <button class="btn-action-top btn-print" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Print
                    </button>
                    <button class="btn-action-top btn-download">
                        <i class="fas fa-download me-1"></i>Download PDF
                    </button>
                    <button class="btn-action-top btn-email">
                        <i class="fas fa-envelope me-1"></i>Email Customer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="order-content-grid">
        <!-- Main Content -->
        <div class="order-main-content">
            <!-- Order Items -->
            <div class="content-card">
                <h3 class="card-title"><i class="fas fa-box me-2"></i>Order Items</h3>
                <table class="order-items-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>
                                <div class="item-info">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/img/product-placeholder.jpg') }}" 
                                         alt="{{ $item->product->name }}" class="item-image">
                                    <div class="item-details">
                                        <h6>{{ $item->product->name }}</h6>
                                        <div class="item-meta">SKU: {{ $item->product->id }}</div>
                                        @if($item->product->short_description)
                                        <div class="item-meta">{{ Str::limit($item->product->short_description, 50) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="quantity-display">{{ $item->quantity }}</td>
                            <td class="price-display">₹{{ number_format($item->price, 2) }}</td>
                            <td class="price-display">₹{{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Order Summary -->
                <div class="order-summary mt-4">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>₹{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span>{{ $order->shipping_amount == 0 ? 'Free' : '₹' . number_format($order->shipping_amount, 2) }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total Amount:</span>
                        <span class="amount">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="content-card">
                <h3 class="card-title"><i class="fas fa-shipping-fast me-2"></i>Shipping Information</h3>
                <div class="address-card">
                    <div class="address-title">
                        <i class="fas fa-map-marker-alt"></i>Delivery Address
                    </div>
                    <div class="address-content">
                        <strong>{{ $order->user->name }}</strong><br>
                        {{ $order->shipping_address }}<br>
                        <strong>Phone:</strong> {{ $order->phone }}<br>
                        <strong>Email:</strong> {{ $order->email }}
                    </div>
                </div>
                
                @if($order->order_notes)
                <div class="address-card">
                    <div class="address-title">
                        <i class="fas fa-sticky-note"></i>Order Notes
                    </div>
                    <div class="address-content">
                        {{ $order->order_notes }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="order-sidebar">
            <!-- Customer Information -->
            <div class="content-card">
                <h4 class="card-title"><i class="fas fa-user me-2"></i>Customer</h4>
                <div class="customer-card">
                    <div class="customer-header">
                        <div class="customer-avatar">
                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                        </div>
                        <div class="customer-info">
                            <h6>{{ $order->user->name }}</h6>
                            <div class="text-muted">Customer since {{ $order->user->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                    <div class="customer-details">
                        <strong>Email:</strong> {{ $order->user->email }}<br>
                        <strong>Phone:</strong> {{ $order->phone }}<br>
                        <strong>Total Orders:</strong> {{ $order->user->orders()->count() }}<br>
                        <strong>Customer ID:</strong> #{{ $order->user->id }}
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="content-card">
                <h4 class="card-title"><i class="fas fa-history me-2"></i>Order Timeline</h4>
                <div class="timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-content">
                            <div class="timeline-title">Order Placed</div>
                            <div class="timeline-time">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                    @if(in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered']))
                    <div class="timeline-item completed">
                        <div class="timeline-content">
                            <div class="timeline-title">Order Confirmed</div>
                            <div class="timeline-time">{{ $order->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                    <div class="timeline-item completed">
                        <div class="timeline-content">
                            <div class="timeline-title">Processing Started</div>
                            <div class="timeline-time">{{ $order->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    @if(in_array($order->status, ['shipped', 'delivered']))
                    <div class="timeline-item completed">
                        <div class="timeline-content">
                            <div class="timeline-title">Order Shipped</div>
                            <div class="timeline-time">{{ $order->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    @if($order->status == 'delivered')
                    <div class="timeline-item completed">
                        <div class="timeline-content">
                            <div class="timeline-title">Order Delivered</div>
                            <div class="timeline-time">{{ $order->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="content-card">
                <h4 class="card-title"><i class="fas fa-tools me-2"></i>Quick Actions</h4>
                <div class="management-actions">
                    @if(in_array($order->status, ['pending', 'confirmed']))
                    <button class="action-btn action-btn-success" onclick="updateOrderStatus('confirmed')">
                        <i class="fas fa-check"></i>Confirm Order
                    </button>
                    <button class="action-btn action-btn-warning" onclick="updateOrderStatus('processing')">
                        <i class="fas fa-cogs"></i>Start Processing
                    </button>
                    @endif
                    
                    @if($order->status == 'processing')
                    <button class="action-btn action-btn-primary" onclick="updateOrderStatus('shipped')">
                        <i class="fas fa-shipping-fast"></i>Mark as Shipped
                    </button>
                    @endif
                    
                    @if($order->status == 'shipped')
                    <button class="action-btn action-btn-success" onclick="updateOrderStatus('delivered')">
                        <i class="fas fa-home"></i>Mark as Delivered
                    </button>
                    @endif
                    
                    @if(!in_array($order->status, ['delivered', 'cancelled']))
                    <button class="action-btn action-btn-danger" onclick="updateOrderStatus('cancelled')">
                        <i class="fas fa-times"></i>Cancel Order
                    </button>
                    @endif
                    
                    <a href="{{ route('admin.orders.index') }}" class="action-btn action-btn-secondary">
                        <i class="fas fa-arrow-left"></i>Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="status-modal">
    <div class="status-modal-content">
        <h3>Update Order Status</h3>
        <form id="statusForm" class="status-form">
            <div class="form-group">
                <label for="orderStatus">Select New Status:</label>
                <select id="orderStatus" name="status" class="form-control" required>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="statusNote">Status Update Note (Optional):</label>
                <textarea id="statusNote" name="note" class="form-control" rows="3" placeholder="Add a note about this status update..."></textarea>
            </div>
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
function openStatusModal() {
    document.getElementById('statusModal').style.display = 'block';
}

function closeStatusModal() {
    document.getElementById('statusModal').style.display = 'none';
}

// Quick action to update status
function updateOrderStatus(status) {
    if (confirm(`Are you sure you want to update the order status to "${status}"?`)) {
        document.getElementById('orderStatus').value = status;
        updateStatus();
    }
}

// Update status function
function updateStatus() {
    const status = document.getElementById('orderStatus').value;
    const note = document.getElementById('statusNote').value;
    
    fetch(`/admin/orders/{{ $order->id }}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ 
            status: status,
            note: note 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            alert('Order status updated successfully!');
            // Reload the page to show updated status
            location.reload();
        } else {
            alert('Error updating order status: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating order status');
    });
}

// Handle status form submission
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    updateStatus();
});

// Close modal when clicking outside
document.getElementById('statusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});

// Print function
function printOrder() {
    window.print();
}

// Download PDF function
function downloadPDF() {
    alert('PDF download functionality would be implemented here');
}

// Email customer function
function emailCustomer() {
    alert('Email customer functionality would be implemented here');
}
</script>
@endpush
