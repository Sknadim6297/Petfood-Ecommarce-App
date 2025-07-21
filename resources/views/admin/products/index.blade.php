@extends('admin.layouts.app')

@section('title', 'Product Management')

@push('styles')
<style>
/* ========================================
   PRODUCT MANAGEMENT STYLES
======================================== */
.products-management-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.products-header {
    background: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-left: 4px solid #fe5716;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.products-header h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 28px;
}

.products-stats {
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

.products-table-wrapper {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.products-table-header {
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

.btn-add-product {
    background: linear-gradient(135deg, #fe5716, #ff7a3d);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-add-product:hover {
    background: linear-gradient(135deg, #e54e14, #fe5716);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(254, 87, 22, 0.3);
}

.products-table {
    width: 100%;
    border-collapse: collapse;
}

.products-table th {
    background: #f8f9fa;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #e9ecef;
    font-size: 14px;
}

.products-table td {
    padding: 20px 15px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.products-table tr:hover {
    background: rgba(254, 87, 22, 0.02);
}

.product-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.product-image {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    object-fit: cover;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
}

.product-image-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 20px;
}

.product-details h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 16px;
}

.product-sku {
    color: #6c757d;
    font-size: 12px;
    font-style: italic;
}

.product-price {
    text-align: center;
}

.price-current {
    font-weight: 700;
    color: #fe5716;
    font-size: 16px;
}

.price-original {
    color: #6c757d;
    font-size: 12px;
    text-decoration: line-through;
    margin-top: 2px;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 2px;
    display: inline-block;
}

.status-active {
    background: #d1f2eb;
    color: #00695c;
}

.status-inactive {
    background: #f8d7da;
    color: #721c24;
}

.status-featured {
    background: #fff3cd;
    color: #856404;
}

.status-healthy {
    background: #d4edda;
    color: #155724;
}

.status-deal {
    background: #f8d7da;
    color: #721c24;
}

.stock-indicator {
    text-align: center;
}

.stock-badge {
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.stock-in {
    background: #d1f2eb;
    color: #00695c;
}

.stock-out {
    background: #f8d7da;
    color: #721c24;
}

.stock-low {
    background: #fff3cd;
    color: #856404;
}

.category-badge {
    background: #e3f2fd;
    color: #1565c0;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 500;
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

.btn-edit {
    background: #28a745;
    color: white;
}

.btn-edit:hover {
    background: #1e7e34;
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

/* Product Statistics Cards */
.stat-card.total-products {
    border-left-color: #3498db;
}

.stat-card.active-products {
    border-left-color: #2ecc71;
}

.stat-card.featured-products {
    border-left-color: #f39c12;
}

.stat-card.out-of-stock {
    border-left-color: #e74c3c;
}

.stat-card.total-products .stat-number {
    color: #3498db;
}

.stat-card.active-products .stat-number {
    color: #2ecc71;
}

.stat-card.featured-products .stat-number {
    color: #f39c12;
}

.stat-card.out-of-stock .stat-number {
    color: #e74c3c;
}

/* Responsive Design */
@media (max-width: 768px) {
    .products-management-wrapper {
        padding: 15px;
    }
    
    .products-header {
        padding: 20px;
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .products-stats {
        grid-template-columns: 1fr;
    }
    
    .products-table-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .products-table {
        font-size: 12px;
    }
    
    .products-table th,
    .products-table td {
        padding: 10px 8px;
    }
    
    .product-info {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
    }
    
    .product-image,
    .product-image-placeholder {
        width: 50px;
        height: 50px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }
}

/* Animation enhancements */
.products-table-wrapper {
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

.product-info {
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
<div class="products-management-wrapper">
    <!-- Page Header -->
    <div class="products-header">
        <div>
            <h1><i class="fas fa-box me-3"></i>Product Management</h1>
            <p class="mb-0">Manage your product catalog and inventory</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-add-product">
            <i class="fas fa-plus me-2"></i>Add New Product
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="products-stats">
        <div class="stat-card total-products">
            <div class="stat-number">{{ \App\Models\Product::count() }}</div>
            <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-card active-products">
            <div class="stat-number">{{ \App\Models\Product::where('is_active', true)->count() }}</div>
            <div class="stat-label">Active Products</div>
        </div>
        <div class="stat-card featured-products">
            <div class="stat-number">{{ \App\Models\Product::where('is_featured', true)->count() }}</div>
            <div class="stat-label">Featured Products</div>
        </div>
        <div class="stat-card out-of-stock">
            <div class="stat-number">{{ \App\Models\Product::where('stock_quantity', 0)->count() }}</div>
            <div class="stat-label">Out of Stock</div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="products-table-wrapper">
        <div class="products-table-header">
            <h3 class="table-title">All Products ({{ $products->total() }})</h3>
            <div class="table-controls">
                <!-- Future: Add search and filter controls here -->
            </div>
        </div>

        @if($products->count() > 0)
        <table class="products-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <div class="product-info">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="product-image">
                            @else
                                <div class="product-image-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                            <div class="product-details">
                                <h6>{{ $product->name }}</h6>
                                <div class="product-sku">SKU: {{ $product->sku }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($product->category)
                            <span class="category-badge">{{ $product->category->name }}</span>
                        @else
                            <span class="category-badge" style="background: #f8d7da; color: #721c24;">No Category</span>
                        @endif
                    </td>
                    <td>
                        <div class="product-price">
                            @if($product->sale_price)
                                <div class="price-current">₹{{ number_format($product->sale_price, 2) }}</div>
                                <div class="price-original">₹{{ number_format($product->price, 2) }}</div>
                            @else
                                <div class="price-current">₹{{ number_format($product->price, 2) }}</div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="stock-indicator">
                            @if($product->stock_quantity > 10)
                                <span class="stock-badge stock-in">{{ $product->stock_quantity }}</span>
                            @elseif($product->stock_quantity > 0)
                                <span class="stock-badge stock-low">{{ $product->stock_quantity }}</span>
                            @else
                                <span class="stock-badge stock-out">Out of Stock</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div>
                            <span class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            @if($product->is_featured)
                                <span class="status-badge status-featured">Featured</span>
                            @endif
                            @if($product->is_healthy)
                                <span class="status-badge status-healthy">Healthy</span>
                            @endif
                            @if($product->is_deal_of_week)
                                <span class="status-badge status-deal">Deal of Week</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.show', $product) }}" class="btn-action btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" 
                                  method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>No Products Found</h3>
            <p>Create your first product to get started with your catalog.</p>
            <a href="{{ route('admin.products.create') }}" class="btn-add-product">
                <i class="fas fa-plus me-2"></i>Add Your First Product
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Enhanced product management interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth animations
    const tableRows = document.querySelectorAll('.products-table tbody tr');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.1}s`;
        row.classList.add('animate-row');
    });
});

// Add CSS for row animation
const style = document.createElement('style');
style.textContent = `
    .animate-row {
        animation: slideInRight 0.6s ease-out both;
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
`;
document.head.appendChild(style);
</script>
@endpush
