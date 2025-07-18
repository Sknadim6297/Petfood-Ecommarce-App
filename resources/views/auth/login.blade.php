@extends('frontend.layouts.layout')

@section('style')
<style>
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.is-invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.alert {
    position: relative;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.mb-4 {
    margin-bottom: 1.5rem;
}

/* Header dropdown styles */
.login .dropdown {
    position: relative;
}

.login .dropdown-toggle {
    text-decoration: none;
    color: inherit;
    cursor: pointer;
}

.login .dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    z-index: 1000;
    display: none;
    min-width: 160px;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.175);
}

.login .dropdown:hover .dropdown-menu {
    display: block;
}

.login .dropdown-item {
    display: block;
    width: 100%;
    padding: 0.25rem 1rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    text-decoration: none;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    cursor: pointer;
}

.login .dropdown-item:hover,
.login .dropdown-item:focus {
    color: #16181b;
    background-color: #f8f9fa;
}

.login .dropdown-divider {
    height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid #e9ecef;
}
</style>
@endsection

@section('content')
<section class="banner" style="background-color: #fff8e5; background-image:url({{ asset('assets/img/banner.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Login</h2>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img">
                    <div class="banner-img-1">
                        <svg width="260" height="260" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="{{ asset('assets/img/banner-img-1.jpg') }}" alt="banner">
                    </div>
                    <div class="banner-img-2">
                        <svg width="320" height="320" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"></path>
                        </svg>
                        <img src="{{ asset('assets/img/banner-img-2.jpg') }}" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-2">
    <img src="{{ asset('assets/img/hero-shaps-1.png') }}" alt="hero-shaps" class="img-4">
</section>

<section class="gap">
   <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="box login">
            <h3>Log In Your Account</h3>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
              @csrf
              
              <!-- Hidden field for intended URL -->
              @if(session('url.intended'))
                  <input type="hidden" name="intended_url" value="{{ session('url.intended') }}">
              @elseif(request('redirect'))
                  <input type="hidden" name="intended_url" value="{{ request('redirect') }}">
              @endif
              
              <!-- Email Address -->
              <input type="email" 
                     name="email" 
                     value="{{ old('email') }}" 
                     placeholder="Username or email address" 
                     required 
                     autofocus 
                     autocomplete="username"
                     class="@error('email') is-invalid @enderror">
              @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <!-- Password -->
              <input type="password" 
                     name="password" 
                     placeholder="Password" 
                     required 
                     autocomplete="current-password"
                     class="@error('password') is-invalid @enderror">
              @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <div class="remember">
                <div class="first">
                  <input type="checkbox" name="remember" id="remember_me">
                  <label for="remember_me">Remember me</label>
                </div>
                <div class="second">
                  @if (Route::has('password.request'))
                      <a href="{{ route('password.request') }}">Forgot Password?</a>
                  @endif
                </div>
              </div>
              <button type="submit" class="button">Login</button>
            </form>
          </div>
        </div>
        
        <div class="col-lg-6">
          <div class="box register">
            <div class="parallax" style="background-image: url({{ asset('assets/img/patron.html') }})"></div>
            <h3>Create Your Account</h3>
            
            <form method="POST" action="{{ route('register') }}">
              @csrf
              
              <!-- Hidden field for intended URL -->
              @if(session('url.intended'))
                  <input type="hidden" name="intended_url" value="{{ session('url.intended') }}">
              @elseif(request('redirect'))
                  <input type="hidden" name="intended_url" value="{{ request('redirect') }}">
              @endif
              
              <!-- Name -->
              <input type="text" 
                     name="name" 
                     value="{{ old('name') }}" 
                     placeholder="Complete Name" 
                     required 
                     autofocus 
                     autocomplete="name"
                     class="@error('name') is-invalid @enderror">
              @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <!-- Email Address -->
              <input type="email" 
                     name="email" 
                     value="{{ old('email') }}" 
                     placeholder="Email address" 
                     required 
                     autocomplete="username"
                     class="@error('email') is-invalid @enderror">
              @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <!-- Password -->
              <input type="password" 
                     name="password" 
                     placeholder="Password" 
                     required 
                     autocomplete="new-password"
                     class="@error('password') is-invalid @enderror">
              @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <!-- Confirm Password -->
              <input type="password" 
                     name="password_confirmation" 
                     placeholder="Confirm Password" 
                     required 
                     autocomplete="new-password"
                     class="@error('password_confirmation') is-invalid @enderror">
              @error('password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
              <button type="submit" class="button">Register</button>
            </form>
          </div>
        </div>
      </div>
   </div>
</section>
@endsection

@section('script')
<script>
// Handle redirect after login
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's an intended URL in session storage
    const intendedUrl = sessionStorage.getItem('intendedUrl');
    
    // Add hidden input to login form if intended URL exists
    const loginForm = document.querySelector('form[action*="login"]');
    if (loginForm && intendedUrl) {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'intended_url';
        hiddenInput.value = intendedUrl;
        loginForm.appendChild(hiddenInput);
        
        // Clear the intended URL from session storage
        sessionStorage.removeItem('intendedUrl');
    }
});
</script>
@endsection
