@extends('admin.layouts.app')

@section('title', 'View About Content')

@push('styles')
<style>
.show-about-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.detail-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-left: 4px solid #fe5716;
    overflow: hidden;
    margin-bottom: 25px;
}

.detail-header {
    background: #f8f9fa;
    padding: 25px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.detail-header h1 {
    color: #2c3e50;
    font-weight: 700;
    margin: 0;
    font-size: 24px;
}

.detail-body {
    padding: 30px;
}

.section-header {
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    border-left: 4px solid #fe5716;
}

.section-title {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
    font-size: 16px;
}

.btn-primary {
    background: linear-gradient(135deg, #fe5716 0%, #ff8c42 100%);
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #ff8c42 0%, #fe5716 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(254, 87, 22, 0.4);
}

.btn-secondary {
    background: #6c757d;
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
}

.btn-warning {
    background: #ffc107;
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    color: #212529;
}

.info-row {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    border-left: 3px solid #fe5716;
}

.info-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.info-value {
    color: #6c757d;
    margin: 0;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.status-inactive {
    background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
    color: white;
}

.image-preview {
    max-width: 200px;
    max-height: 200px;
    border-radius: 8px;
    border: 2px solid #e9ecef;
    margin-bottom: 10px;
}

.feature-item, .statistic-item, .gallery-item {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    border-left: 3px solid #fe5716;
}

.feature-icon {
    color: #fe5716;
    font-size: 24px;
    margin-right: 15px;
}

.empty-state {
    text-align: center;
    color: #6c757d;
    padding: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 2px dashed #e9ecef;
}
</style>
@endpush

@section('content')
<div class="show-about-wrapper">
    <div class="detail-card">
        <div class="detail-header">
            <h1><i class="fas fa-eye me-3"></i>View About Content</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.about-content.edit', $aboutContent->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.about-content.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>
        
        <div class="detail-body">
            <!-- Basic Information -->
            <div class="section-header">
                <h3 class="section-title"><i class="fas fa-info-circle me-2"></i>Basic Information</h3>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Page Title</div>
                        <p class="info-value">{{ $aboutContent->title ?: 'Not set' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Status</div>
                        <p class="info-value">
                            <span class="badge {{ $aboutContent->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $aboutContent->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="info-row mb-4">
                <div class="info-label">Page Description</div>
                <p class="info-value">{{ $aboutContent->description ?: 'Not set' }}</p>
            </div>
            
            <div class="row mb-4">
                @if($aboutContent->banner_image)
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Banner Image</div>
                        <img src="{{ Storage::url($aboutContent->banner_image) }}" 
                             alt="Banner Image" class="image-preview" style="max-height: 150px;">
                    </div>
                </div>
                @endif
                @if($aboutContent->about_image)
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">About Image</div>
                        <img src="{{ Storage::url($aboutContent->about_image) }}" 
                             alt="About Image" class="image-preview" style="max-height: 150px;">
                    </div>
                </div>
                @endif
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Status</div>
                        <span class="status-badge {{ $aboutContent->is_active ? 'status-active' : 'status-inactive' }}">
                            <i class="fas {{ $aboutContent->is_active ? 'fa-check' : 'fa-times' }} me-1"></i>
                            {{ $aboutContent->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Created Date</div>
                        <p class="info-value">{{ $aboutContent->created_at->format('M d, Y H:i A') }}</p>
                    </div>
                </div>
            </div>
            
            @if($aboutContent->main_image)
            <div class="info-row mb-4">
                <div class="info-label">Main Image</div>
                <div>
                    <img src="{{ asset('storage/' . $aboutContent->main_image) }}" 
                         alt="Main Image" class="image-preview">
                </div>
            </div>
            @endif

            <!-- Mission Section -->
            <div class="section-header">
                <h3 class="section-title"><i class="fas fa-bullseye me-2"></i>Mission Section</h3>
            </div>
            
            @if($aboutContent->mission_title || $aboutContent->mission_content || $aboutContent->mission_image)
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-row">
                            <div class="info-label">Mission Title</div>
                            <p class="info-value">{{ $aboutContent->mission_title ?: 'Not set' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($aboutContent->mission_image)
                        <div class="info-row">
                            <div class="info-label">Mission Image</div>
                            <div>
                                <img src="{{ asset('storage/' . $aboutContent->mission_image) }}" 
                                     alt="Mission Image" class="image-preview">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                @if($aboutContent->mission_content)
                <div class="info-row mb-4">
                    <div class="info-label">Mission Content</div>
                    <p class="info-value">{{ $aboutContent->mission_content }}</p>
                </div>
                @endif
            @else
                <div class="empty-state mb-4">
                    <i class="fas fa-bullseye fa-3x mb-3"></i>
                    <h5>No Mission Content</h5>
                    <p>Mission section has not been configured yet.</p>
                </div>
            @endif

            <!-- Vision Section -->
            <div class="section-header">
                <h3 class="section-title"><i class="fas fa-eye me-2"></i>Vision Section</h3>
            </div>
            
            @if($aboutContent->vision_title || $aboutContent->vision_content || $aboutContent->vision_image)
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-row">
                            <div class="info-label">Vision Title</div>
                            <p class="info-value">{{ $aboutContent->vision_title ?: 'Not set' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($aboutContent->vision_image)
                        <div class="info-row">
                            <div class="info-label">Vision Image</div>
                            <div>
                                <img src="{{ asset('storage/' . $aboutContent->vision_image) }}" 
                                     alt="Vision Image" class="image-preview">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                @if($aboutContent->vision_content)
                <div class="info-row mb-4">
                    <div class="info-label">Vision Content</div>
                    <p class="info-value">{{ $aboutContent->vision_content }}</p>
                </div>
                @endif
            @else
                <div class="empty-state mb-4">
                    <i class="fas fa-eye fa-3x mb-3"></i>
                    <h5>No Vision Content</h5>
                    <p>Vision section has not been configured yet.</p>
                </div>
            @endif

            <!-- Features Section -->
            <div class="section-header">
                <h3 class="section-title"><i class="fas fa-star me-2"></i>Features Section</h3>
            </div>
            
            @if($aboutContent->features && count($aboutContent->features) > 0)
                <div class="row">
                    @foreach($aboutContent->features as $feature)
                    <div class="col-md-6 mb-3">
                        <div class="feature-item">
                            <div class="d-flex align-items-start">
                                @if(isset($feature['icon']))
                                    <i class="{{ $feature['icon'] }} feature-icon"></i>
                                @endif
                                <div>
                                    <h6 class="fw-bold mb-2">{{ $feature['title'] ?? 'Untitled Feature' }}</h6>
                                    <p class="mb-0 text-muted">{{ $feature['description'] ?? 'No description' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state mb-4">
                    <i class="fas fa-star fa-3x mb-3"></i>
                    <h5>No Features</h5>
                    <p>No features have been added yet.</p>
                </div>
            @endif

            <!-- Statistics Section -->
            <div class="section-header">
                <h3 class="section-title"><i class="fas fa-chart-bar me-2"></i>Statistics Section</h3>
            </div>
            
            @if($aboutContent->statistics && count($aboutContent->statistics) > 0)
                <div class="row">
                    @foreach($aboutContent->statistics as $statistic)
                    <div class="col-md-4 mb-3">
                        <div class="statistic-item text-center">
                            <h3 class="fw-bold text-primary mb-2">{{ $statistic['number'] ?? '0' }}</h3>
                            <p class="mb-0 text-muted">{{ $statistic['label'] ?? 'Untitled Statistic' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state mb-4">
                    <i class="fas fa-chart-bar fa-3x mb-3"></i>
                    <h5>No Statistics</h5>
                    <p>No statistics have been added yet.</p>
                </div>
            @endif

            <!-- Gallery Section -->
            <div class="section-header">
                <h3 class="section-title"><i class="fas fa-images me-2"></i>Gallery Section</h3>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Gallery Title</div>
                        <p class="info-value">{{ $aboutContent->gallery_title ?: 'Not set' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Gallery Subtitle</div>
                        <p class="info-value">{{ $aboutContent->gallery_subtitle ?: 'Not set' }}</p>
                    </div>
                </div>
            </div>
            
            @if($aboutContent->gallery_images && count($aboutContent->gallery_images) > 0)
                <div class="row">
                    @foreach($aboutContent->gallery_images as $galleryItem)
                    <div class="col-md-4 mb-3">
                        <div class="gallery-item">
                            @if(isset($galleryItem['image']))
                                <img src="{{ asset('storage/' . $galleryItem['image']) }}" 
                                     alt="Gallery Image" class="image-preview w-100">
                            @endif
                            @if(isset($galleryItem['caption']))
                                <p class="mb-0 text-muted mt-2">{{ $galleryItem['caption'] }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state mb-4">
                    <i class="fas fa-images fa-3x mb-3"></i>
                    <h5>No Gallery Images</h5>
                    <p>No gallery images have been added yet.</p>
                </div>
            @endif

            <!-- Registration Section -->
            <div class="section-header">
                <h3 class="section-title"><i class="fas fa-user-plus me-2"></i>Registration Section</h3>
            </div>
            
            <div class="info-row mb-4">
                <div class="info-label">Registration Title</div>
                <p class="info-value">{{ $aboutContent->register_title ?: 'Not set' }}</p>
            </div>
            
            <div class="info-row mb-4">
                <div class="info-label">Registration Description</div>
                <p class="info-value">{{ $aboutContent->register_description ?: 'Not set' }}</p>
            </div>
            
            @if($aboutContent->register_image)
                <div class="info-row mb-4">
                    <div class="info-label">Registration Image</div>
                    <img src="{{ Storage::url($aboutContent->register_image) }}" 
                         alt="Registration Image" class="image-preview" style="max-height: 200px;">
                </div>
            @endif

            <!-- Actions -->
            <div class="d-flex gap-3 justify-content-end mt-5 pt-4 border-top">
                <form action="{{ route('admin.about-content.destroy', $aboutContent->id) }}" 
                      method="POST" class="d-inline" 
                      onsubmit="return confirm('Are you sure you want to delete this about content? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Content
                    </button>
                </form>
                <a href="{{ route('admin.about-content.edit', $aboutContent->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit Content
                </a>
                <a href="{{ route('about') }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>View on Website
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
