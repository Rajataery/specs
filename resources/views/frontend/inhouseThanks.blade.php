@extends('layouts.frontend')
@section('content')

  <div class="section thank-you-page">
    <div class="container thankyou-hero-container">
      <div class="hero-left thankyou-page">
        <div class="hero-logo-holder thank-you-page"><img src="images/First-aid-Guru-dark-logo.svg" loading="lazy" alt="" class="image hero-logo"></div>
        <div class="course-length-holder course-page">
          <div class="body-text white course-length">Response</div>
        </div>
        <div class="h1 course-title">Thanks for Booking us...</div>
        <div class="body-text course-hero top">We Will Contact You Soon!!</div>
      </div>
     <div class="thankyou-right-section">
        <div class="your-booked-course thankyou-page">
          <div class="course-image thankyou-page"></div>
          <div class="booked-course-info">
            <a href="#" class="link-block w-inline-block">
              <div class="h2 course-title homepage">Your booking</div>
              <div class="booking-breadcrumb initial-show thank-you-page">
                <div class="h5 breadcrumb">{{ @Session::get('data')['course_name'] }}</div>
                <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
                  <div class="h6 timer-info thank-you-page">{{@Session::get('data')['participants']}} Course Participants</div>
                </div>
                <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                  <div class="h6 timer-info course-page">{{@Session::get('data')['address']}}</div>
                </div>
                <div class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                  <div class="h6 timer-info course-page">{{@Session::get('data')['date']}}</div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div> 
     
    </div>
  </div>
  @endsection