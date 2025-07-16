@extends('admin.layouts.app')

@section('title', 'Users Management')
@section('page-title', 'Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">User Management</h4>
        <p class="text-muted mb-0">Manage all registered users</p>
    </div>
    <button class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New User
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom-0 pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">All Users</h5>
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">All Users</a></li>
                        <li><a class="dropdown-item" href="#">Active</a></li>
                        <li><a class="dropdown-item" href="#">Inactive</a></li>
                    </ul>
                </div>
                <button class="btn btn-light btn-sm">
                    <i class="fas fa-download me-1"></i>Export
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px;">
                                        JD
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0">John Doe</h6>
                                    <small class="text-muted">Pet Owner</small>
                                </div>
                            </div>
                        </td>
                        <td>john@example.com</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success">Customer</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-muted">Jan 15, 2024</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <!-- Add more sample users here -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
