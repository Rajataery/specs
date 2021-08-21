<div data-collapse="medium" data-animation="over-right" data-duration="400" data-doc-height="1" role="banner" class="main-menu w-nav customer-nav">
  <div class="menu-container w-container">
    <a href="/" class="brand w-nav-brand">
      <img src="{{ url('frontend/images/First-aid-Guru-dark-logo.svg')}}" loading="lazy" height="50" alt="">
    </a>
    <nav role="navigation" class="nav-menu-2 w-clearfix w-nav-menu">
      <img src="{{ url('frontend/images/First-aid-Guru-light-logo.svg')}}" loading="lazy" height="30" alt="" class="logo-menu">
      <a href="{{ route('customer.home') }}" class="nav-link w-nav-link">Home</a>    
      @if(Auth::guard('customer-web')->user())
                    <a class="header-login-button nav-link w-nav-link" href="{{ route('customer.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
      @else
                      
      @endif
      
    </nav>
    <div class="w-nav-button">
      <div class="w-icon-nav-menu"></div>
    </div>
  </div>
</div>
<style type="text/css">
  .menu-container{
    display: block;
  }

  .row {
    display: flex;
    flex-wrap: wrap;
    margin-right: 0;
    margin-left: 0;
}
.w-nav-brand{

  width: 150px;
  height: 50px;
}
</style>
<script type="text/javascript">
  var stripe_key = "{{ config('services')['stripe']['key'] }}";
</script>