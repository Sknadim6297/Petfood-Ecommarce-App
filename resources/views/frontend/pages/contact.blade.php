@extends('frontend.layouts.layout')

@section('title', $contactSettings->page_title ?? 'Contact Us')

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url(assets/img/banner.png)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>{{ $contactSettings->page_title ?? 'Contact Us' }}</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $contactSettings->page_title ?? 'Contact Us' }}</li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img">
                    <div class="banner-img-1">
                        <svg width="260" height="260" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="assets/img/banner-img-1.jpg" alt="banner">
                    </div>
                    <div class="banner-img-2">
                        <svg width="320" height="320" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="assets/img/banner-img-2.jpg" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="assets/img/hero-shaps-1.png" alt="hero-shaps" class="img-2">
    <img src="assets/img/hero-shaps-1.png" alt="hero-shaps" class="img-4">
</section>
<section class="gap">
    <div class="container">
        <div class="heading">
            <h6>{{ $contactSettings->hero_title ?? 'We would love to hear from you.' }}</h6>
            <h2>{{ $contactSettings->hero_description ?? 'Expert Pet Care with a personal touch' }}</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="content-us">
                    <svg width="140" height="140" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                    <i>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <path d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z
                           M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z"></path>
                        </svg>
                      </i>
                      <span>{{ $contactSettings->email_title ?? 'Email Address.' }}</span>
                      <a href="mailto:{{ $contactSettings->email_address ?? 'info@petnet.com' }}">{{ $contactSettings->email_address ?? 'info@petnet.com' }}</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="content-us">
                    <svg width="140" height="140" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                    <i>
                        <svg height="112" viewBox="0 0 24 24" width="112" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="rgb(255255,255)" fill-rule="evenodd"><path d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z"></path><path d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z"></path><path d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z"></path></g></svg>
                      </i>
                      <span>{{ $contactSettings->phone_title ?? 'Phone Number.' }}</span>
                      <a href="tel:{{ $contactSettings->phone_number ?? '+09 121 359 6224' }}">{{ $contactSettings->phone_number ?? '+09 121 359 6224' }}</a>
                      <h6>{{ $contactSettings->phone_subtitle ?? '24/7 Support team' }}</h6>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="content-us mb-0">
                    <svg width="140" height="140" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                    <i>
                        <svg fill="#000000" height="800px" width="800px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                             viewBox="0 0 421.66 421.66" xml:space="preserve">
                                <path d="M86.557,278.614l-14.505,7.875c0.691,1.275,1.403,2.545,2.12,3.794c0.727,1.265,1.469,2.509,2.232,3.748l14.049-8.653
                                    c-0.676-1.101-1.341-2.222-1.992-3.343C87.817,280.902,87.182,279.761,86.557,278.614z"/>
                                <path d="M140.236,88.81c1.126-0.65,2.263-1.285,3.41-1.91l-7.875-14.505c-1.275,0.691-2.539,1.398-3.789,2.12
                                    c-1.265,0.727-2.509,1.475-3.743,2.232l8.653,14.049C137.993,90.121,139.114,89.455,140.236,88.81z"/>
                                <path d="M335.364,143.994l14.505-7.875c-0.691-1.275-1.403-2.545-2.12-3.794c-0.727-1.265-1.475-2.509-2.232-3.748l-14.049,8.653
                                    c0.676,1.101,1.341,2.222,1.992,3.343C334.104,141.705,334.739,142.842,335.364,143.994z"/>
                                <path d="M210.958,69.856c1.295,0,2.601,0.02,3.907,0.056l0.435-16.502c-1.449-0.036-2.903-0.056-4.342-0.056
                                    c-1.459,0-2.908,0.02-4.362,0.061l0.466,16.497C208.357,69.871,209.663,69.856,210.958,69.856z"/>
                                <path d="M74.172,132.33c-0.727,1.265-1.439,2.529-2.13,3.804l14.52,7.844c0.614-1.137,1.254-2.273,1.9-3.395
                                    c0.65-1.126,1.321-2.243,2.002-3.359l-14.07-8.627C75.637,129.832,74.894,131.076,74.172,132.33z"/>
                                <path d="M285.039,90.807l8.627-14.07c-1.239-0.758-2.483-1.5-3.732-2.222c-1.265-0.727-2.529-1.439-3.804-2.13l-7.844,14.52
                                    c1.137,0.614,2.273,1.254,3.4,1.9C282.807,89.455,283.928,90.126,285.039,90.807z"/>
                                <path d="M53.068,206.959c-0.036,1.449-0.056,2.903-0.056,4.342c0,1.459,0.021,2.908,0.061,4.357l16.497-0.466
                                    c-0.036-1.29-0.051-2.596-0.051-3.891s0.021-2.601,0.056-3.907L53.068,206.959z"/>
                                <path d="M368.849,206.944l-16.497,0.466c0.036,1.29,0.051,2.596,0.051,3.891s-0.02,2.601-0.056,3.907l16.502,0.435
                                    c0.036-1.449,0.056-2.903,0.056-4.342C368.91,209.842,368.89,208.393,368.849,206.944z"/>
                                <path d="M333.454,282.024c-0.65,1.126-1.321,2.243-2.002,3.359l14.07,8.627c0.758-1.239,1.5-2.483,2.222-3.732
                                    c0.727-1.265,1.439-2.529,2.13-3.804l-14.52-7.844C334.744,279.761,334.104,280.902,333.454,282.024z"/>
                                <path d="M136.882,331.795l-8.627,14.07c1.239,0.758,2.483,1.5,3.732,2.222c1.265,0.727,2.529,1.439,3.804,2.13l7.844-14.52
                                    c-1.137-0.614-2.273-1.254-3.395-1.9C139.114,333.147,137.993,332.481,136.882,331.795z"/>
                                <path d="M359.909,61.751c-82.335-82.335-215.823-82.335-298.158,0s-82.335,215.823,0,298.158s215.823,82.335,298.158,0
                                    S442.244,144.086,359.909,61.751z M340.422,340.422c-71.572,71.572-187.612,71.572-259.185,0s-71.573-187.612,0-259.185
                                    s187.612-71.573,259.185,0S411.99,268.85,340.422,340.422z"/>
                                <path d="M210.958,352.746c-1.295,0-2.601-0.02-3.907-0.056l-0.435,16.502c1.449,0.041,2.903,0.056,4.342,0.056
                                    c1.459,0,2.908-0.02,4.362-0.061l-0.466-16.497C213.564,352.731,212.259,352.746,210.958,352.746z"/>
                                <path d="M281.686,333.797c-1.126,0.65-2.263,1.285-3.41,1.91l7.875,14.505c1.275-0.691,2.54-1.398,3.789-2.12
                                    c1.265-0.727,2.509-1.475,3.743-2.232l-8.653-14.049C283.928,332.481,282.807,333.147,281.686,333.797z"/>
                                <path d="M219.084,181.882V78.934c0-4.557-3.692-8.253-8.253-8.253s-8.253,3.697-8.253,8.253v102.948
                                    c-6.154,1.756-11.464,5.371-15.34,10.25l-80.154-20.163c-6.625-1.674-13.353,2.355-15.027,8.98
                                    c-1.669,6.63,2.36,13.358,8.986,15.022l80.092,20.152c2.514,14.162,14.812,24.94,29.696,24.94
                                    c16.696,0,30.234-13.537,30.234-30.234C241.064,197.016,231.74,185.491,219.084,181.882z M210.83,226.728
                                    c-8.781,0-15.898-7.117-15.898-15.898s7.117-15.898,15.898-15.898s15.898,7.117,15.898,15.898S219.611,226.728,210.83,226.728z"/>
                        </svg>
                      </i>
                      <span>{{ $contactSettings->hours_title ?? 'Working Hours.' }}</span>
                      <a href="#">{{ $contactSettings->working_hours ?? '9:00 AM - 5:00 PM' }}</a>
                      <h6>{{ $contactSettings->working_days ?? 'Monday - Friday' }}</h6>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="office-locations">
                    <h2>Our Office Locations</h2>
                    <div class="office-card mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-location-dot me-3" style="color: #fa441d; font-size: 1.5rem;"></i>
                            <h5 class="mb-0" style="color: #fa441d;">{{ $contactSettings->office1_title ?? 'Head Office United State:' }}</h5>
                        </div>
                        <p class="ms-5">{{ $contactSettings->office1_address ?? '#201 1218 9th Avenue SE, Calgary, AB T2G 0T1' }}</p>
                    </div>
                    <div class="office-card">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-location-dot me-3" style="color: #fa441d; font-size: 1.5rem;"></i>
                            <h5 class="mb-0" style="color: #fa441d;">{{ $contactSettings->office2_title ?? 'Head Office Canada:' }}</h5>
                        </div>
                        <p class="ms-5">{{ $contactSettings->office2_address ?? '#201 1218 9th Avenue SE, Calgary, AB T2G 0T1' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-form-modern">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="form-header">
                        <h3>{{ $contactSettings->form_title ?? 'Book Your Place or Find out More' }}</h3>
                        <p>We'd love to hear from you! Send us a message and we'll respond as soon as possible.</p>
                    </div>
                    
                    <form class="modern-contact-form" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        
                        <!-- Pet Type Selection -->
                        <div class="pet-selection mb-4">
                            <label class="form-label">I'm interested in services for:</label>
                            <div class="pet-options">
                                <div class="pet-option">
                                    <input type="radio" id="dog-option" name="pet_type" value="dog" class="pet-radio" {{ old('pet_type') == 'dog' ? 'checked' : '' }}>
                                    <label for="dog-option" class="pet-label">
                                        <i class="fas fa-dog"></i>
                                        <span>Dog</span>
                                    </label>
                                </div>
                                <div class="pet-option">
                                    <input type="radio" id="cat-option" name="pet_type" value="cat" class="pet-radio" {{ old('pet_type') == 'cat' ? 'checked' : '' }}>
                                    <label for="cat-option" class="pet-label">
                                        <i class="fas fa-cat"></i>
                                        <span>Cat</span>
                                    </label>
                                </div>
                                <div class="pet-option">
                                    <input type="radio" id="both-option" name="pet_type" value="both" class="pet-radio" {{ old('pet_type') == 'both' ? 'checked' : '' }}>
                                    <label for="both-option" class="pet-label">
                                        <i class="fas fa-paw"></i>
                                        <span>Both</span>
                                    </label>
                                </div>
                            </div>
                            @error('pet_type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Personal Information -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" id="name" name="name" class="form-control modern-input" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" id="email" name="email" class="form-control modern-input" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" class="form-control modern-input" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Subject Field -->
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="subject" class="form-label">Subject *</label>
                                <input type="text" id="subject" name="subject" class="form-control modern-input" value="{{ old('subject') }}" placeholder="What is this message about?" required>
                                @error('subject')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Service Selection -->
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="service" class="form-label">Service Interested In *</label>
                                <select id="service" name="service" class="form-control modern-select" required>
                                    <option value="">Select a Service</option>
                                    <option value="dog-walking" {{ old('service') == 'dog-walking' ? 'selected' : '' }}>Dog Walking</option>
                                    <option value="pet-sitting" {{ old('service') == 'pet-sitting' ? 'selected' : '' }}>Pet Sitting</option>
                                    <option value="pet-grooming" {{ old('service') == 'pet-grooming' ? 'selected' : '' }}>Pet Grooming</option>
                                    <option value="veterinary" {{ old('service') == 'veterinary' ? 'selected' : '' }}>Veterinary Care</option>
                                    <option value="training" {{ old('service') == 'training' ? 'selected' : '' }}>Pet Training</option>
                                    <option value="daycare" {{ old('service') == 'daycare' ? 'selected' : '' }}>Pet Daycare</option>
                                    <option value="other" {{ old('service') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('service')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Preferred Date -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="preferred_date" class="form-label">Preferred Date</label>
                                    <input type="date" id="preferred_date" name="preferred_date" class="form-control modern-input" value="{{ old('preferred_date') }}">
                                    @error('preferred_date')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="preferred_time" class="form-label">Preferred Time</label>
                                    <select id="preferred_time" name="preferred_time" class="form-control modern-select">
                                        <option value="">Select Time</option>
                                        <option value="morning" {{ old('preferred_time') == 'morning' ? 'selected' : '' }}>Morning (8AM - 12PM)</option>
                                        <option value="afternoon" {{ old('preferred_time') == 'afternoon' ? 'selected' : '' }}>Afternoon (12PM - 5PM)</option>
                                        <option value="evening" {{ old('preferred_time') == 'evening' ? 'selected' : '' }}>Evening (5PM - 8PM)</option>
                                        <option value="flexible" {{ old('preferred_time') == 'flexible' ? 'selected' : '' }}>I'm Flexible</option>
                                    </select>
                                    @error('preferred_time')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="message" class="form-label">Additional Information</label>
                                <textarea id="message" name="message" rows="4" class="form-control modern-textarea" 
                                          placeholder="{{ $contactSettings->form_textarea_placeholder ?? 'Please let us know which day package you\'re interested in, any specific requirements, or questions you might have...' }}">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Newsletter Subscription -->
                        <div class="mb-4">
                            <div class="form-check modern-checkbox">
                                <input type="checkbox" id="newsletter" name="newsletter" class="form-check-input" {{ old('newsletter') ? 'checked' : '' }}>
                                <label for="newsletter" class="form-check-label">
                                    I'd like to receive updates and special offers via email
                                </label>
                            </div>
                            @error('newsletter')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-submit">
                            <button type="submit" class="btn modern-submit-btn">
                                <i class="fas fa-paper-plane me-2"></i>
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@if($contactSettings->show_awards ?? true)
<div class="gap">
    <div class="container">
        <h3 class="awards">{{ $contactSettings->awards_title ?? 'Awards Winning Company' }}</h3>
        <div class="awards">
            <img src="assets/img/awards-1.png" alt="awards">
            <img src="assets/img/awards-2.png" alt="awards">
            <img src="assets/img/awards-3.png" alt="awards">
            <img src="assets/img/awards-4.png" alt="awards">
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
/* Office Locations Styling */
.office-locations {
    background: #fff;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    height: fit-content;
}

.office-locations h2 {
    color: #1f2937;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    margin-bottom: 2rem;
    font-size: 1.75rem;
}

.office-card {
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border-left: 4px solid #fa441d;
    transition: all 0.3s ease;
}

.office-card:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(250, 68, 29, 0.15);
}

.office-card h5 {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
}

.office-card p {
    color: #64748b;
    margin-bottom: 0;
    line-height: 1.6;
}

/* Modern Contact Form Styling */
.contact-form-modern {
    background: #fff;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.contact-form-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #fa441d, #ff6b47, #fedc4f);
}

.form-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid #f1f5f9;
}

.form-header h3 {
    color: #1f2937;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1.75rem;
}

.form-header p {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 0;
}

/* Pet Selection Styling */
.pet-selection .form-label {
    color: #1f2937;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 1rem;
}

.pet-options {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.pet-option {
    flex: 1;
    min-width: 120px;
}

.pet-radio {
    display: none;
}

.pet-label {
    display: block;
    padding: 1rem;
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
}

.pet-label i {
    display: block;
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: #64748b;
    transition: all 0.3s ease;
}

.pet-label span {
    color: #64748b;
    transition: all 0.3s ease;
}

.pet-radio:checked + .pet-label {
    background: linear-gradient(135deg, #fa441d, #ff6b47);
    border-color: #fa441d;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.3);
}

.pet-radio:checked + .pet-label i,
.pet-radio:checked + .pet-label span {
    color: white;
}

.pet-label:hover {
    border-color: #fa441d;
    transform: translateY(-1px);
}

/* Form Controls */
.form-label {
    color: #374151;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.modern-input,
.modern-select,
.modern-textarea {
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    padding: 0.875rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fff;
    width: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
}

.modern-input:focus,
.modern-select:focus,
.modern-textarea:focus {
    outline: none;
    border-color: #fa441d;
    box-shadow: 0 0 0 3px rgba(250, 68, 29, 0.1);
    transform: translateY(-1px);
}

.modern-textarea {
    resize: vertical;
    min-height: 120px;
}

/* Checkbox Styling */
.modern-checkbox {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-checkbox .form-check-input {
    width: 20px;
    height: 20px;
    border: 2px solid #e5e7eb;
    border-radius: 4px;
    background: #fff;
    cursor: pointer;
}

.modern-checkbox .form-check-input:checked {
    background-color: #fa441d;
    border-color: #fa441d;
}

.modern-checkbox .form-check-label {
    color: #64748b;
    font-size: 0.95rem;
    cursor: pointer;
    margin-bottom: 0;
}

/* Submit Button */
.form-submit {
    text-align: center;
    margin-top: 1rem;
}

.modern-submit-btn {
    background: linear-gradient(135deg, #fa441d, #ff6b47);
    border: none;
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(250, 68, 29, 0.3);
    text-transform: none;
    min-width: 200px;
}

.modern-submit-btn:hover {
    background: linear-gradient(135deg, #e55a4f, #fa441d);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(250, 68, 29, 0.4);
    color: white;
}

.modern-submit-btn:active {
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .office-locations,
    .contact-form-modern {
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .pet-options {
        flex-direction: column;
    }
    
    .pet-option {
        min-width: 100%;
    }
    
    .form-header h3 {
        font-size: 1.5rem;
    }
    
    .modern-submit-btn {
        padding: 0.875rem 2rem;
        font-size: 1rem;
        min-width: 180px;
    }
}

/* Animation for form elements */
.form-group {
    position: relative;
}

.modern-input,
.modern-select,
.modern-textarea {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.form-group:hover .modern-input,
.form-group:hover .modern-select,
.form-group:hover .modern-textarea {
    border-color: #fa441d;
    box-shadow: 0 2px 8px rgba(250, 68, 29, 0.1);
}

/* Loading state for submit button */
.modern-submit-btn.loading {
    pointer-events: none;
    opacity: 0.7;
}

.modern-submit-btn.loading::after {
    content: '';
    width: 16px;
    height: 16px;
    margin-left: 10px;
    border: 2px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: inline-block;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@endpush
