@extends('admin.layouts.app')

@section('title', 'Website Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Website Management</a></li>
                        <li class="breadcrumb-item active">Website Settings</li>
                    </ol>
                </div>
                <h4 class="page-title">Website Settings</h4>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Website Configuration</h4>
                    <p class="text-muted mb-0">Manage your website's global settings, branding, and contact information</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.website.settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Company Information Section -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-3 text-uppercase bg-light p-2">
                                    <i class="mdi mdi-domain me-1"></i> Company Information
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="company_name" class="form-label">Company Name *</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" 
                                       value="{{ $settings->company_name ?? '' }}" required>
                                @error('company_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="company_description" class="form-label">Company Description</label>
                                <input type="text" class="form-control" id="company_description" name="company_description" 
                                       value="{{ $settings->company_description ?? '' }}" placeholder="Your company description">
                                @error('company_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ $settings->email ?? '' }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" 
                                       value="{{ $settings->phone ?? '' }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3">{{ $settings->address ?? '' }}</textarea>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Branding Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3 text-uppercase bg-light p-2">
                                    <i class="mdi mdi-palette me-1"></i> Branding & Logo
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="company_logo" class="form-label">Main Logo</label>
                                <input type="file" class="form-control" id="company_logo" name="company_logo" accept="image/*">
                                @if($settings->company_logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings->company_logo) }}" alt="Logo" class="img-thumbnail" style="max-height: 60px;">
                                        <small class="text-muted d-block">Current Logo</small>
                                    </div>
                                @endif
                                @error('company_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="company_logo_white" class="form-label">White/Footer Logo</label>
                                <input type="file" class="form-control" id="company_logo_white" name="company_logo_white" accept="image/*">
                                @if($settings->company_logo_white)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings->company_logo_white) }}" alt="White Logo" class="img-thumbnail" style="max-height: 60px;">
                                        <small class="text-muted d-block">Current White Logo</small>
                                    </div>
                                @endif
                                @error('company_logo_white')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Social Media Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3 text-uppercase bg-light p-2">
                                    <i class="mdi mdi-share-variant me-1"></i> Social Media Links
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="facebook_url" class="form-label">Facebook URL</label>
                                <input type="url" class="form-control" id="facebook_url" name="facebook_url" 
                                       value="{{ $settings->facebook_url ?? '' }}" placeholder="https://facebook.com/yourpage">
                                @error('facebook_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="twitter_url" class="form-label">Twitter URL</label>
                                <input type="url" class="form-control" id="twitter_url" name="twitter_url" 
                                       value="{{ $settings->twitter_url ?? '' }}" placeholder="https://twitter.com/yourhandle">
                                @error('twitter_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="instagram_url" class="form-label">Instagram URL</label>
                                <input type="url" class="form-control" id="instagram_url" name="instagram_url" 
                                       value="{{ $settings->instagram_url ?? '' }}" placeholder="https://instagram.com/yourhandle">
                                @error('instagram_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="instagram_handle" class="form-label">Instagram Handle</label>
                                <input type="text" class="form-control" id="instagram_handle" name="instagram_handle" 
                                       value="{{ $settings->instagram_handle ?? '' }}" placeholder="@yourhandle">
                                @error('instagram_handle')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" 
                                       value="{{ $settings->linkedin_url ?? '' }}" placeholder="https://linkedin.com/company/yourcompany">
                                @error('linkedin_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="youtube_url" class="form-label">YouTube URL</label>
                                <input type="url" class="form-control" id="youtube_url" name="youtube_url" 
                                       value="{{ $settings->youtube_url ?? '' }}" placeholder="https://youtube.com/c/yourchannel">
                                @error('youtube_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Footer Settings Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3 text-uppercase bg-light p-2">
                                    <i class="mdi mdi-web me-1"></i> Footer Settings
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="footer_description" class="form-label">Footer Description</label>
                                <textarea class="form-control" id="footer_description" name="footer_description" rows="4" 
                                          placeholder="Brief description about your company for the footer">{{ $settings->footer_description ?? '' }}</textarea>
                                @error('footer_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="footer_copyright" class="form-label">Copyright Text</label>
                                <input type="text" class="form-control" id="footer_copyright" name="footer_copyright" 
                                       value="{{ $settings->footer_copyright ?? '' }}" placeholder="© 2024 Your Company. All rights reserved.">
                                @error('footer_copyright')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="support_text" class="form-label">Support Text</label>
                                <input type="text" class="form-control" id="support_text" name="support_text" 
                                       value="{{ $settings->support_text ?? '' }}" placeholder="Got Questions? Call us 24/7">
                                @error('support_text')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="working_hours_weekdays" class="form-label">Weekdays</label>
                                <input type="text" class="form-control" id="working_hours_weekdays" name="working_hours_weekdays" 
                                       value="{{ $settings->working_hours_weekdays ?? '' }}" placeholder="Monday - Saturday">
                                @error('working_hours_weekdays')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="working_hours_weekdays_time" class="form-label">Weekdays Time</label>
                                <input type="text" class="form-control" id="working_hours_weekdays_time" name="working_hours_weekdays_time" 
                                       value="{{ $settings->working_hours_weekdays_time ?? '' }}" placeholder="08AM - 10PM">
                                @error('working_hours_weekdays_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="working_hours_weekend" class="form-label">Weekend</label>
                                <input type="text" class="form-control" id="working_hours_weekend" name="working_hours_weekend" 
                                       value="{{ $settings->working_hours_weekend ?? '' }}" placeholder="Sunday">
                                @error('working_hours_weekend')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="working_hours_weekend_time" class="form-label">Weekend Time</label>
                                <input type="text" class="form-control" id="working_hours_weekend_time" name="working_hours_weekend_time" 
                                       value="{{ $settings->working_hours_weekend_time ?? '' }}" placeholder="08AM - 10PM">
                                @error('working_hours_weekend_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save"></i> Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
