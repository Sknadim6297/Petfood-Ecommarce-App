@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row g-4 mb-4">
    <!-- Stats Cards -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avatar-lg bg-primary bg-gradient rounded-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Total Users</h6>
                        <h4 class="my-1 fw-bold">12,547</h4>
                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="fas fa-arrow-up me-1"></i>+12.5%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avatar-lg bg-success bg-gradient rounded-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-shopping-cart text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Total Orders</h6>
                        <h4 class="my-1 fw-bold">8,942</h4>
                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="fas fa-arrow-up me-1"></i>+8.7%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avatar-lg bg-info bg-gradient rounded-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-dollar-sign text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Revenue</h6>
                        <h4 class="my-1 fw-bold">$45,890</h4>
                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="fas fa-arrow-up me-1"></i>+15.2%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avatar-lg bg-warning bg-gradient rounded-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-paw text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Active Pets</h6>
                        <h4 class="my-1 fw-bold">2,547</h4>
                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="fas fa-arrow-up me-1"></i>+5.3%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Revenue Chart -->
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom-0 pb-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Revenue Overview</h5>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Last 7 days
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Last 7 days</a></li>
                            <li><a class="dropdown-item" href="#">Last 30 days</a></li>
                            <li><a class="dropdown-item" href="#">Last 6 months</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="col-xl-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom-0 pb-0">
                <h5 class="card-title mb-0">Top Products</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="https://via.placeholder.com/50x50/fa441d/ffffff?text=P1" class="rounded" alt="Product">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Premium Dog Food</h6>
                        <p class="text-muted mb-0 small">1,234 sales</p>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold">$2,890</span>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="https://via.placeholder.com/50x50/10b981/ffffff?text=P2" class="rounded" alt="Product">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Cat Scratching Post</h6>
                        <p class="text-muted mb-0 small">987 sales</p>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold">$1,950</span>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="https://via.placeholder.com/50x50/3b82f6/ffffff?text=P3" class="rounded" alt="Product">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Pet Carrier Bag</h6>
                        <p class="text-muted mb-0 small">756 sales</p>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold">$1,680</span>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="https://via.placeholder.com/50x50/f59e0b/ffffff?text=P4" class="rounded" alt="Product">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Interactive Toy</h6>
                        <p class="text-muted mb-0 small">643 sales</p>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold">$1,290</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-0">
    <!-- Recent Orders -->
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom-0 pb-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Recent Orders</h5>
                    <a href="#" class="btn btn-light btn-sm">View All</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="fw-bold">#ORD-001</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white small fw-bold" style="width: 32px; height: 32px;">
                                                JD
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">John Doe</h6>
                                            <small class="text-muted">john@example.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Premium Dog Food</td>
                                <td><span class="fw-bold">$89.99</span></td>
                                <td><span class="badge bg-success">Delivered</span></td>
                                <td class="text-muted">2 hours ago</td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">#ORD-002</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center text-white small fw-bold" style="width: 32px; height: 32px;">
                                                SM
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Sarah Miller</h6>
                                            <small class="text-muted">sarah@example.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Cat Scratching Post</td>
                                <td><span class="fw-bold">$45.50</span></td>
                                <td><span class="badge bg-warning">Processing</span></td>
                                <td class="text-muted">5 hours ago</td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">#ORD-003</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center text-white small fw-bold" style="width: 32px; height: 32px;">
                                                MB
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Mike Brown</h6>
                                            <small class="text-muted">mike@example.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Pet Carrier Bag</td>
                                <td><span class="fw-bold">$129.99</span></td>
                                <td><span class="badge bg-primary">Shipped</span></td>
                                <td class="text-muted">1 day ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-xl-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom-0 pb-0">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Add New Product
                    </button>
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-users me-2"></i>Manage Users
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="fas fa-chart-bar me-2"></i>View Reports
                    </button>
                    <button class="btn btn-outline-info">
                        <i class="fas fa-cog me-2"></i>Settings
                    </button>
                </div>

                <hr class="my-4">

                <h6 class="mb-3">System Health</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="small">CPU Usage</span>
                        <span class="small fw-bold">45%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 45%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="small">Memory Usage</span>
                        <span class="small fw-bold">72%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 72%"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="small">Storage</span>
                        <span class="small fw-bold">38%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: 38%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-lg {
        width: 60px;
        height: 60px;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
    
    .progress {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .progress-bar {
        border-radius: 10px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Revenue',
                data: [12000, 19000, 15000, 25000, 22000, 30000, 28000],
                borderColor: '#fa441d',
                backgroundColor: 'rgba(250, 68, 29, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
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
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
