@extends('admin.layouts.app')

@section('title', 'Edit About Content')

@push('styles')
<style>
.edit-about-wrapper {
    padding: 20px;
    background: #f8f9fa;
    min-height: calc(100vh - 100px);
}

.form-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-left: 4px solid #fe5716;
    overflow: hidden;
}

.form-header {
    background: #f8f9fa;
    padding: 25px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.form-header h1 {
    color: #2c3e50;
    font-weight: 700;
    margin: 0;
    font-size: 24px;
}

.form-body {
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

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #e9ecef;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #fe5716;
    box-shadow: 0 0 0 0.2rem rgba(254, 87, 22, 0.25);
}

.dynamic-section {
    border: 2px dashed #e9ecef;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    background: #f8f9fa;
}

.btn-add-item {
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 8px 16px;
    font-size: 14px;
}

.btn-remove-item {
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 12px;
}

.current-image {
    max-width: 150px;
    max-height: 150px;
    border-radius: 8px;
    border: 2px solid #e9ecef;
}
</style>
@endpush

@section('content')
<div class="edit-about-wrapper">
    <div class="form-card">
        <div class="form-header">
            <h1><i class="fas fa-edit me-3"></i>Edit About Content</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.about-content.show', $aboutContent->id) }}" class="btn btn-warning">
                    <i class="fas fa-eye me-2"></i>View
                </a>
                <a href="{{ route('admin.about-content.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>
        
        <div class="form-body">
            <form action="{{ route('admin.about-content.update', $aboutContent->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
                <div class="section-header">
                    <h3 class="section-title"><i class="fas fa-info-circle me-2"></i>Basic Information</h3>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $aboutContent->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" 
                                    id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', $aboutContent->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $aboutContent->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="form-label">Page Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4">{{ old('description', $aboutContent->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        @if($aboutContent->banner_image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($aboutContent->banner_image) }}" alt="Current banner image" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <label for="about_image" class="form-label">About Image</label>
                        @if($aboutContent->about_image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($aboutContent->about_image) }}" alt="Current about image" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="about_image" name="about_image" accept="image/*">
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="main_image" class="form-label">Main Image</label>
                            @if($aboutContent->main_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $aboutContent->main_image) }}" 
                                         alt="Current Main Image" class="current-image">
                                    <p class="text-muted mt-1"><small>Current image</small></p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" 
                                   id="main_image" name="main_image" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image</small>
                            @error('main_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', $aboutContent->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $aboutContent->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Mission Section -->
                <div class="section-header">
                    <h3 class="section-title"><i class="fas fa-bullseye me-2"></i>Mission Section</h3>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mission_title" class="form-label">Mission Title</label>
                            <input type="text" class="form-control @error('mission_title') is-invalid @enderror" 
                                   id="mission_title" name="mission_title" value="{{ old('mission_title', $aboutContent->mission_title) }}">
                            @error('mission_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mission_image" class="form-label">Mission Image</label>
                            @if($aboutContent->mission_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $aboutContent->mission_image) }}" 
                                         alt="Current Mission Image" class="current-image">
                                    <p class="text-muted mt-1"><small>Current image</small></p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('mission_image') is-invalid @enderror" 
                                   id="mission_image" name="mission_image" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image</small>
                            @error('mission_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="mission_content" class="form-label">Mission Content</label>
                    <textarea class="form-control @error('mission_content') is-invalid @enderror" 
                              id="mission_content" name="mission_content" rows="4">{{ old('mission_content', $aboutContent->mission_content) }}</textarea>
                    @error('mission_content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Vision Section -->
                <div class="section-header">
                    <h3 class="section-title"><i class="fas fa-eye me-2"></i>Vision Section</h3>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="vision_title" class="form-label">Vision Title</label>
                            <input type="text" class="form-control @error('vision_title') is-invalid @enderror" 
                                   id="vision_title" name="vision_title" value="{{ old('vision_title', $aboutContent->vision_title) }}">
                            @error('vision_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="vision_image" class="form-label">Vision Image</label>
                            @if($aboutContent->vision_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $aboutContent->vision_image) }}" 
                                         alt="Current Vision Image" class="current-image">
                                    <p class="text-muted mt-1"><small>Current image</small></p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('vision_image') is-invalid @enderror" 
                                   id="vision_image" name="vision_image" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image</small>
                            @error('vision_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="vision_content" class="form-label">Vision Content</label>
                    <textarea class="form-control @error('vision_content') is-invalid @enderror" 
                              id="vision_content" name="vision_content" rows="4">{{ old('vision_content', $aboutContent->vision_content) }}</textarea>
                    @error('vision_content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Features Section -->
                <div class="section-header">
                    <h3 class="section-title"><i class="fas fa-star me-2"></i>Features Section</h3>
                </div>
                
                <div id="features-container">
                    @if($aboutContent->features && count($aboutContent->features) > 0)
                        @foreach($aboutContent->features as $index => $feature)
                        <div class="feature-item dynamic-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Feature Item</h6>
                                <button type="button" class="btn btn-remove-item" onclick="removeFeature(this)">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="features[{{ $index }}][title]" 
                                           placeholder="Feature Title" value="{{ $feature['title'] ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="features[{{ $index }}][icon]" 
                                           placeholder="Feature Icon" value="{{ $feature['icon'] ?? '' }}">
                                </div>
                            </div>
                            <textarea class="form-control" name="features[{{ $index }}][description]" 
                                      placeholder="Feature Description" rows="2">{{ $feature['description'] ?? '' }}</textarea>
                        </div>
                        @endforeach
                    @else
                        <div class="feature-item dynamic-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Feature Item</h6>
                                <button type="button" class="btn btn-remove-item" onclick="removeFeature(this)">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="features[0][title]" placeholder="Feature Title">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="features[0][icon]" placeholder="Feature Icon">
                                </div>
                            </div>
                            <textarea class="form-control" name="features[0][description]" placeholder="Feature Description" rows="2"></textarea>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-add-item mb-4" onclick="addFeature()">
                    <i class="fas fa-plus me-1"></i> Add Feature
                </button>

                <!-- Statistics Section -->
                <div class="section-header">
                    <h3 class="section-title"><i class="fas fa-chart-bar me-2"></i>Statistics Section</h3>
                </div>
                
                <div id="statistics-container">
                    @if($aboutContent->statistics && count($aboutContent->statistics) > 0)
                        @foreach($aboutContent->statistics as $index => $statistic)
                        <div class="statistic-item dynamic-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Statistic Item</h6>
                                <button type="button" class="btn btn-remove-item" onclick="removeStatistic(this)">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="statistics[{{ $index }}][number]" 
                                           placeholder="Number" value="{{ $statistic['number'] ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="statistics[{{ $index }}][label]" 
                                           placeholder="Label" value="{{ $statistic['label'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="statistic-item dynamic-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Statistic Item</h6>
                                <button type="button" class="btn btn-remove-item" onclick="removeStatistic(this)">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="statistics[0][number]" placeholder="Number">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="statistics[0][label]" placeholder="Label">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-add-item mb-4" onclick="addStatistic()">
                    <i class="fas fa-plus me-1"></i> Add Statistic
                </button>

                <!-- Gallery Section -->
                <div class="section-header">
                    <h3 class="section-title"><i class="fas fa-images me-2"></i>Gallery Section</h3>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="gallery_title" class="form-label">Gallery Title</label>
                        <input type="text" class="form-control" id="gallery_title" name="gallery_title" value="{{ old('gallery_title', $aboutContent->gallery_title ?? 'Pet Care Memories') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="gallery_subtitle" class="form-label">Gallery Subtitle</label>
                        <input type="text" class="form-control" id="gallery_subtitle" name="gallery_subtitle" value="{{ old('gallery_subtitle', $aboutContent->gallery_subtitle ?? 'Gallery Photos') }}">
                    </div>
                </div>
                
                <div id="gallery-container">
                    @if($aboutContent->gallery_images && count($aboutContent->gallery_images) > 0)
                        @foreach($aboutContent->gallery_images as $index => $galleryItem)
                        <div class="gallery-item dynamic-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Gallery Item</h6>
                                <button type="button" class="btn btn-remove-item" onclick="removeGallery(this)">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            @if(isset($galleryItem['image']))
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $galleryItem['image']) }}" 
                                         alt="Gallery Image" class="current-image">
                                    <p class="text-muted mt-1"><small>Current image</small></p>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" class="form-control mb-2" name="gallery[{{ $index }}][image]" accept="image/*">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="gallery[{{ $index }}][caption]" 
                                           placeholder="Image Caption" value="{{ $galleryItem['caption'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="gallery-item dynamic-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Gallery Item</h6>
                                <button type="button" class="btn btn-remove-item" onclick="removeGallery(this)">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" class="form-control mb-2" name="gallery[0][image]" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-2" name="gallery[0][caption]" placeholder="Image Caption">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-add-item mb-4" onclick="addGallery()">
                    <i class="fas fa-plus me-1"></i> Add Gallery Image
                </button>

                <!-- Registration Section -->
                <div class="section-header">
                    <h3 class="section-title"><i class="fas fa-user-plus me-2"></i>Registration Section</h3>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-12">
                        <label for="register_title" class="form-label">Registration Title</label>
                        <input type="text" class="form-control" id="register_title" name="register_title" value="{{ old('register_title', $aboutContent->register_title ?? 'Register your pet with us and Get 5% off their next order') }}">
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-8">
                        <label for="register_description" class="form-label">Registration Description</label>
                        <textarea class="form-control" id="register_description" name="register_description" rows="3">{{ old('register_description', $aboutContent->register_description ?? 'We are your local dog home boarding service giving you complete') }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="register_image" class="form-label">Registration Image</label>
                        @if($aboutContent->register_image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($aboutContent->register_image) }}" alt="Current registration image" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="register_image" name="register_image" accept="image/*">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex gap-3 justify-content-end mt-5">
                    <a href="{{ route('admin.about-content.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update About Content
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
let featureIndex = {{ $aboutContent->features ? count($aboutContent->features) : 1 }};
let statisticIndex = {{ $aboutContent->statistics ? count($aboutContent->statistics) : 1 }};
let galleryIndex = {{ $aboutContent->gallery_images ? count($aboutContent->gallery_images) : 1 }};

function addFeature() {
    const container = document.getElementById('features-container');
    const newFeature = `
        <div class="feature-item dynamic-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Feature Item</h6>
                <button type="button" class="btn btn-remove-item" onclick="removeFeature(this)">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="features[${featureIndex}][title]" placeholder="Feature Title">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="features[${featureIndex}][icon]" placeholder="Feature Icon">
                </div>
            </div>
            <textarea class="form-control" name="features[${featureIndex}][description]" placeholder="Feature Description" rows="2"></textarea>
        </div>`;
    container.insertAdjacentHTML('beforeend', newFeature);
    featureIndex++;
}

function removeFeature(btn) {
    btn.closest('.feature-item').remove();
}

function addStatistic() {
    const container = document.getElementById('statistics-container');
    const newStatistic = `
        <div class="statistic-item dynamic-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Statistic Item</h6>
                <button type="button" class="btn btn-remove-item" onclick="removeStatistic(this)">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="statistics[${statisticIndex}][number]" placeholder="Number">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="statistics[${statisticIndex}][label]" placeholder="Label">
                </div>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', newStatistic);
    statisticIndex++;
}

function removeStatistic(btn) {
    btn.closest('.statistic-item').remove();
}

function addGallery() {
    const container = document.getElementById('gallery-container');
    const newGallery = `
        <div class="gallery-item dynamic-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Gallery Item</h6>
                <button type="button" class="btn btn-remove-item" onclick="removeGallery(this)">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="file" class="form-control mb-2" name="gallery[${galleryIndex}][image]" accept="image/*">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="gallery[${galleryIndex}][caption]" placeholder="Image Caption">
                </div>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', newGallery);
    galleryIndex++;
}

function removeGallery(btn) {
    btn.closest('.gallery-item').remove();
}
</script>
@endpush
@endsection
