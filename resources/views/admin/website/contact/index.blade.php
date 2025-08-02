@extends('admin.layouts.app')

@section('title', 'Contact Page Management')
@section('page-title', 'Contact Page Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-phone me-2"></i>Contact Page Management
                    </h4>
                    <p class="text-muted mb-0">Manage all content displayed on the contact page</p>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.website.contact.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Page Header Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="fas fa-header me-2"></i>Page Header</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="page_title" class="form-label">Page Title</label>
                                                    <input type="text" class="form-control" id="page_title" name="page_title" 
                                                           value="{{ old('page_title', $contactSettings->page_title) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="page_subtitle" class="form-label">Page Subtitle</label>
                                                    <input type="text" class="form-control" id="page_subtitle" name="page_subtitle" 
                                                           value="{{ old('page_subtitle', $contactSettings->page_subtitle) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="banner_image" class="form-label">Banner Image</label>
                                            <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                                            @if($contactSettings->banner_image)
                                                <div class="mt-2">
                                                    <img src="{{ Storage::url($contactSettings->banner_image) }}" alt="Current Banner" class="img-thumbnail" style="max-height: 100px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hero Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Hero Section</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="hero_title" class="form-label">Hero Title</label>
                                            <input type="text" class="form-control" id="hero_title" name="hero_title" 
                                                   value="{{ old('hero_title', $contactSettings->hero_title) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="hero_description" class="form-label">Hero Description</label>
                                            <textarea class="form-control" id="hero_description" name="hero_description" rows="3" required>{{ old('hero_description', $contactSettings->hero_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Cards -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0"><i class="fas fa-address-card me-2"></i>Contact Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Email Section -->
                                            <div class="col-md-4">
                                                <h6 class="text-primary">Email Information</h6>
                                                <div class="mb-3">
                                                    <label for="email_title" class="form-label">Email Title</label>
                                                    <input type="text" class="form-control" id="email_title" name="email_title" 
                                                           value="{{ old('email_title', $contactSettings->email_title) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email_address" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="email_address" name="email_address" 
                                                           value="{{ old('email_address', $contactSettings->email_address) }}" required>
                                                </div>
                                            </div>

                                            <!-- Phone Section -->
                                            <div class="col-md-4">
                                                <h6 class="text-primary">Phone Information</h6>
                                                <div class="mb-3">
                                                    <label for="phone_title" class="form-label">Phone Title</label>
                                                    <input type="text" class="form-control" id="phone_title" name="phone_title" 
                                                           value="{{ old('phone_title', $contactSettings->phone_title) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone_number" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" id="phone_number" name="phone_number" 
                                                           value="{{ old('phone_number', $contactSettings->phone_number) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone_subtitle" class="form-label">Phone Subtitle</label>
                                                    <input type="text" class="form-control" id="phone_subtitle" name="phone_subtitle" 
                                                           value="{{ old('phone_subtitle', $contactSettings->phone_subtitle) }}">
                                                </div>
                                            </div>

                                            <!-- Working Hours Section -->
                                            <div class="col-md-4">
                                                <h6 class="text-primary">Working Hours</h6>
                                                <div class="mb-3">
                                                    <label for="hours_title" class="form-label">Hours Title</label>
                                                    <input type="text" class="form-control" id="hours_title" name="hours_title" 
                                                           value="{{ old('hours_title', $contactSettings->hours_title) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="working_hours" class="form-label">Working Hours</label>
                                                    <input type="text" class="form-control" id="working_hours" name="working_hours" 
                                                           value="{{ old('working_hours', $contactSettings->working_hours) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="working_days" class="form-label">Working Days</label>
                                                    <input type="text" class="form-control" id="working_days" name="working_days" 
                                                           value="{{ old('working_days', $contactSettings->working_days) }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Office Locations -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <h5 class="mb-0"><i class="fas fa-building me-2"></i>Office Locations</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-primary">Office 1</h6>
                                                <div class="mb-3">
                                                    <label for="office1_title" class="form-label">Office 1 Title</label>
                                                    <input type="text" class="form-control" id="office1_title" name="office1_title" 
                                                           value="{{ old('office1_title', $contactSettings->office1_title) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="office1_address" class="form-label">Office 1 Address</label>
                                                    <textarea class="form-control" id="office1_address" name="office1_address" rows="3" required>{{ old('office1_address', $contactSettings->office1_address) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-primary">Office 2</h6>
                                                <div class="mb-3">
                                                    <label for="office2_title" class="form-label">Office 2 Title</label>
                                                    <input type="text" class="form-control" id="office2_title" name="office2_title" 
                                                           value="{{ old('office2_title', $contactSettings->office2_title) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="office2_address" class="form-label">Office 2 Address</label>
                                                    <textarea class="form-control" id="office2_address" name="office2_address" rows="3" required>{{ old('office2_address', $contactSettings->office2_address) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Form Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0"><i class="fas fa-form me-2"></i>Contact Form Settings</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="form_title" class="form-label">Form Title</label>
                                                    <input type="text" class="form-control" id="form_title" name="form_title" 
                                                           value="{{ old('form_title', $contactSettings->form_title) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="form_textarea_placeholder" class="form-label">Textarea Placeholder</label>
                                                    <input type="text" class="form-control" id="form_textarea_placeholder" name="form_textarea_placeholder" 
                                                           value="{{ old('form_textarea_placeholder', $contactSettings->form_textarea_placeholder) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Awards Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-danger text-white">
                                        <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Awards Section</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="awards_title" class="form-label">Awards Section Title</label>
                                                    <input type="text" class="form-control" id="awards_title" name="awards_title" 
                                                           value="{{ old('awards_title', $contactSettings->awards_title) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" id="show_awards" name="show_awards" 
                                                           {{ old('show_awards', $contactSettings->show_awards) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="show_awards">
                                                        Show Awards Section
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Page Status -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Page Settings</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                                   {{ old('is_active', $contactSettings->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Page is Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Update Contact Page
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-header {
        border-bottom: 2px solid rgba(0,0,0,0.1);
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    
    .text-primary {
        color: #fa441d !important;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #fa441d, #e55a4f);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #e55a4f, #fa441d);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(250, 68, 29, 0.3);
    }
</style>
@endpush
