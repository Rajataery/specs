@extends('layouts.frontend')
@section('content')
  <div class="section thank-you-page">
    <div class="container thankyou-hero-container">
      <div class="hero-left thankyou-page">
        <!-- <div class="hero-logo-holder thank-you-page"><img src="{{asset('/frontend/images/First-aid-Guru-dark-logo.svg') }}" loading="lazy" alt="" class="image hero-logo"></div> -->
        <div class="course-length-holder course-page">
          <div class="body-text white course-length">You're booked on the course</div>
        </div>
        <div class="h1 course-title">Thanks for Booking us!</div>
        <div class="body-text course-hero top">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla.
         Morbi blandit nec est vitae dictum. Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.</div>
      </div>
     <div class="thankyou-right-section">
        <div class="your-booked-course thankyou-page">
          <div class="course-image thankyou-page" style="background-image: url({{asset('/frontend/images/First_Aid_Gurus_023.jpg')}})"></div>
          <div class="booked-course-info">
            <div class="link-block w-inline-block">
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
            </div>
          </div>
        </div>
      </div> 
     
    </div>
  </div>
  @endsection