<section class="footer">
  <div class="footer-container">
    <div class="footer-centre">
      <p class="paragraph-light">Not sure which First aid course you need?</p>
      <div class="footer-title-large">Take our quiz to find out</div>
      <a href="/#quiz" class="large-button start-quiz w-button">Start quiz</a>
      <a href="{{ route('login') }}" class="header-login-button nav-link w-nav-link">Guru Login</a>
       <div class="footer-link-wrap-02">
        <a href="{{ route('aboutUs') }}" class="footer-link-white">About us</a>
        <a href="/#courses" class="footer-link-white">Courses</a>
        <!-- <a href="/#promise" class="footer-link-white">Our promise</a> -->
        <a href="{{route('become-a-guru')}}" class="footer-link-white">Become a guru</a>
        <a href="/#contact" class="footer-link-white">Contact us</a>
      </div>
      <div class="text-rights-light">Copyright © {{date('Y')}} First Aid Guru LTD. All rights reserved.</div>
    </div>
  </div>
</section>