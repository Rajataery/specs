@extends('layouts/frontend')
@section('content')
  <div class="section guru-signup-page">
    
    <div class="container guru-signup">
      <div class="container application">
        <div id="contact" class="contact-form-holder-copy become-guru">
          <div class="h2 contact-form">Guru Login</div>
          <div class="form-block-2 w-form">
            <form id="email-form" name="email-form" data-name="Email Form" action="{{ route('login') }}" method="post" class="form-2" enctype="multipart/form-data">
              @csrf
              <input type="text" class="email-box w-input @error('email') is-invalid @enderror" maxlength="256" name="email" data-name="Your Email 2" placeholder="Your email address" id="Your-email-2" required="">
                 @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
              <input id="password" type="password" class="email-box w-input @error('password') is-invalid @enderror"
                        name="password" placeholder="Password" required autocomplete="current-password">
            @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
              <input type="submit" value="Login" class="find-course-submit w-button">
            </form>
           
          </div>
        </div>
      </div>
    </div>
  </div>

 @endsection