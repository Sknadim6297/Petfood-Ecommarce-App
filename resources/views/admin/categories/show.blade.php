@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Category Details</h1>
    <div>
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" 
                                 class="img-fluid rounded">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h2>{{ $category->name }}</h2>
                        <p class="text-muted mb-2">Slug: {{ $category->slug }}</p>
                        
                        <div class="mb-3">
                            @if($category->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </div>

                        @if($category->description)
                            <div class="mb-3">
                                <h6>Description:</h6>
                                <p>{{ $category->description }}</p>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Sort Order:</strong> {{ $category->sort_order ?? 0 }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Products:</strong> {{ $category->products()->count() }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Created:</strong> {{ $category->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Updated:</strong> {{ $category->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Category
                    </a>
                    <a href="{{ route('admin.products.index') }}?category={{ $category->id }}" class="btn btn-info">
                        <i class="fas fa-box"></i> View Products
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" 
                                {{ $category->products()->count() > 0 ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i> Delete Category
                        </button>
                    </form>
                    @if($category->products()->count() > 0)
                        <small class="text-muted">Cannot delete category with products</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
