@extends('layouts.frontend')
@section('content')

  
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <link href="{{ url('frontend/css/first-aid-guru-v2.webflow.css')}}" rel="stylesheet" type="text/css">
  
  
 
      <div class="container allCourse">
      <div class="courses-holder courseAll">

      @foreach($data as $item)
        <div class="individual-course-card">
          <div class="course-image" style="background-image: url({{asset('/frontend/images/'.$item["course_image"])}})" ></div>
          <div class="course-information-holder">
            <a href="#" class="link-block w-inline-block">
              <div class="h2 course-title homepage">{{$item->course_name}}</div>
              <div class="body-text private-courses homepage">
              <ul>
                <li>From £{{$item->public_price}}</li>
                <li>This is {{$item->duration}} Course </li>
                <li>{{$item->description}}</li>
              </ul>
              </div>
            </a>
            <a href="{{route('course_detail',$item->id)}}" class="large-button go-to-course w-button">Course info</a>
          </div>
          <div class="course-length-holder">
            <div class="body-text white course-length">{{$item->duration}} course</div>
          </div>
        </div>
      @endforeach
      </div>
</div>

<section class="section contact">
    <div class="container contact">
      <div id="contact" class="contact-form-holder">
        <div class="h2 contact-form">Talk to us</div>
        <div class="form-block-2 w-form">
          <form id="email-form" action="{{ route('contact')}}" method="post" name="email-form" data-name="Email Form" class="form-2">
              @csrf
              <input type="text" class="name-box w-input" maxlength="256" name="name" data-name="Your name" placeholder="Your name" id="Your-name" required="">
              <input type="email" class="email-box w-input" maxlength="256" name="email" data-name="Your email" placeholder="Your email address" id="Your-email" required="">
              <textarea placeholder="Your message..." maxlength="5000" id="Your-message-2" name="message" data-name="Your Message 2" class="text-area message-box w-input" required=""></textarea>
              <label class="contactTC">I agree to all the <a href="#">terms and conditions</a>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
              <input type="submit" value="Send" data-wait="Please wait..." class="find-course-submit w-button">
              <span class="contactUs-number">Contact us at
             <a  id="inhouse_call_us" class="text-center" href="tel:0203 886 0025"> 0203 886 0025</a></span>
            </form>  
            
          <div class="w-form-done">
            <div>Thank you! that worked. I&#x27;ll get back to you as soon as I can.</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection