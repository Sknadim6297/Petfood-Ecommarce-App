@extends('admin.layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Product Details: {{ $product->name }}</h1>
    <div>
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Product
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Products
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="img-fluid rounded mb-3" style="max-height: 400px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                                 style="height: 300px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif

                        @if($product->gallery && count($product->gallery) > 0)
                            <h6>Gallery Images</h6>
                            <div class="row g-2">
                                @foreach($product->gallery as $image)
                                    <div class="col-3">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Gallery" 
                                             class="img-fluid rounded" style="height: 80px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <h3>{{ $product->name }}</h3>
                        
                        <div class="mb-3">
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            
                            @if($product->is_featured)
                                <span class="badge bg-primary">Featured</span>
                            @endif

                            @if($product->is_healthy)
                                <span class="badge bg-success">Healthy Product</span>
                            @endif

                            @if($product->is_deal_of_week)
                                <span class="badge bg-warning">Deal of the Week</span>
                            @endif
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>SKU:</strong></div>
                            <div class="col-sm-8">{{ $product->sku }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Category:</strong></div>
                            <div class="col-sm-8">
                                @if($product->category)
                                    <span class="badge bg-info">{{ $product->category->name }}</span>
                                @else
                                    <span class="text-muted">No category</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Brand:</strong></div>
                            <div class="col-sm-8">
                                @if($product->brand)
                                    <span class="badge bg-success">{{ $product->brand->name }}</span>
                                @else
                                    <span class="text-muted">No brand</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Price:</strong></div>
                            <div class="col-sm-8">
                                @if($product->sale_price)
                                    <span class="text-decoration-line-through text-muted">₹{{ number_format($product->price, 2) }}</span>
                                    <span class="text-danger fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                                    <small class="text-success">({{ $product->discount_percentage }}% off)</small>
                                @else
                                    <span class="fw-bold">₹{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Stock:</strong></div>
                            <div class="col-sm-8">
                                <span class="badge {{ $product->stock_quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->stock_quantity }} units
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Rating:</strong></div>
                            <div class="col-sm-8">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $product->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                @endfor
                                <small class="text-muted">({{ $product->reviews_count }} reviews)</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Sort Order:</strong></div>
                            <div class="col-sm-8">{{ $product->sort_order }}</div>
                        </div>
                    </div>
                </div>

                <hr>

                @if($product->short_description)
                    <div class="mb-4">
                        <h5>Short Description</h5>
                        <p class="text-muted">{{ $product->short_description }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <h5>Description</h5>
                    <div>{!! nl2br(e($product->description)) !!}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Product
                    </a>
                    
                    <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="btn btn-success">
                        <i class="fas fa-external-link-alt"></i> View on Frontend
                    </a>
                    
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Product Stats</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="mb-0">{{ $product->rating }}</h4>
                            <small class="text-muted">Rating</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="mb-0">{{ $product->reviews_count }}</h4>
                        <small class="text-muted">Reviews</small>
                    </div>
                </div>
                
                <hr>
                
                <div class="text-center">
                    <small class="text-muted">
                        <strong>Created:</strong> {{ $product->created_at->format('M d, Y H:i') }}<br>
                        <strong>Updated:</strong> {{ $product->updated_at->format('M d, Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
