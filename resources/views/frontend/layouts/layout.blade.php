<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from winsfolio.net/html/patte/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Jul 2025 05:39:16 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>patte - Home 1</title>
  <link rel="icon" href="assets/img/heading-img.png">
  @yield('style')
  <!-- CSS only -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
   <!-- fancybox -->
   <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
   <!-- style -->
   <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
   <!-- responsive -->
   <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
   <!-- color -->
   <link rel="stylesheet" href="{{ asset('assets/css/color.css') }}">
   <!-- custom -->
   <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
   <!-- jQuery -->
   <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
   <script src="{{ asset('assets/js/preloader.js') }}"></script>
 </head>
<body>
<!-- loader -->
<div class="preloader"> 
    <div class="container">
      <div class="dot dot-1"></div>
      <div class="dot dot-2"></div>
      <div class="dot dot-3"></div>
    </div>
</div>
@include('frontend.sections.header')
	@yield('content')
@include('frontend.sections.footer')
<!-- cart-popup end -->
<!-- search-popup -->
<div class="search-popup">
        <button class="close-search"><i class="fa-solid fa-arrow-right"></i></button>
        <form method="post" action="#">
            <div class="form-group">
                <input type="search" name="search-field" value="" placeholder="Search Here" required="">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
</div>
<!-- search-popup end -->
<!-- progress -->
<div id="progress">
      <span id="progress-value"><i class="fa-solid fa-up-long"></i></span>
</div>
@yield('script')
<!-- progress end -->
<!-- Bootstrap Js -->

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<!-- fancybox -->
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/custom-auth.js') }}"></script>
</body>
