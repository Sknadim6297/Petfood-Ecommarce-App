<header>
  <div class="top-bar">
    <div class="container">
      <div class="top-bar-slid">
        <div>
          <div class="phone-data">
            <div class="phone">
              <i>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <path d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z
                   M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z"></path>
                </svg>
              </i><a href="mallto:username@domain.com">username@domain.com</a>
            </div>
            <div class="phone d-flax align-items-center">
              <i>
                <svg height="112" viewBox="0 0 24 24" width="112" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="rgb(255255,255)" fill-rule="evenodd"><path d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z"></path><path d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z"></path><path d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z"></path></g></svg>
              </i>
              <a class="me-3" href="callto:+02101283492">+021 01283492</a>
            </div>
          </div>
        </div>
        <div>
          <div class="social-links">
            <ul class="social-icon">
              <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
            </ul>
            <div class="login">
                @auth
                    <div class="dropdown" id="userDropdown">
                        <a href="#" class="dropdown-toggle" id="userDropdownToggle">
                            <i class="fa-solid fa-user"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fa-solid fa-user-gear"></i>
                                    Profile Settings
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <i class="fa-solid fa-user"></i>
                    <a href="{{ route('login') }}">Login / Register</a>
                @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="bottom-bar">
      <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
        <nav class="navbar">
        <ul class="navbar-links">
                    <li class="navbar-dropdown">
                      <a href="javascript:void(0)"><i>
                        <img alt="home" src="{{ asset('assets/img/home.png') }}">
                      </i>home</a>
                    </li>
                    <li class="navbar-dropdown">
                      <a href="about.html">About</a>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                      <a href="javascript:void(0)"><i>
                      </i>services</a>
                      <div class="dropdown">
                        <a href="services.html">services</a>
                        <a href="service-details.html">service details</a>
                      </div>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                      <a href="javascript:void(0)">pages</a>
                      <div class="dropdown">
                        <a href="how-we-works.html">how we works</a>
                        <a href="photo-gallery.html">photo gallery</a>
                      </div>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                      <a href="javascript:void(0)">Shop</a>
                      <div class="dropdown">
                        <a href="{{ route('products.index') }}">our products</a>
                      </div>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                      <a href="javascript:void(0)">News</a>
                      <div class="dropdown">
                        <a href="our-blog.html">our blog</a>
                        <a href="blog-details.html">blog details</a>
                      </div>
                    </li>
                    <li class="navbar-dropdown">
                      <a href="contact.html">Contact</a>
                    </li>
        </ul>
      </nav>
      <div class="menu-end">
            <div class="header-search-button search-box-outer">
            <a href="javascript:void(0)" class="search-btn">
                <svg height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><g id="_12" data-name="12"><path d="m21.71 20.29-2.83-2.82a9.52 9.52 0 1 0 -1.41 1.41l2.82 2.83a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zm-17.71-8.79a7.5 7.5 0 1 1 7.5 7.5 7.5 7.5 0 0 1 -7.5-7.5z"></path></g></svg>
              </a>
            </div>
               <div class="line"></div>
               <!-- Header Icons Container -->
               <div class="header-icons">
                   <!-- Wishlist Icon -->
                   <div class="wishlist-icon">
                       <a href="{{ route('wishlist.index') }}" class="icon-link" title="Wishlist">
                           <i class="fa-solid fa-heart"></i>
                           <span class="icon-count wishlist-count">{{ $wishlistCount ?? 0 }}</span>
                       </a>
                   </div>
                   <!-- Cart Icon -->
                   <div class="cart-icon">
                       <a href="JavaScript:void(0)" class="icon-link" id="show" title="Shopping Cart">
                           <i class="fa-solid fa-shopping-bag"></i>
                           <span class="icon-count cart-count">{{ $cartCount ?? 0 }}</span>
                       </a>
                   </div>
               </div>
               <div class="hamburger-icon">
                  <div class="bar-menu">
                    <i class="fa-solid fa-bars"></i>
                  </div>
            </div>
      </div>
    </div>
  </div>
  <div class="mobile-nav hmburger-menu" id="mobile-nav" style="display:block;">
      <div class="res-log">
        <a href="{{ url('/') }}">
          <img src="{{ asset('assets/img/logo-w.png') }}" alt="Responsive Logo">
        </a>
      </div>
        <ul>

          <li class="menu-item-has-children"><a href="JavaScript:void(0)">Home</a>
            <ul class="sub-menu">

              <li><a href="{{ url('/') }}">home 1</a></li>
              <li><a href="index-2.html">home 2</a></li>
              <li><a href="index-3.html">home 3</a></li>
            </ul>
          </li>
          <li><a href="about.html">about</a></li>

          
          <li class="menu-item-has-children"><a href="JavaScript:void(0)">Services</a>

          <ul class="sub-menu">

            <li><a href="services.html">services</a></li>
            <li><a href="service-details.html">service details</a></li>

          </ul>

          </li>
          <li class="menu-item-has-children"><a href="JavaScript:void(0)">pages</a>
              <ul class="sub-menu">
                <li><a href="team-details.html">team details</a></li>
                <li><a href="how-we-works.html">how we works</a></li>
                <li><a href="history.html">history</a></li>
                <li><a href="pricing-packages.html">pricing packages</a></li>
                <li><a href="photo-gallery.html">photo gallery</a></li>
                <li><a href="{{ route('login') }}">login</a></li>
              </ul>

          </li>
          <li class="menu-item-has-children"><a href="JavaScript:void(0)">shop</a>

              <ul class="sub-menu">
                <li><a href="{{ route('products.index') }}">our products</a></li>
                <li><a href="product-details.html">product details</a></li>
                <li><a href="{{ route('cart.index') }}">shop cart</a></li>
                <li><a href="{{ route('checkout.index') }}">cart checkout</a></li>
              
              </ul>

          </li>
          <li class="menu-item-has-children"><a href="JavaScript:void(0)">News</a>

              <ul class="sub-menu">
                <li><a href="our-blog.html">our blog</a></li>
               <li><a href="blog-details.html">blog details</a></li>
              
              </ul>

          </li>

          <li><a href="contact.html">contacts</a></li>

          </ul>

          <!-- Mobile User Authentication Section -->
          <div class="login">
              @auth
                  <div class="dropdown" id="mobileUserDropdown">
                      <a href="#" class="dropdown-toggle" id="mobileUserDropdownToggle">
                          <i class="fa-solid fa-user"></i>
                          {{ Auth::user()->name }}
                      </a>
                      <ul class="dropdown-menu">
                          <li>
                              <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                  <i class="fa-solid fa-user-gear"></i>
                                  Profile Settings
                              </a>
                          </li>
                          <li>
                              <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                                  @csrf
                                  <button type="submit" class="dropdown-item">
                                      <i class="fa-solid fa-right-from-bracket"></i>
                                      Logout
                                  </button>
                              </form>
                          </li>
                      </ul>
                  </div>
              @else
                  <a href="{{ route('login') }}">
                      <i class="fa-solid fa-user"></i>
                      Login / Register
                  </a>
              @endauth
          </div>

          <ul class="social-icon">
              <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
          </ul>

          <a href="JavaScript:void(0)" id="res-cross"></a>
      </div>
  </div>
</header>