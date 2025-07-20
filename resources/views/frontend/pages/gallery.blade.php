@extends('frontend.layouts.layout')

@section('title', 'Photo Gallery')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1>Photo Gallery</h1>
                <p>Beautiful moments with our furry friends.</p>
            </div>
            
            <div class="gallery-grid">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('assets/img/gallery-1.jpg') }}" alt="Gallery Image 1" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('assets/img/gallery-2.jpg') }}" alt="Gallery Image 2" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('assets/img/gallery-3.jpg') }}" alt="Gallery Image 3" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
