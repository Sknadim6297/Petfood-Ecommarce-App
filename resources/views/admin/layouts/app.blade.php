<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - PetNet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anybody:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #fa441d;
            --primary-dark: #e8381a;
            --primary-light: #ff6b47;
            --secondary-color: #6c757d;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --sidebar-width: 280px;
            --header-height: 70px;
            --border-radius: 12px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Pet-themed colors to match frontend */
            --pet-orange: #fa441d;
            --pet-yellow: #fedc4f;
            --pet-purple: #940c69;
            --pet-green: #22c55e;
            --pet-blue: #3b82f6;
            --bg-light: #fff8e5;
            --text-dark: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Anybody', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Frontend-matching font styles */
        h1, h2, h3, h4, h5, h6,
        .brand-text,
        .brand-subtitle,
        .nav-section-title,
        .card-header h6,
        .sidebar-brand .brand-text,
        .btn,
        .badge,
        .alert {
            font-family: 'DynaPuff', cursive;
            font-weight: 500;
        }

        .brand-text {
            font-weight: 600;
        }

        .brand-subtitle {
            font-weight: 400;
        }

        h1 { font-size: 2.5rem; font-weight: 700; }
        h2 { font-size: 2rem; font-weight: 600; }
        h3 { font-size: 1.75rem; font-weight: 600; }
        h4 { font-size: 1.5rem; font-weight: 500; }
        h5 { font-size: 1.25rem; font-weight: 500; }
        h6 { font-size: 1rem; font-weight: 500; }

        /* Keep body text in Anybody for readability */
        p, span, div, td, th, input, textarea, select,
        .form-control, .form-label, .nav-text {
            font-family: 'Anybody', sans-serif;
        }

        /* Enhanced styling to match frontend aesthetics */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #e55a4f);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #e55a4f, var(--primary-color));
            transform: translateY(-1px);
        }

        .form-control {
            border-radius: 8px;
            border: 1.5px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(250, 68, 29, 0.25);
        }

        .badge {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        /* Toast Notification System */
        .toast-container {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            min-width: 350px;
            border-left: 4px solid var(--primary-color);
            font-family: 'Anybody', sans-serif;
        }

        .toast.success {
            border-left-color: var(--success-color);
        }

        .toast.error {
            border-left-color: var(--danger-color);
        }

        .toast.warning {
            border-left-color: var(--warning-color);
        }

        .toast.info {
            border-left-color: var(--info-color);
        }

        .toast-header {
            background: transparent;
            border-bottom: none;
            padding: 1rem 1rem 0.5rem 1rem;
        }

        .toast-header strong {
            font-family: 'DynaPuff', cursive;
            font-weight: 600;
            color: var(--text-dark);
        }

        .toast-body {
            padding: 0.5rem 1rem 1rem 1rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .toast-header .btn-close {
            margin: 0;
            padding: 0.25rem;
        }

        .toast-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: white;
            font-size: 12px;
        }

        .toast.success .toast-icon {
            background-color: var(--success-color);
        }

        .toast.error .toast-icon {
            background-color: var(--danger-color);
        }

        .toast.warning .toast-icon {
            background-color: var(--warning-color);
        }

        .toast.info .toast-icon {
            background-color: var(--info-color);
        }

        /* Toast animation */
        .toast.show {
            animation: slideInRight 0.3s ease-out;
        }

        .toast.hide {
            animation: slideOutRight 0.3s ease-in;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--dark-color) 0%, #111827 100%);
            transition: var(--transition);
            z-index: 1000;
            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            color: white;
            font-size: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .brand-text {
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .brand-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 1.5rem 0.75rem;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            border: none;
            background: none;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            color: white;
            background: linear-gradient(90deg, var(--primary-color), transparent);
            border-right: 3px solid var(--primary-color);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary-color);
        }

        .nav-icon {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .nav-text {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--primary-color);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: var(--transition);
        }

        /* Header */
        .header {
            background: white;
            height: var(--header-height);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--dark-color);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .sidebar-toggle:hover {
            background: #f1f5f9;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 0.875rem;
        }

        .breadcrumb-item {
            color: #64748b;
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-search {
            position: relative;
            max-width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(250, 68, 29, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header-btn {
            position: relative;
            background: none;
            border: none;
            color: #64748b;
            font-size: 1.1rem;
            padding: 0.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .header-btn:hover {
            color: var(--dark-color);
            background: #f1f5f9;
        }

        .notification-badge {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            width: 8px;
            height: 8px;
            background: var(--danger-color);
            border-radius: 50%;
        }

        .user-dropdown {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: var(--shadow-md);
        }

        /* Content Area */
        .content {
            padding: 2rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .header-search {
                display: none;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .content {
                padding: 1rem;
            }
        }

        /* Sidebar Overlay for Mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Enhanced Pagination Styles */
        .pagination {
            margin: 0;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
        }

        .pagination .page-item {
            margin: 0 2px;
        }

        .pagination .page-link {
            border: 2px solid #e2e8f0;
            border-radius: var(--border-radius);
            color: var(--text-dark);
            font-weight: 500;
            padding: 12px 16px;
            transition: var(--transition);
            text-decoration: none;
            background-color: white;
            min-width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination .page-link:hover {
            background-color: var(--pet-orange);
            border-color: var(--pet-orange);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--pet-orange);
            border-color: var(--pet-orange);
            color: white;
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .pagination .page-item.disabled .page-link:hover {
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: #94a3b8;
            transform: none;
            box-shadow: none;
        }

        .pagination-info {
            background-color: white;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid #e2e8f0;
            margin-top: 1rem;
        }

        .pagination-lg .page-link {
            padding: 14px 18px;
            font-size: 16px;
        }

        /* Animation for pagination */
        .pagination .page-item {
            transition: var(--transition);
        }

        .pagination .page-item:hover {
            transform: scale(1.05);
        }

        .pagination .page-item.active {
            transform: scale(1.1);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <!-- Brand -->
        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="fas fa-paw"></i>
            </div>
            <div class="brand-text">PetNet</div>
            <div class="brand-subtitle">Admin Panel</div>
        </div>

        <!-- Navigation -->
        <div class="sidebar-nav">
            <!-- Main Navigation -->
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- E-commerce -->
            <div class="nav-section">
                <div class="nav-section-title">E-commerce</div>
                <div class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <span class="nav-text">Products</span>
                        <span class="nav-badge">{{ \App\Models\Product::active()->count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <span class="nav-text">Categories</span>
                        <span class="nav-badge">{{ \App\Models\Category::active()->count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.brands.index') }}" class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-certificate"></i>
                        <span class="nav-text">Brands</span>
                        <span class="nav-badge">{{ \App\Models\Brand::active()->count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.reviews.index') }}" class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <span class="nav-text">Reviews</span>
                        <span class="nav-badge">{{ \App\Models\Review::count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-percent"></i>
                        <span class="nav-text">Coupons</span>
                        <span class="nav-badge">{{ \App\Models\Coupon::active()->count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.cooked-foods.index') }}" class="nav-link {{ request()->routeIs('admin.cooked-foods.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <span class="nav-text">Cooked Foods</span>
                        <span class="nav-badge">{{ \App\Models\CookedFood::active()->count() }}</span>
                    </a>
                </div>
            </div>

            <!-- Order Management -->
            <div class="nav-section">
                <div class="nav-section-title">Order Management</div>
              <div class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <span class="nav-text">Orders</span>
                        <span class="nav-badge">{{ \App\Models\Order::where('status', 'pending')->count() }}</span>
                    </a>
                </div>
            </div>

            <!-- Content Management -->
            <div class="nav-section">
                <div class="nav-section-title">Content Management</div>
                <div class="nav-item">
                    <a href="{{ route('admin.content.blog-categories.index') }}" class="nav-link {{ request()->routeIs('admin.content.blog-categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder"></i>
                        <span class="nav-text">Blog Categories</span>
                        <span class="nav-badge">{{ \App\Models\BlogCategory::count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.content.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.content.blogs.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-blog"></i>
                        <span class="nav-text">Manage Blogs</span>
                        <span class="nav-badge">{{ \App\Models\Blog::count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.content.blog-comments.index') }}" class="nav-link {{ request()->routeIs('admin.content.blog-comments.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments"></i>
                        <span class="nav-text">Blog Comments</span>
                        <span class="nav-badge">{{ \App\Models\BlogComment::count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.content.image-library.index') }}" class="nav-link {{ request()->routeIs('admin.content.image-library.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <span class="nav-text">Image Library</span>
                        <span class="nav-badge">{{ \App\Models\ImageLibrary::count() }}</span>
                    </a>
                </div>
            </div>

            <!-- User Management -->
            <div class="nav-section">
                <div class="nav-section-title">Users</div>
                <div class="nav-item">
                    <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <span class="nav-text">Customers</span>
                        <span class="nav-badge">{{ \App\Models\User::count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <span class="nav-text">Admins</span>
                    </a>
                </div>
            </div>

            <!-- Analytics -->
            <div class="nav-section">
                <div class="nav-section-title">Manage Website</div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <span class="nav-text">Home Page</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <span class="nav-text">About Page</span>
                    </a>
                </div>
            </div>

            <!-- System -->
            <div class="nav-section">
                <div class="nav-section-title">System</div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <span class="nav-text">Settings</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <span class="nav-text">Logs</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                    @if(isset($breadcrumbs))
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @foreach($breadcrumbs as $breadcrumb)
                                    @if($loop->last)
                                        <li class="breadcrumb-item active">{{ $breadcrumb['title'] }}</li>
                                    @else
                                        <li class="breadcrumb-item">
                                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    @endif
                </div>
            </div>

            <div class="header-right">
                <div class="header-search">
                    <input type="text" class="search-input" placeholder="Search...">
                    <i class="search-icon fas fa-search"></i>
                </div>

                <div class="header-actions">
                    <button class="header-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge"></span>
                    </button>
                    <button class="header-btn">
                        <i class="fas fa-envelope"></i>
                    </button>
                    
                    <div class="user-dropdown">
                        <div class="user-avatar" data-bs-toggle="dropdown">
                            A
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="content">
            @yield('content')
        </main>
    </div>

    <!-- jQuery (needed for admin functionality) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle for Mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
            document.body.classList.toggle('sidebar-open');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking on nav links on mobile
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    document.body.classList.remove('sidebar-open');
                }
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                // Implement search functionality
                console.log('Search:', this.value);
            }
        });
    </script>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Toast JavaScript -->
    <script>
        // Toast notification function
        function showToast(message, type = 'success', title = null) {
            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast-' + Date.now();
            
            const icons = {
                success: 'fas fa-check',
                error: 'fas fa-times',
                warning: 'fas fa-exclamation',
                info: 'fas fa-info'
            };
            
            const titles = {
                success: title || 'Success!',
                error: title || 'Error!',
                warning: title || 'Warning!',
                info: title || 'Info!'
            };
            
            const toastHtml = `
                <div class="toast ${type}" role="alert" aria-live="assertive" aria-atomic="true" id="${toastId}">
                    <div class="toast-header">
                        <div class="toast-icon">
                            <i class="${icons[type]}"></i>
                        </div>
                        <strong class="me-auto">${titles[type]}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;
            
            toastContainer.insertAdjacentHTML('beforeend', toastHtml);
            
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 5000
            });
            
            toast.show();
            
            // Remove toast element after it's hidden
            toastElement.addEventListener('hidden.bs.toast', () => {
                toastElement.remove();
            });
        }

        // Check for Laravel session messages and show toasts
        @if(session('success'))
            showToast('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showToast('{{ session('error') }}', 'error');
        @endif

        @if(session('warning'))
            showToast('{{ session('warning') }}', 'warning');
        @endif

        @if(session('info'))
            showToast('{{ session('info') }}', 'info');
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                showToast('{{ $error }}', 'error');
            @endforeach
        @endif

        // Global function to show toasts from anywhere
        window.showToast = showToast;

        // Example: You can now call showToast('Message', 'success') from anywhere

        // Enhanced delete confirmation with sweet styling
        function confirmDelete(event, itemName = 'item') {
            event.preventDefault();
            
            const form = event.target.closest('form');
            
            // Create custom modal
            const modalHtml = `
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 15px; border: none;">
                            <div class="modal-body text-center p-4">
                                <div class="mb-3">
                                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="mb-3" style="font-family: 'poppins', cursive;">Are you sure?</h4>
                                <p class="text-muted mb-4">You are about to delete this ${itemName}. This action cannot be undone.</p>
                                <div class="d-flex gap-3 justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                                        <i class="fas fa-trash me-1"></i>Yes, Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Remove existing modal if any
            const existingModal = document.getElementById('deleteModal');
            if (existingModal) {
                existingModal.remove();
            }
            
            // Add modal to body
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
            
            // Handle confirm button
            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                form.submit();
                modal.hide();
            });
            
            // Clean up modal after hide
            document.getElementById('deleteModal').addEventListener('hidden.bs.modal', function() {
                this.remove();
            });
        }

        // Auto-attach delete confirmation to all delete forms
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
            deleteForms.forEach(form => {
                form.removeAttribute('onsubmit');
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.addEventListener('click', function(e) {
                        confirmDelete(e, 'item');
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
