@extends('admin.layouts.app')

@section('title', 'About Content Management')

@push('styles')
<style>
/* ========================================
   ABOUT CONTENT MANAGEMENT STYLES
======================================== */
.about-management-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.about-header {
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

.about-header h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 28px;
}

.about-stats {
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

.about-table-wrapper {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.about-table-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: between;
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
}

.search-box input {
    padding-left: 40px;
    border-radius: 25px;
    border: 1px solid #e9ecef;
    width: 250px;
}

.search-box::before {
    content: '\f002';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    z-index: 10;
}

.filter-dropdown select {
    border-radius: 8px;
    border: 1px solid #e9ecef;
    padding: 8px 15px;
}

.btn-primary {
    background: linear-gradient(135deg, #fe5716 0%, #ff8c42 100%);
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #ff8c42 0%, #fe5716 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(254, 87, 22, 0.4);
}

.table {
    margin: 0;
}

.table thead th {
    background: #2c3e50;
    color: white;
    border: none;
    padding: 15px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
}

.table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f0f0f0;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.table tbody td {
    padding: 15px;
    vertical-align: middle;
    border: none;
}

.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.badge-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.badge-danger {
    background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
    color: white;
}

.action-buttons {
    display: flex;
    gap: 5px;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 6px;
    font-weight: 500;
}

.btn-outline-primary {
    border-color: #fe5716;
    color: #fe5716;
}

.btn-outline-primary:hover {
    background: #fe5716;
    border-color: #fe5716;
    color: white;
}

.btn-outline-success {
    border-color: #28a745;
    color: #28a745;
}

.btn-outline-success:hover {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

.btn-outline-danger {
    border-color: #dc3545;
    color: #dc3545;
}

.btn-outline-danger:hover {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
}

.pagination-wrapper {
    background: white;
    padding: 20px 25px;
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: between;
    align-items: center;
}

@media (max-width: 768px) {
    .about-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .about-stats {
        grid-template-columns: 1fr;
    }
    
    .about-table-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .table-controls {
        justify-content: center;
    }
    
    .search-box input {
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<div class="about-management-wrapper">
    <!-- Header Section -->
    <div class="about-header">
        <div>
            <h1><i class="fas fa-info-circle me-3"></i>About Content Management</h1>
            <p class="text-muted mb-0">Manage your website's about page content, mission, vision, and more</p>
        </div>
        <div>
            <a href="{{ route('admin.about-content.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Content
            </a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="about-stats">
        <div class="stat-card">
            <div class="stat-number">{{ $aboutContents->total() }}</div>
            <div class="stat-label">Total Content</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $aboutContents->where('is_active', true)->count() }}</div>
            <div class="stat-label">Active Content</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $aboutContents->where('is_active', false)->count() }}</div>
            <div class="stat-label">Inactive Content</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $aboutContents->where('created_at', '>=', now()->subDays(30))->count() }}</div>
            <div class="stat-label">This Month</div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="about-table-wrapper">
        <div class="about-table-header">
            <h3 class="table-title">
                <i class="fas fa-list me-2"></i>About Content List
            </h3>
            <div class="table-controls">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search content..." id="searchInput">
                </div>
                <div class="filter-dropdown">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="aboutTable">
                <thead>
                    <tr>
                        <th width="5%">
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th width="15%">Title</th>
                        <th width="20%">Description</th>
                        <th width="15%">Mission & Vision</th>
                        <th width="10%">Statistics</th>
                        <th width="10%">Status</th>
                        <th width="15%">Created</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aboutContents as $content)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input row-checkbox" value="{{ $content->id }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-semibold">{{ Str::limit($content->title, 30) }}</h6>
                                    <small class="text-muted">ID: {{ $content->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 text-muted">{{ Str::limit($content->description, 50) }}</p>
                        </td>
                        <td>
                            <div>
                                @if($content->mission_title)
                                    <small class="d-block"><strong>Mission:</strong> {{ Str::limit($content->mission_title, 20) }}</small>
                                @endif
                                @if($content->vision_title)
                                    <small class="d-block"><strong>Vision:</strong> {{ Str::limit($content->vision_title, 20) }}</small>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($content->statistics)
                                <span class="badge bg-info">{{ count($content->statistics) }} Stats</span>
                            @else
                                <span class="text-muted">No Stats</span>
                            @endif
                        </td>
                        <td>
                            @if($content->is_active)
                                <span class="badge badge-success">
                                    <i class="fas fa-check me-1"></i>Active
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <i class="fas fa-times me-1"></i>Inactive
                                </span>
                            @endif
                        </td>
                        <td>
                            <div>
                                <small class="d-block fw-semibold">{{ $content->created_at->format('M d, Y') }}</small>
                                <small class="text-muted">{{ $content->created_at->format('H:i A') }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.about-content.show', $content->id) }}" 
                                   class="btn btn-outline-primary btn-sm" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.about-content.edit', $content->id) }}" 
                                   class="btn btn-outline-success btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.about-content.destroy', $content->id) }}" 
                                      method="POST" class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this content?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                <h5>No About Content Found</h5>
                                <p>Start by creating your first about content.</p>
                                <a href="{{ route('admin.about-content.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Create First Content
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($aboutContents->hasPages())
        <div class="pagination-wrapper">
            <div>
                <span class="text-muted">
                    Showing {{ $aboutContents->firstItem() }} to {{ $aboutContents->lastItem() }} 
                    of {{ $aboutContents->total() }} results
                </span>
            </div>
            <div>
                {{ $aboutContents->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const table = document.getElementById('aboutTable');
    
    searchInput.addEventListener('keyup', function() {
        filterTable();
    });
    
    statusFilter.addEventListener('change', function() {
        filterTable();
    });
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const title = row.cells[1].textContent.toLowerCase();
            const description = row.cells[2].textContent.toLowerCase();
            const status = row.cells[5].textContent.toLowerCase();
            
            const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
            const matchesStatus = statusValue === '' || status.includes(statusValue);
            
            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }
    
    // Select all functionality
    const selectAll = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    
    selectAll.addEventListener('change', function() {
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });
    });
    
    // Update select all when individual checkboxes change
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
            selectAll.checked = checkedCount === rowCheckboxes.length;
            selectAll.indeterminate = checkedCount > 0 && checkedCount < rowCheckboxes.length;
        });
    });
});
</script>
@endpush
@endsection
