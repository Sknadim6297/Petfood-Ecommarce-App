@extends('frontend.layouts.layout')

@section('title', 'Product Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1>Product Details</h1>
                <p>Detailed information about our products.</p>
            </div>
            <div class="product-details">
                <p>Product details will be displayed here. You can implement individual product pages later.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">View All Products</a>
            </div>
        </div>
    </div>
</div>
@endsection
