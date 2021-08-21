<div data-collapse="medium" data-animation="over-right" data-duration="400" data-doc-height="1" role="banner" class="main-menu w-nav">
  <div class="menu-container w-container">
    <a href="/" class="brand w-nav-brand"><img src="{{ url('frontend/images/First-aid-Guru-dark-logo.svg')}}" loading="lazy" height="50" alt=""></a>
    <nav role="navigation" class="nav-menu-2 w-clearfix w-nav-menu"><img src="{{ url('frontend/images/First-aid-Guru-light-logo.svg')}}" loading="lazy" height="30" alt="" class="logo-menu">
      <a href="{{route('course_all')}}" class="nav-link w-nav-link">Courses</a>
      <!--a href="/#promise" class="nav-link w-nav-link">Our promise</a-->
      <!-- <a href="#" class="nav-link w-nav-link">Reviews</a> -->
      <a href="{{ route('become-a-guru')}}" aria-current="page" class="nav-link w-nav-link">Become a guru</a>

      <a href="/#contact" aria-current="page" class="nav-link w-nav-link">Contact Us</a>

      <a href="/#quiz" class="nav-link w-nav-link">Find the right course</a>
      <!-- <a href="{{route('allGuru')}}" class="nav-link w-nav-link">Guru</a> -->
    
      <a href="{{ URL::to('/customer') }}" class="header-login-button nav-link w-nav-link">Customer Login</a>
     

     <!--  @if(Auth::guard('customer-web')->user())
                    <a class="dropdown-item" href="{{ route('customer.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
      @else
                     
                       
      @endif -->
      
    </nav>
    <div class="w-nav-button">
      <div class="w-icon-nav-menu"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var stripe_key = "{{ config('services')['stripe']['key'] }}";
</script>