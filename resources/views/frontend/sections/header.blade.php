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
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="fa-solid fa-box"></i>
                                    My Orders
                                </a>
                            </li>
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
                      <a href="{{ route('home') }}"><i>
                        <img alt="home" src="{{ asset('assets/img/home.png') }}">
                      </i>home</a>
                    </li>
                    <li class="navbar-dropdown">
                      <a href="{{ route('about') }}">About</a>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                      <a href="javascript:void(0)"><i>
                      </i>services</a>
                      <div class="dropdown">
                        <a href="{{ route('services') }}">services</a>
                        <a href="{{ route('services.details') }}">service details</a>
                      </div>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                      <a href="javascript:void(0)">pages</a>
                      <div class="dropdown">
                        <a href="{{ route('how-we-work') }}">how we works</a>
                        <a href="{{ route('gallery') }}">photo gallery</a>
                        <a href="{{ route('team') }}">our team</a>
                        <a href="{{ route('pricing') }}">pricing packages</a>
                      </div>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                      <a href="javascript:void(0)">Shop</a>
                      <div class="dropdown">
                        <a href="{{ route('products.index') }}">our products</a>
                        <a href="{{ route('cooked-foods.index') }}">cooked foods</a>
                      </div>
                    </li>
                    <li class="navbar-dropdown menu-item-children">
                      <a href="javascript:void(0)">News</a>
                      <div class="dropdown">
                        <a href="{{ route('blog') }}">our blog</a>
                      </div>
                    </li>
                    <li class="navbar-dropdown">
                      <a href="{{ route('contact') }}">Contact</a>
                    </li>
        </ul>
      </nav>
      <div class="menu-end">
               <div class="line"></div>
               <!-- Header Icons Container -->
               <div class="header-icons">
                   <!-- Wishlist Icon -->
                   <div class="wishlist-icon">
                       @auth
                           <a href="{{ route('wishlist.index') }}" class="icon-link" title="Wishlist">
                               <i class="fa-solid fa-heart"></i>
                               <span class="icon-count wishlist-count">{{ $wishlistCount ?? 0 }}</span>
                           </a>
                       @else
                           <a href="javascript:void(0)" class="icon-link wishlist-auth-required" title="Wishlist">
                               <i class="fa-solid fa-heart"></i>
                               <span class="icon-count wishlist-count">0</span>
                           </a>
                       @endauth
                   </div>
                   <!-- Cart Icon -->
                   <div class="cart-icon">
                       <a href="JavaScript:void(0)" class="icon-link" id="show" title="Shopping Cart">
                           <i class="fa-solid fa-shopping-bag"></i>
                           @auth
                               <span class="icon-count cart-count">{{ $cartCount ?? 0 }}</span>
                           @else
                               <span class="icon-count cart-count">0</span>
                           @endauth
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
          <li><a href="{{ route('home') }}"><i>
            <img alt="home" src="{{ asset('assets/img/home.png') }}">
          </i>Home</a></li>
          
          <li><a href="{{ route('about') }}">About</a></li>

          <li class="menu-item-has-children"><a href="JavaScript:void(0)">Services</a>
            <ul class="sub-menu">
              <li><a href="{{ route('services') }}">services</a></li>
              <li><a href="{{ route('services.details') }}">service details</a></li>
            </ul>
          </li>
          
          <li class="menu-item-has-children"><a href="JavaScript:void(0)">Pages</a>
              <ul class="sub-menu">
                <li><a href="{{ route('how-we-work') }}">how we works</a></li>
                <li><a href="{{ route('gallery') }}">photo gallery</a></li>
                <li><a href="{{ route('team') }}">our team</a></li>
                <li><a href="{{ route('pricing') }}">pricing packages</a></li>
              </ul>
          </li>
          
          <li class="menu-item-has-children"><a href="JavaScript:void(0)">Shop</a>
              <ul class="sub-menu">
                <li><a href="{{ route('products.index') }}">our products</a></li>
                <li><a href="{{ route('cooked-foods.index') }}">cooked foods</a></li>
              </ul>
          </li>
          
          <li class="menu-item-has-children"><a href="JavaScript:void(0)">News</a>
              <ul class="sub-menu">
                <li><a href="{{ route('blog') }}">our blog</a></li>
              </ul>
          </li>

          <li><a href="{{ route('contact') }}">Contact</a></li>

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
                              <a class="dropdown-item" href="{{ route('orders.index') }}">
                                  <i class="fa-solid fa-box"></i>
                                  My Orders
                              </a>
                          </li>
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