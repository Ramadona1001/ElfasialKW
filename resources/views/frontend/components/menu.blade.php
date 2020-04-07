 <!--main menu-->

 <div class="menu-holder">

    <div class="container wide">
      
      <div class="menu-wrap">

        <!-- logo -->
        <div class="logo-wrap">

          <a href="{{ route('frontend_index') }}" class="logo "><img src="{{ asset('logo/'.$system_logo) }}" alt=""></a>

        </div>

        <div class="nav-item">
          
          <!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

          <nav id="main-navigation" class="main-navigation">
            <ul id="menu" class="clearfix">
              <li class="@yield('homeactive')"><a href="{{ route('frontend_index') }}">@lang('tr.Home Page')</a></li>
              <li class="@yield('aboutactive')"><a href="{{ route('frontend_aboutus') }}" >@lang('tr.About Us')</a></li>
              <li class="@yield('servicesactive')"><a href="{{ route('frontend_services') }}">@lang('tr.Our Services')</a></li>
              <li class="@yield('contactsactive')"><a href="{{ route('frontend_contactus') }}">@lang('tr.Contact Us')</a></li>
              @if(isset(Auth::user()->id) != null)
              <li><a href="#">@lang('tr.Hi'), {{ Auth::user()->name }}</a>
                <div class="sub-menu-wrap">
                  <ul>
                    <li><a href="{{ route('profile_users',Auth::user()->id) }}">@lang('tr.My Account')</a></li>
                    <li><a href="{{ route('dashboard_index') }}">@lang('tr.Dashboard')</a></li>
                    <li>
                      <a style="white-space:inherit;" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('tr.Logout') }}
                    </a>
                
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>  
                    </li>
                    
                  </ul>
                </div>
              </li>

              @else
              <li><a href="{{ route('login') }}">@lang('tr.Sign')</a></li>
              @endif
              @if(\Lang::locale() == 'en')
              <li class=""><a href="{{ route('dashboard_lang','ar') }}">@lang('tr.Arabic')</a></li>
              @else
              <li class=""><a href="{{ route('dashboard_lang','en') }}">@lang('tr.English')</a></li>
              @endif

            </ul>
          </nav>

          <!-- - - - - - - - - - - - - end Navigation - - - - - - - - - - - - - - - -->

          <!-- header buttons -->
    
          <div class="header-btns">


 <!-- shop button -->
 <div class="head-btn">
   @php($cartCount = \App\Order::getCartCount())
  <div class="dropdown-area">
    <a href="{{ route('cart_index') }}" class="btn btn-primary">
      <i class="fa fa-cart-arrow-down"></i>
      
    <span class="badge badge-light">{{ Cart::count() }}</span>
    </a>
    

    <div class="shopping-cart dropdown-window">

      <div class="products-holder">
  
        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
  
        <div class="product">
  
          <button class="item-close"></button>
  
          <a href="#" class="product-image">
            
            <img src="{{ asset('frontend/images/84x84_product1.jpg') }}" alt="">
  
          </a>
  
          <div class="product-description">
  
            <h6 class="product-name"><a href="#">Kids Cake</a></h6>
  
            <span class="product-price">from $25</span>
  
          </div><!--/ .product-info -->
  
        </div>
  
        <!-- - - - - - - - - - - - - - End of Product - - - - - - - - - - - - - - - - -->
  
        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
  
        <div class="product">
  
          <button class="item-close"></button>
  
          <a href="#" class="product-image">
            
            <img src="{{ asset('frontend/images/84x84_product2.jpg') }}" alt="">
  
          </a>
  
          <div class="product-description">
  
            <h6 class="product-name"><a href="#">Wedding Cake</a></h6>
  
            <span class="product-price">from $125</span>
  
          </div><!--/ .product-info -->
  
        </div>
  
        <!-- - - - - - - - - - - - - - End of Product - - - - - - - - - - - - - - - - -->
  
      </div><!--/ .products-holder -->
  
      <div class="sc-footer">
  
        <div class="subtotal">Subtotal: <span class="total-price">$31.30</span></div>
  
        <div class="btns">
  
          <a href="#" class="btn btn-style-2">View Cart</a>
          <a href="#" class="btn">Checkout</a>
  
        </div><!--/ .vr-btns-set -->
  
      </div>
  
    </div>
  </div>
</div>

            <!-- search button -->
            <div class="head-btn">
              {{-- <div class="search-holder"><button type="button" class="search-button"></button></div> --}}
            </div>

          </div>

        </div>
        
      </div>

    </div>

  </div>