@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
/* ========================================
   DASHBOARD STYLES
======================================== */
.dashboard-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.dashboard-header {
    background: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-left: 4px solid #fe5716;
}

.dashboard-header h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 28px;
}

.dashboard-header p {
    color: #6c757d;
    margin: 0;
    font-size: 16px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--card-color, #fe5716);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-card-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    background: var(--card-color, #fe5716);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.stat-details h3 {
    font-size: 32px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
    font-family: 'DynaPuff', cursive;
}

.stat-label {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
}

.stat-change {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    font-weight: 600;
}

.stat-change.positive {
    color: #10b981;
}

.stat-change.negative {
    color: #ef4444;
}
/* Recent Activity */
.activity-list {
    max-height: 350px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f1f3f4;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: white;
    flex-shrink: 0;
}

.activity-content h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 3px;
    font-size: 14px;
}

.activity-time {
    color: #6c757d;
    font-size: 12px;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.action-card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-card:hover {
    transform: translateY(-3px);
    border-color: #fe5716;
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.2);
    text-decoration: none;
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    background: #fe5716;
    margin: 0 auto 15px;
}

.action-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 8px;
}

.action-description {
    color: #6c757d;
    font-size: 12px;
    margin: 0;
}

/* Recent Tables */
.recent-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

.recent-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.recent-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.recent-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 16px;
    margin: 0;
}

.view-all-link {
    color: #fe5716;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
}

.view-all-link:hover {
    color: #e54e14;
    text-decoration: none;
}

.recent-content {
    padding: 20px 25px;
}

.recent-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f1f3f4;
}

.recent-item:last-child {
    border-bottom: none;
}

.recent-item-info h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 3px;
    font-size: 14px;
}

.recent-item-meta {
    color: #6c757d;
    font-size: 11px;
}

.recent-item-value {
    color: #fe5716;
    font-weight: 700;
    font-size: 14px;
}

/* Custom colors for different stat cards */
.stat-card.users {
    --card-color: #3498db;
}

.stat-card.orders {
    --card-color: #2ecc71;
}

.stat-card.revenue {
    --card-color: #f39c12;
}

.stat-card.products {
    --card-color: #9b59b6;
}

/* Activity icon colors */
.activity-icon.new-order {
    background: #2ecc71;
}

.activity-icon.new-user {
    background: #3498db;
}

.activity-icon.new-product {
    background: #9b59b6;
}

.activity-icon.payment {
    background: #f39c12;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-wrapper {
        padding: 15px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-section {
        grid-template-columns: 1fr;
    }
    
    .recent-section {
        grid-template-columns: 1fr;
    }
    
    .quick-actions {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Animation */
.stat-card {
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
</style>
@endpush

@section('content')
<div class="dashboard-wrapper">
    <!-- Page Header -->
    <div class="dashboard-header">
        <h1><i class="fas fa-tachometer-alt me-3"></i>Dashboard Overview</h1>
        <p>Welcome back! Here's what's happening with your pet store today.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card users">
            <div class="stat-card-content">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-details">
                    <div class="stat-label">Total Customers</div>
                    <h3>{{ \App\Models\User::count() }}</h3>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +12.5% from last month
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card orders">
            <div class="stat-card-content">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-details">
                    <div class="stat-label">Total Orders</div>
                    <h3>{{ \App\Models\Order::count() }}</h3>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +8.3% from last week
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card revenue">
            <div class="stat-card-content">
                <div class="stat-icon">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <div class="stat-details">
                    <div class="stat-label">Total Revenue</div>
                    <h3>₹{{ number_format(\App\Models\Order::sum('total_amount'), 0) }}</h3>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +15.2% from last month
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card products">
            <div class="stat-card-content">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-details">
                    <div class="stat-label">Total Products</div>
                    <h3>{{ \App\Models\Product::count() }}</h3>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +5.7% from last week
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="{{ route('admin.products.create') }}" class="action-card">
            <div class="action-icon">
                <i class="fas fa-plus"></i>
            </div>
            <div class="action-title">Add Product</div>
            <p class="action-description">Add new products to your catalog</p>
        </a>

        <a href="{{ route('admin.categories.create') }}" class="action-card">
            <div class="action-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="action-title">Add Category</div>
            <p class="action-description">Create new product categories</p>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="action-card">
            <div class="action-icon">
                <i class="fas fa-list"></i>
            </div>
            <div class="action-title">View Orders</div>
            <p class="action-description">Manage customer orders</p>
        </a>

        <a href="{{ route('admin.customers.index') }}" class="action-card">
            <div class="action-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="action-title">Manage Customers</div>
            <p class="action-description">View and manage customers</p>
        </a>
    </div>


    <!-- Recent Orders and Products -->
    <div class="recent-section">
        <div class="recent-card">
            <div class="recent-header">
                <h3 class="recent-title">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="view-all-link">View All</a>
            </div>
            <div class="recent-content">
                @foreach(\App\Models\Order::latest()->take(5)->get() as $order)
                <div class="recent-item">
                    <div class="recent-item-info">
                        <h6>Order #{{ $order->id }}</h6>
                        <div class="recent-item-meta">by {{ $order->user->name }} • {{ $order->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="recent-item-value">₹{{ number_format($order->total_amount, 2) }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="recent-card">
            <div class="recent-header">
                <h3 class="recent-title">Top Products</h3>
                <a href="{{ route('admin.products.index') }}" class="view-all-link">View All</a>
            </div>
            <div class="recent-content">
                @foreach(\App\Models\Product::with(['category', 'brand'])->latest()->take(5)->get() as $product)
                <div class="recent-item">
                    <div class="recent-item-info">
                        <h6>{{ $product->name }}</h6>
                        <div class="recent-item-meta">
                            {{ $product->category->name ?? 'No Category' }}
                            @if($product->brand)
                                • {{ $product->brand->name }}
                            @endif
                            • Stock: {{ $product->stock_quantity }}
                        </div>
                    </div>
                    <div class="recent-item-value">₹{{ number_format($product->price, 2) }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Sales Chart
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Sales',
            data: [12000, 19000, 15000, 25000, 22000, 30000, 28000],
            borderColor: '#fe5716',
            backgroundColor: 'rgba(254, 87, 22, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#fe5716',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                },
                ticks: {
                    callback: function(value) {
                        return '₹' + value.toLocaleString();
                    }
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        elements: {
            point: {
                hoverBackgroundColor: '#fe5716'
            }
        }
    }
});

// Animate stat numbers on page load
document.addEventListener('DOMContentLoaded', function() {
    const statNumbers = document.querySelectorAll('.stat-details h3');
    
    statNumbers.forEach(element => {
        const target = parseInt(element.textContent.replace(/[^\d]/g, ''));
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = element.textContent; // Keep original format
                clearInterval(timer);
            } else {
                const formatted = Math.floor(current).toLocaleString();
                if (element.textContent.includes('₹')) {
                    element.textContent = '₹' + formatted;
                } else {
                    element.textContent = formatted;
                }
            }
        }, 20);
    });
});
</script>
@endpush
