
<!DOCTYPE html>
<html data-wf-page="5fbe76f73f90a0e8cf81f25d" data-wf-site="5fbe76f73f90a0308481f25c">
<head>
  <meta charset="utf-8">
  <meta name="google-site-verification" content="KlEfYpTKZhUnB2MSGzdA8cmVYfi_5WxwygPYhxk8tIs" />
  <title>First aid guru v3</title>
  <meta content="Guru page" property="og:title">
  <meta content="Guru page" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="{{ url('frontend/css/normalize.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ url('frontend/css/webflow.css')}}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" type="text/javascript"></script>
  <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOz5oWyuWCeyh-9c1W5gexDzRakcRP-eM&libraries=places&sensor=false"></script>            -->
  <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi50HL9BDpUeex4rEWooDZ9EF34my_J7o&libraries=places&callback=initAutocomplete" defer></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <link href="{{ url('frontend/css/first-aid-guru-v2.webflow.css')}}" rel="stylesheet" type="text/css">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{ url('frontend/js/jquery_form.min.js') }}"></script>
  <script src="{{ url('frontend/js/custom.js') }}"></script>
  <script src="{{ url('frontend/js/booking.js') }}"></script>

  <script>
    $(document).ready(function() {
      $(".w-webflow-badge").removeClass("w-webflow-badge").empty();
    });
  </script>

  <link href="{{url('frontend/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
  <link href="{{url('frontend/images/webclip.png')}}" rel="apple-touch-icon">
</head>
<body data-w-id="5fbb90d7cacbf073b63f48a2" class="body">
    <!-- header section here -->
     @include('layouts.frontend-header')
<div class="homePage">
  <div class="section hero-section">
    <div class="container hero-container">
      <div class="hero-left">
        <div class="h1">Find first aid courses near you</div>
        <div class="hero-link-holder">
        <div class="coursesBtn" >
        <a href="{{route('course_all')}}">
          <input type="button" class="large-button go-to-course w-button courseAll_btn " name="Courses" value="View All Courses"><!--span><img src="{{ url('frontend/images/right-arrow.png')}}" loading="lazy" height="60" width="90" alt="" class="top-icons"></span-->
        </a>
          <a href="#quiz" class="secondary-link">I’m not sure which course I need</a>
    </div>
        </div>
      </div>
      <div class="hero-right"><img src="{{ url('frontend/images/First_Aid_Gurus_025.jpg')}}" loading="lazy" width="628" sizes="(max-width: 767px) 100vw, (max-width: 991px) 48vw, 43vw" srcset="{{ url('frontend/images/First_Aid_Gurus_025-p-1080.jpeg')}} 1080w, {{ url('frontend/images/First_Aid_Gurus_025-p-1600.jpeg')}} 1600w, {{ url('frontend/images/First_Aid_Gurus_025-p-2000.jpeg')}} 2000w, {{ url('frontend/images/First_Aid_Gurus_025-p-2600.jpeg')}} 2600w, {{ url('frontend/images/First_Aid_Gurus_025-p-3200.jpeg')}} 3200w, {{ url('frontend/images/First_Aid_Gurus_025.jpg')}} 6814w" alt="" class="image hero-lower-image"><!--img src="{{ url('frontend/images/First_Aid_Gurus_0332x.jpg')}}" loading="lazy" width="434" sizes="(max-width: 767px) 100vw, (max-width: 991px) 38vw, 36vw" srcset="{{ url('frontend/images/First_Aid_Gurus_0332x-p-1080.jpeg')}} 1080w, {{ url('frontend/images/First_Aid_Gurus_0332x-p-1600.jpeg')}} 1600w, {{ url('frontend/images/First_Aid_Gurus_0332x-p-2000.jpeg')}} 2000w, {{ url('frontend/images/First_Aid_Gurus_0332x-p-2600.jpeg')}} 2600w, {{ url('frontend/images/First_Aid_Gurus_0332x-p-3200.jpeg')}} 3200w, {{ url('frontend/images/First_Aid_Gurus_0332x.jpg')}} 6655w" alt="" class="image hero-upper-image"--><img src="{{ url('frontend/images/trustpilot_circle.svg')}}" loading="lazy" alt="" class="trustpilot-logo hero homepage"></div>
    </div>
  </div>
  <div class="section orange-section">
    <div class="container orange-container course-thumb-sec">
    <div class="course-thumb">
        <h3 class="title">Most popular courses</h3>
      <div class="courses-holder">
      @foreach($data as $item)
        <div class="individual-course-card">
          <div class="course-image" style="background-image: url({{asset('/frontend/images/'.$item["course_image"])}})" ></div>
          <div class="course-information-holder">
            <a href="#" class="link-block w-inline-block">
              <div class="h2 course-title homepage">{{$item->course_name}}</div>
              <div class="body-text private-courses homepage">
              <ul>
                <li>From £{{$item->public_price}}</li>
                <li>This is {{$item->duration}} Course
                  </li>
                <li>{{$item->description}}</li>
              </ul>
              </div>
            </a>
            <a href="{{route('course_detail',$item->id)}}" class="large-button go-to-course w-button">Course info</a>
          </div>
          <div class="course-length-holder">
            <div class="body-text white course-length">{{$item->course_time}} day course</div>
          </div>
        </div>
      @endforeach
      </div>           
      </div>

  </div>
  

    
 
  <div class="section white-section course-sec">
    <div id="courses" class="container overlap-container">      
    <h2>Why choose us</h2>
    <div class="benefits-holder homepage">
        <div class="benefit"><img src="{{ url('frontend/images/pound-icon.png')}}" loading="lazy" height="60" width="90" alt="" class="top-icons">
          <div class="h3">Never beaten on Price</div>
          <div class="body-text top-benefit">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum augue id feugiat auctor. Quisque vulputate dui vel mi mattis egestas. </div>
        </div>
        <div class="benefit"><img src="{{ url('frontend/images/check-icon.png')}}" loading="lazy" height="60" width="71" alt="" class="top-icons">
          <div class="h3">Verified Experience</div>
          <div class="body-text top-benefit">Organisations can meet compliance requirements that are essential for their business</div>
        </div>
        <div class="benefit"><img src="{{ url('frontend/images/pin-icon.png')}}" loading="lazy" width="71" height="60" alt="" class="top-icons">
          <div class="h3">Nationwide Locations</div>
          <div class="body-text top-benefit">Find a local first aid training provider close to your home or work at a time that suits you</div>
                
      </div>
      
        </div> 
  </div>
    <div class="container overlap-container-course-page">
      <div class="good-company-holder">
        <div class="good-company-title">
          <div class="h2 heavy-centered">You’re In good company</div>
          <div class="h4 centered good-company">We’ve helped over 30,000 people get training</div>
        </div>
        <div class="good-company-logo"><img src="{{ url('frontend/images/Underground.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{ url('frontend/images/G4S.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{ url('frontend/images/NHS-Logo.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{ url('frontend/images/Mitie.svg')}}" loading="lazy" alt="" class="trust-logo"></div>
      </div>
    </div>
  </div>

  </div>
  <div class="section course-finder">
    <div class="container course-finder-container w-container cf-section">
      <div id="quiz" class="course-finder-title-holder">
        <div class="h1 course-finder-header">Not sure which course you need?</div>
        <div class="body-text private-courses heading">Answer a few simple questions in our short course finder quiz and quickly find the first aid course you need.</div>
      </div>
      <div class="course-finder-quiz-holder-copy quizContent">
        <div data-w-id="e7be8015-82c4-e840-3890-db10c901b920" class="course-quiz-box step-1">
          <div class="h2 heavy-centered course-finder-text">Course finder quiz</div>
          <div class="body-text course-finder-text">Use our course quiz to help you decide which course is suitable for you.</div>
          <a data-w-id="6d2f0887-f7bd-1467-228b-05be6818c90e" href="#" class="large-button start-quiz w-button">Start quiz</a>
          <div class="course-info"><img src="{{ url('frontend/images/clock2x.png')}}" loading="lazy" width="20" alt="" class="image-3">
            <div class="h6 timer-info">Less than 5 minutes</div>
          </div>
        </div>
        <div data-w-id="b70affba-213f-cc56-1ecd-65b3811f7f28" style="display:none;opacity:1" class="course-quiz-box step-2">
          <div class="h2 heavy-centered course-finder-text">Your responsibilities</div>
          <div class="form-block w-form">
            <form id="" name="" data-name="in house course form" method="post" class="form">
              <p>What Course You I Need? Use our questionnaire below to help you decide  which course Is suitable for you.</p>
              <div class="select-box-holder" id="one">

                    <label class="quizInput-box"> Are you responsible for mainly the care for Infants or children i.e. nursery, school or work as a babysitter
                      <input type="checkbox" class="form-check-input" id="quiz1" name="one">
                      <span class="checkmark"></span>
                    </label>

                    <label class="quizInput-box"> Are you Mainly responsible for the care of adults i.e. in the
                    workplace office or building site
                      <input type="checkbox" class="form-check-input" id="quiz2" name="two">
                      <span class="checkmark"></span>
                    </label>
                 
                

              </div>

              <div class="">
              <div class="newcontainer">
                  <div class="left select-box-holder" id="left_2">
                                     <label class="quizInput-box"> Do you work as an au-pair or babysitter.
                      <input type="checkbox" class="form-check-input" id="quiz3" name="three">
                      <span class="checkmark"></span>
                    </label>

                    <label class="quizInput-box"> Do you work in a nursery or school etc
                      <input type="checkbox" class="form-check-input" id="quiz4" name="four">
                      <span class="checkmark"></span>
                    </label>
                 


                  </div>
             
                   <div class="right select-box-holder" id="right_2">                
                  <label class="quizInput-box"> Do you work in a low risk environment ie office. Retails store (Not involving handling dangerous or sharp objects).
                      <input type="checkbox" class="form-check-input" id="quiz7" name="three">
                      <span class="checkmark"></span>
                    </label>

                    <label class="quizInput-box"> Do you work in an high risk environment i.e building site, kitchen or Retails store ( handling Dangerous, sharp objects or heavy loads).
                      <input type="checkbox" class="form-check-input" id="quiz8" name="three">
                      <span class="checkmark"></span>
                    </label>

               
                  </div>
                  </div>
              </div>

              <div class="">
              <div class="right_step_2">
                  <div class="right1 select-box-holder" id="right1">
                
                  <b> Are you a supervisor or manager</b>
                 <label class="quizInput-box"> Yes
                      <input type="checkbox" class="form-check-input" id="quiz9" name="three">
                      <span class="checkmark"></span>
                    </label>

                    <label class="quizInput-box"> No
                      <input type="checkbox" class="form-check-input" id="quiz10" name="three">
                      <span class="checkmark"></span>
                    </label>
                  </div>

                  <div class="secondstep_right2 select-box-holder" id="secondstep_right">
                  <p class="quizCheckbox"><a href="/course_detail/7" target="_blank">First aid at work For managers, supervisor or anyone working in high
                risk environments </a></p>
                  </div>
                           
                  </div>
              </div>

              <div class="">
                <div class="end_right">
                  <div class="last_step_right1 select-box-holder" id="last_step_right1">
                  <p class="quizCheckbox"><a href="/course_detail/7" target="_blank">First aid at Work For or supervisors and managers</a></p>
                  </div>

                  <div class="last_step_right2 select-box-holder" id="last_step_right2">
                    <p class="quizCheckbox"><a href="/course_detail/6" target="_blank">Emergency First aid at Work For Employees working in a low risk
                      environment ie office. Retails store (Not involving handling dangerous or sharp objects)</a></p>
                  </div>
                </div>
              </div>

              <div class="">
               <div class="third_step_val" id="third_step_val">
              
                  <div class="secondstep1" id="secondstep1">
                      <div class="select-box-holder" id="secondstep1"> 
                        <p class="quizCheckbox"><a href="/course_detail/8" target="_blank">Paediatric first Aid (6hr) course “ au-pairs babysitters. However this course is not OFSTED APPROVED. For OFSTED APPROVED course opt for Paediatrics First Aid (OFSTED Approved)</a> </p></div>
                  
                </div>
              
             
                   <div class="secondstep2 select-box-holder" id="secondstep2">
                      

                  <b>Are you a supervisor or manager  </b>
                 <label class="quizInput-box"> Yes
                      <input type="checkbox" class="form-check-input" id="quiz5" name="five">
                      <span class="checkmark"></span>
                    </label>

                    <label class="quizInput-box"> No
                      <input type="checkbox" class="form-check-input" id="quiz6" name="six">
                      <span class="checkmark"></span>
                    </label>
                

                </select>
                  </div>
                  
                </div>
                  </div>
              
               <div class="">         
                <div class="left_last" id="left_last">
                  <div class="secondstep_right1 select-box-holder" id="secondstep_right1">
                  <p class="quizCheckbox"><a href="/course_detail/7" target="_blank">First aid at work supervisors and managers. As the field
                        you are in involved mainly infants and children Paediatric first aid ( OFSTED APPROVED) Is recommended as it specialises for this age group </a></p> 
                  </div>

                   <div class="secondstep_right2 select-box-holder" id="secondstep_right2">
                   <p class="quizCheckbox"><a href="/course_detail/8" target="_blank">Paediatric First Aid (OFSTED APPROVED) is suitable for you nursery or
                      school etc. </a></p>
                  </div>
                  
              </div>
              </div>
           
            </form>

            <div class="w-form-done select-box-holder">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail select-box-holder">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
         <!--  <a data-w-id="b70affba-213f-cc56-1ecd-65b3811f7f2d" href="#" class="large-button start-quiz w-button">Next question</a> -->
        </div>
        <div data-w-id="7c3d2b4f-9968-ae85-b420-46dc276a3765" style="display:none;-webkit-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="individual-course-card the-answer">
          <div class="course-image"></div>
          <div class="course-information-holder">
            <a href="#" class="link-block w-inline-block">
              <div class="h2 course-title homepage">Emergency First Aid at Work</div>
              <div class="body-text private-courses homepage">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.</div>
            </a>
            <a href="#" class="large-button go-to-course w-button">Course info</a>
          </div>
          <div class="course-length-holder">
            <div class="body-text white course-length">1 day course</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-2"></div>
  <div class="section trustpilot-review-section"><img src="{{ url('frontend/images/trustpilot_circle.svg')}}" loading="lazy" alt="" class="trustpilot-logo">
    <!--div class="container trustpilot-review-container">
      <div class="insert-review-widget">
        <div class="white-text">Review widget</div>
      </div>
    </div>
    <a href="#" class="large-button white-button w-button">See more</a-->
  </div>

  <div class="section private-courses-section orange-bg">
    <div class="container private-courses-container">
      <!-- Public Course -->
      <div class="public-courses-holder">
        <div class="private-courses-text-holder">
          <div class="private-course-information">
            <div id="public_course_text">
              <div class="h2 private-course-header">Public courses</div>
              <div class="h5">For individuals and small groups</div>
              <div class="body-text private-courses inhouse">Evening and weekend public courses are available with qualified, accredited trainers teaching vital first aid skills in a relaxed and friendly environment.</div>
              <div class="course-search-holder"></div>
            </div>
            <div class="form-block w-form" id="public_step1">
              <form id="public_booking_search" name="" data-name="in house course form" class="form">
                @csrf
                <div class="select-box-holder">
                  <select id="public_course" name="course" data-name="Select course" required="" class="select-box w-select">
                    <option value="">Select a first aid course</option>
                    @foreach ($data_dropdown as $item)  
                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                    @endforeach
                  </select>
                </div>
                <input type="text" id="google_address_public" class="google-address-search w-input" name="address" placeholder="First line of your address or postcode" autocomplete="off">
                <input type="hidden" name="lat" value="" id="latitude">
                <input type="hidden" name="count" value="1" id="contLoad">
                <input type="hidden" name="lang" value="" id="longitude">
                <div class="text-danger mt-2" id="public_fields_required"></div>

                @if(Session::has('public_error'))
                  <div class="mt-2 alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      {{ Session::get('public_error') }}
                  </div>
                  @if ($errors->any())
                    <div class="mt-2 alert alert-danger alert-dismissible custom-message">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                  @endif
                @endif

                <input type="submit" value="Find Course" data-wait="Searching Course..." class="find-course-submit w-button">
              </form>
            </div>


            <div class="booking-breadcrumb d-none" id="public_step2">          
              <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>
                <input type="button"  value=" Back" data-wait="" onclick="publicStepOne()" >
             </a>
              <div class="h3 dark">Select a location</div>
              <div class="form-block-3 w-form">
                <form id="select_location_form" class="form course-page">
                  <div class="container text-center loader_form" style="height:0px;">
                    <div class="modal" id="modal_loadmore" > <img data-src="http://itsolutionstuff.com/upload/PHP-Angular-JS.png" src="{{ url('frontend/images/Eclipse-1s-147px.gif')}}" class="img-1" style="margin-top: 26%"> </div>
                  </div>
                  <div class="location-cards-holder">
                  </div>
                  <div id="load_more">
                     <input type="hidden" name="number_val" id="number" value="1" />
                     <!--button class="loadMore"  type="button" onclick="search_courses()" value ="2" id="load_more" name="loadmore">Load More <span>&#187;</span></button-->
                </div>
                <input type="text" name="date" id="public_course_date" class="d-none">

                <div class="calendar-holder">
                    
                    <div class="date-holder">
                        <div id="seatdata"></div>
                        <div id="error" class="text-center text-danger">  </div>

                        <div class="h3 dark calendar-title section2 d-none" id="calendar-title">Please choose your start date</div>

                        <div id="datepicker_public" onchange="GetCourseDatePublic()"> 
                        
                      </div>
                </div>
              </div>
              <div id="seats_public"> </div>
              <div id="date_public"> </div>
              <div id="seats_left"> </div>
              <div id="seat_price"> </div>

              <div class="text-danger text-center" id="date_required_public"></div>
              <div data-w-id="87e98ebd-ba1e-f828-9e8d-e838406fe07c" class="h6 breadcrumb-info not-selected d-none" id="selected_date_show"></div>
              <div class="date-availability d-none">Available</div>
              <input type="hidden" id="selected_course_date" name="date">
              
              <div class="form-group d-none choose-seats" id="select_public_seats">
                    <!--label for="public_participants m-0">Select no. of seats </label-->
                    <div class="h3 dark persons-title" id="persons-title">How many participants?</div>
                    <div class="row select_seat">
                      <button class="col-1 btn dec" type="button" onclick="decreasePublicParticipants()" name="public_participants"> - </button>

                      <input class="col-2 form-control" value="1" required="" readonly="" id="public_participants" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="public_participants">

                      <input type="hidden" name="validatecoupon" value="" id="validatecoupon">

                      <button class="col-1 btn inc" type="button" onclick="increasePublicParticipants(); GetCourseDatePublic()" name="public_participants" id="publicParticipant">+</button>

                    </div>
                  </div>
                <div class="payment-submit b-price">
                  <div class="price-holder d-none" id="public_price">
                  <div class="h3 b-cost d-none">Booking cost:</div>
                    <div class="h2 total-price public_course_price"></div>
                    <!--div class="h6">Inc. VAT</div-->
                  </div>
                </div>
                  
                  <span id="venue_error_message" class="text-danger"> </span>
                 <input type="submit" value="Book Now"  data-wait="Loading form" class="find-course-submit course-page w-button bookEvent submit_course d-none" id="find-course-submit">
                 
                </form>
              </div>
            
              <!-- <div class="trust-holders-booking">
                <img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt="" class="image-5"><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt="" class="image-6">
              </div> -->
              <div class="course-icon-holder">
          <div class="trustpilot-holder"><img src="{{url('frontend/images/trsutpilot.svg')}}" loading="lazy" alt=""></div>
          </div>
            </div>

            <div class="booking-breadcrumb d-none" id="public_step3">
            <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>
              <input type="button"  value="Back" data-wait="" onclick="publicSteptwo()" >
            </a>
              <div class="h3 dark" id="bookingPublic">Your booking</div>
              <div class="booking-breadcrumb initial-show">
                <div class="h5 breadcrumb course_name_show" id="public_course_name"></div>
                <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
                  <div class="h6 timer-info course-page" id="public_course_seats"></div>
                </div>
                <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                  <div class="h6 timer-info course-page" id="public_course_location"></div>
                </div>
                <div class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                  <div class="h6 timer-info course-page course_location_date" id="public_course_date1"></div>
                </div>
              </div>
              <div class="container text-center loader_form" style="height:0px;">
                    <div class="modal overlay loader_form" id="modal" > <img data-src="http://itsolutionstuff.com/upload/PHP-Angular-JS.png" src="{{ url('frontend/images/Rolling.gif')}}" class="img-1">
                    
                    </div>

                  </div>

              <div class="flex_head">
              <div class="h3 dark checkout">Secure checkout</div>
              <div class="trust-holders-booking"><img src="{{ url('frontend/images/stripe2.svg')}}" loading="lazy" alt=""></div>
              </div>

                <div class="checkout-form-block w-form">
                	<form id="public_checkout_form" method="post" action="{{route('bookingPublic.checkout')}}" name="email-form"
                		data-name="Email Form" class="secure-checkout public-require-validation" data-cc-on-file="false">
                		@csrf


                		<input type="hidden" name="participants" id="public_selected_participants">
                		<input type="hidden" name="courses_id" id="courses_id">

                    
                		<div class="payment-form-detail">                        
                				<div class="person-details" id="public_participants_list"></div>
                      <div class="payment-form-content">
                		  	<div class="pt-2 mb-2 booker">
                		  		<b> Main Candidate </b>
                		  		<input type="text" class="name w-input" maxlength="256" name="participant_detail[0][name]"
                		  			placeholder="Name" required="">
                		  		<input type="email" class="name w-input" maxlength="256" name="participant_detail[0][email]"
                		  			data-name="Email address" placeholder="Email address" required="">
                		  		<input type="text" class="name w-input phone_number" onkeyup="validateNumber(this)" maxlength="15"
                		  			name="participant_detail[0][phone]" data-name="phone" placeholder="Phone No" required="">
                		  	</div>


                		  	<!-- <input type="text" class="name business w-input" maxlength="256" name="businessName" data-name="Business name" placeholder="Business name" id="Business-name" required=""> -->
                		  	<input type="hidden" id="public_date_id" name="date_id">
                        <input type="hidden" id="public_date" name="date">

                		  	<div class="secure-checkout-holder-copy pb-payment">

                				<input type="text" class="payment-info w-input" maxlength="256" name="card_name" data-name="Card Name"
                					placeholder="Card Holder Name" id="public_customer_name" autocomplete="off" required="">
                				<div class="mt-3 customer-card-number" id="public_card_number"></div>
                				<div class="cvv-and-exp-holder">
                					<div class="card-number-holder cvv customer-card-expiry" id="public_card_expiry"></div>
                					<div class="card-number-holder cvv customer-card-cvv" id="public_card_cvv">
                					</div>
                					<div class="powered-by-holder">
                						<img src="{{ url('frontend/images//stripe1.svg')}}" loading="lazy" height="25" alt=""
                							class="image-7">
                					</div>
                				</div>
                				<div id="public_card_errors" class="text-danger text-center" role="alert"></div>
                	    </div>
                		</div>
                        <div class="coupon-code">
                        <div class="apply-code"><a class="u-price" id="apply-cpn-code">Apply coupon code</a>
                				<div class="d-applied" id="discount_code_message"></div></div>
                        <div class="coupon-popup" id="cpn-popup">
                        <input type="text" name="coupon" placeholder="Discount Coupon" id="discount_code"	class="w-input coupon">
                        <div id="discount_code_action">
                					<input type="button" name="Apply" value="Apply" id="apply_discount_button"
                						onclick="applyDiscountCode('public')" class="w-button">
                            </div>
                        </div>
                        
                				<input type="hidden" class="name" id="code" value="" name="code">
                				<p id="discount_code_applied"></p>
                				<input type="hidden" name="check_coupon" value="no" id="checkcoupon_public">                				
                        </div>
                				<div class="d-none" id="u-total">                			
                        <p class="u-price"><span class="value" id="sub_total"><span></p>
                        <p class="u-price"> <span class="value d-none" id="pricevat"><span></p>
                				<p class="u-price"> <span class="value" id="discount"><span></p>
                        <p class="u-price"> <span class="value" id="grand_total"><span></p>
                          </div>

                				<input type='hidden' name='stripeToken' id="public_stripe_token" />
                				<label class="w-checkbox terms-and-conditions mt-4 ml-5">
                					<div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox">
                					</div>
                					<div class="loader"></div>

                					<input type="checkbox" name="terms_and_conditions" data-name="Terms and conditions" required=""
                						style="opacity:0;position:absolute;z-index:-1">

                					<a href="/terms-conditions" target="_blank"> <span class="checkbox-label w-form-label">I agree with
                							the terms and conditions</span> </a>
                				</label>
                    </div>
                		<div class="payment-submit">
                			<div class="price-holder">
                				<div class="h2 total-price public_course_price price_coupon"></div>
                				<div class="h6">Inc. VAT</div>
                			</div>
                			<div class="secure-button"><input type="submit" value="Checkout" data-wait="Loading checkout"
                					class="guru-flow secure-checkout-button w-button"><img src="{{ url('frontend/images/Lock2x.png')}}"
                					loading="lazy" width="16" alt="" class="image-4"></div>
                		</div>
                	</form>
                </div>
              <!-- <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div> -->
              <div class="course-icon-holder">
          <div class="trustpilot-holder"><img src="{{url('frontend/images/trsutpilot.svg')}}" loading="lazy" alt=""></div>
          </div>
            </div>

          </div>
        </div>
        
        <div class="private-courses-image second-image"></div>
      </div>

      <!-- Private Course -->
      <div class="private-courses-holder">
        <div class="private-courses-image"></div>
        <div class="private-courses-text-holder">
          <div class="private-course-information">
            <div id="inhouse_course_text">
              <div class="h2 private-course-header">In-house courses</div>
              <div class="h5">For groups over 8 people and corporate</div>
              <div class="body-text private-courses inhouse">Book in-house first aid courses for large groups to ensure your business meets HSE compliance requirements, covering Emergency First Aid at Work, First Aid at Work and Paediatric First Aid.</div>
              <div class="course-search-holder"></div>
            </div>

            <div class="form-block w-form">
              <div id="inhouse_booking_data">
              </div>

              <form id="inhouse_checkout_form" action="{{ route('bookInhouseCourse') }}" name="wf-form-in-house-course-form" data-name="in house course form" method="post" class="stripe-require-validation">
                @csrf

                <div id="inhouse_step1">
                  <div class="select-box-holder">
                    <select id="private-in-house-course" onchange="getInhousePrice()" name="course" data-name="Select course" required="" class="select-box w-select">
                      <option value="">Select a first aid course</option>
                      @foreach ($data_dropdown as $item)  
                      <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="select-box-holder corporate-selection">
                    <select id="inhouse_participants" onchange="bookingParticipants(this)" name="participants" data-name="Participants" required="" class="select-box w-select">
                      <option value="" >Participants</option>
                      <option value="1_12">1 - 12</option>
                      <option value="12_24">12 - 24</option>
                      <option value="24_36">24 - 36</option>
                      <option value="36+">36+</option>
                    </select>
                  </div>
                  <input type="hidden" name="lat" value="" id="inhouse_lat">
                  <input type="hidden" name="lang" value="" id="inhouse_long">
                  <input type="text" id="google_address_inhouse" class="google-address-search w-input d-none" maxlength="256" name="address"  placeholder="First line of your address or postcode" autocomplete="off">

                  <div class="price-holder inhouse_price d-none">
                    <div class="h2 total-price inhouse_course_price"></div>
                    <div class="h6">Inc. VAT</div>
                  </div>
                  <div class="text-danger mt-2" id="inhouse_fields_required"></div>

                  @if(Session::has('inhouse_error'))
                    <div class="mt-2 alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('inhouse_error') }}
                    </div>

                    @if ($errors->any())
                      <div class="mt-2 alert alert-danger alert-dismissible custom-message">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          @foreach ($errors->all() as $error)
                          {{ $error }}<br>
                          @endforeach
                      </div>
                    @endif
                  @endif

                  <div id="inhouse_form_buttons">
                    <input type="button" id="inhouse_submit" onClick="showAddressField()" value="Book Course" data-wait="Booking course..." class="find-course-submit w-button">
                  </div>
                  <a id="inhouse_call_us" class="find-course-submit w-button d-none text-center text-white" href="tel:124522">Call Us</a>
                </div>

                <div id="inhouse_step2" class="d-none">
                <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>          
                  <input type="button"  value="Back" data-wait="" onclick="inhouseStepone()" >
                </a>
                  <div class="booking-breadcrumb" id="choose-date" >
                    <div class="h3 dark">Select a course date</div>
                     <div class="w-form cal-date-info">
                      <input type="text" name="date" id="inhouse_course_date" class="d-none" required>
                        <div id="datepicker"></div>

                      </div>
                      <div data-w-id="3d324d2f-3bde-c201-f860-e018f86ce0ad" class="date-selection-mobile">
                        <div class="date-selcted-holder">
                          <div class="date-selection on-mobile"></div>
                          <div class="date-selection month"></div>
                        </div>
                        <div class="price-holder initial-selection">
                        </div>
                      </div>
                     <div class="btn_div">
                      <div class="price-holder inhouse_price d-none">
                        <div class="h2 total-price inhouse_course_price"></div>
                        <div class="h6">Inc. VAT</div>
                      </div>
                      <input type="button"  data-wait="Loading form" value="Secure Checkout" class="find-course-submit course-page w-button" onClick="selectDate()">
                      </div>

                      <div class="text-danger text-center" id="date_required"></div>
                    
                    <!-- <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt="" class="image-5"><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt="" class="image-6"></div> -->
                    <div class="course-icon-holder">
          <div class="trustpilot-holder"><img src="{{url('frontend/images/trsutpilot.svg')}}" loading="lazy" alt=""></div>
          </div>
                  </div>
                </div>

                <div id="inhouse_step3" class="d-none">
                <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>
                  <input type="button"  value="Back" data-wait="" onclick="inhouseSteptwo()" >
                </a>
                  <div class="h3 dark">Your booking</div>
                    <div class="booking-breadcrumb initial-show">
                      <div class="booking_course h5 breadcrumb" id="inhouse_selected_course"></div>
                      <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
                        <div id="part1" class="h6 timer-info course-page" >
                         <span class="booking_participants" id="inhouse_selected_participants"> </span>  Course Participants
                        </div>
                      </div>
                      <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                        <div class="booking_address h6 timer-info course-page" id="inhouse_booking_address" ></div>
                      </div>
                      <div class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                        <div class="h6 timer-info course-page inhouse_selected_date"></div>
                      </div>
                    </div>
                      <div class="container text-center loader_form"  style="height:0px;">
                        <div class="modal overlay" id="modal_inhouse"> <img data-src="http://itsolutionstuff.com/upload/PHP-Angular-JS.png" src="{{ url('frontend/images/Rolling.gif')}}" class="img-1"> </div>
                      </div>  

                  <div class="booking-breadcrumb">
                  <div class="flex_head">
                    <div class="h3 dark checkout">Secure checkout</div>
                    <div class="trust-holders-booking"><img src="{{ url('frontend/images/stripe2.svg')}}" loading="lazy" alt=""></div>
                  </div>

                    

                    <div class="checkout-form-block w-form secure-checkout">
                    <div class="payment-form-detail">                      
                    <div class="payment-form-content">
                     <div class="user-detail">
                       <input type="text" class="name w-input" maxlength="256" name="name" data-name="Name" placeholder="Your name" id="Name" required="">
                       <input type="text" class="name business w-input" maxlength="256" name="businessName" data-name="Business name" placeholder="Business name" id="Business-name" required="">
                       <input type="email" class="email-address w-input" maxlength="256" name="email" data-name="Email address" placeholder="Your email address" id="Email-address" required="">
                       <input type="text" class="name phone w-input" maxlength="256" name="phone" data-name="Phone Number" placeholder="Phone No" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">
                     </div>
                      <div class="secure-checkout-holder-copy">
                        <input type="text" class="payment-info w-input" maxlength="256" name="card_name" data-name="Card Name" placeholder="Card Holder Name" id="inhouse_customer_name" autocomplete="off" required="">
                        <div class="mt-3 customer-card-number" id="inhouse_card_number"></div>
                        <div class="cvv-and-exp-holder">
                          <div class="card-number-holder cvv customer-card-expiry" id="inhouse_card_expiry"></div>
                          <div class="card-number-holder cvv customer-card-cvv" id="inhouse_card_cvv">
                          </div>
                          <div class="powered-by-holder">
                            <img src="{{ url('frontend/images//stripe1.svg')}}" loading="lazy" height="25" alt="" class="image-7">
                          </div>
                        </div>  
                         <div id="inhouse_card_errors" class="text-danger text-center" role="alert"></div>                  
                      </div>                      
                    </div>

                    <div class="coupon-code">
                    <div class="apply-code"><a class="u-price" id="apply-cpn-code_inhouse">Apply coupon code</a>
                    <div class="d-applied" id="discount_code_message_inhouse"> </div>
                  </div>
                  <div class="coupon-popup" id="cpn-popup_inhouse">
                    <input type="text" name="coupon" placeholder="Discount Coupon" id="discount_code_inhouse" class="w-input coupon">
                    <div id="discount_code_action_inhouse">
                    <input type="button" name="Apply" value="Apply" id="apply_discount_button_inhouse" onclick="applyDiscountCodeInhouse('inhouse')" class="w-button">
                  </div>
                </div>
                      <input type="hidden" class="name" id="code_inhouse" value="" name="code">                     
                      <p id="discount_code_applied_inhouse"> </p>
                    <input type="hidden" name="check_coupon" value="no" id="checkcoupon">  
                    </div>
                    <div class="d-none" id="u-price">
                      <p class="u-price"><span class="value" id="sub_total_inhouse"><span></p>
                      <p class="u-price"> <span class="value" id="discount_inhouse"><span></p>
                      <p class="u-price"> <span class="value" id="grand_total_inhouse"><span></p>
                    </div>
                        <input type='hidden' name='stripeToken' id="inhouse_stripe_token" />
                        <label class="w-checkbox terms-and-conditions mt-4 ml-5">
                          <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox">
                          </div>
                          <input type="checkbox" name="terms_and_conditions" data-name="Terms and conditions" required="" style="opacity:0;position:absolute;z-index:-1">
                            <span for="Terms and conditions" class="checkbox-label w-form-label"><a href="/terms-conditions" target="_blank">I agree with the terms and conditions</a></span>
                        </label>
                       
                    </div>
                    <div class="payment-submit">
                    <div class="price-holder price_inhouse">
                      <div class="h2 total-price inhouse_course_price amount"></div>
                      <div class="h6">Inc. VAT</div>
                    </div>                

                      <div class="secure-button">
                        <input type="submit" value="Checkout" data-wait="Loading checkout" class="guru-flow secure-checkout-button w-button">
                          <img src="{{ url('frontend/images/Lock2x.png')}}" loading="lazy" width="16" alt="" class="image-4">
                      </div>
                    </div>
                     </form>
                    </div>
                    <!-- <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div> -->
                    <div class="course-icon-holder">
          <div class="trustpilot-holder"><img src="{{url('frontend/images/trsutpilot.svg')}}" loading="lazy" alt=""></div>
          </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
  <!--div class="section brand-promise">
    <div class="container brand-promise">
      <div class="brand-promise-holder" id="promise">
        <div class="hero-logo-holder brand-promise"><img src="{{ url('frontend/images/First-aid-Guru-dark-logo.svg')}}" loading="lazy" alt="" class="image hero-logo brand-promise"></div>
        <div class="h1">The brand promise we make to you</div>
        <div class="body-text brand-promise">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.  Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.</div>
      </div>
      <div class="brand-promise-images"><img src="{{ url('frontend/images/First_Aid_Gurus_070.jpg')}}" loading="lazy" width="628" sizes="(max-width: 479px) 100vw, (max-width: 767px) 61vw, (max-width: 991px) 31vw, 41vw" srcset="{{ url('frontend/images/First_Aid_Gurus_070-p-1080.jpeg')}} 1080w, {{ url('frontend/images/First_Aid_Gurus_070-p-1600.jpeg')}} 1600w, {{ url('frontend/images/First_Aid_Gurus_070-p-2000.jpeg')}} 2000w, {{ url('frontend/images/First_Aid_Gurus_070-p-2600.jpeg')}} 2600w, {{ url('frontend/images/First_Aid_Gurus_070-p-3200.jpeg')}} 3200w, {{ url('frontend/images/First_Aid_Gurus_070.jpg')}} 7360w" alt="" class="image brand-promise"><img src="{{ url('frontend/images/First_Aid_Gurus_032.jpg')}}" loading="lazy" width="434" sizes="(max-width: 479px) 100vw, (max-width: 767px) 67vw, (max-width: 991px) 37vw, 434px" srcset="{{ url('frontend/images/First_Aid_Gurus_032-p-1080.jpeg')}} 1080w, {{ url('frontend/images/First_Aid_Gurus_032-p-1600.jpeg')}} 1600w, {{ url('frontend/images/First_Aid_Gurus_032-p-2000.jpeg')}} 2000w, {{ url('frontend/images/First_Aid_Gurus_032-p-2600.jpeg ')}}2600w, {{ url('frontend/images/First_Aid_Gurus_032-p-3200.jpeg ')}} 3200w, {{ url('frontend/images/First_Aid_Gurus_032.jpg')}} 7360w" alt="" class="image brand-promise-upper"><img src="{{ url('frontend/images/trustpilot_circle.svg')}}" loading="lazy" alt="" class="trustpilot-logo brand-promise">
        <div class="hero-image-holder lower-image"></div>
      </div>
    </div>
  </div-->
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
  </div>
  <!-- footer -->
  @include('layouts.frontend-footer')
  <!--div class="background-bubbles">
    <div class="big-bubble-holder">
      <div data-w-id="025da238-5740-9253-53fc-93459d1c27bd" class="bubble big"></div>
    </div>
    <div class="tiny-buuble-holder">
      <div data-w-id="7b077c56-d965-e98f-00b5-ff66080704cb" class="bubble tiny"></div>
    </div>
    <div class="mediumbubble-holder-copy">
      <div data-w-id="0bad8cef-55b7-85fd-0103-4e967c7d5686" class="bubble medium"></div>
    </div>
    <div class="big-bubble-holder hidden-mobile">
      <div data-w-id="10d72b53-97ea-67af-c243-99d42a24fa98" class="bubble big"></div>
    </div>
    <div class="small-bubble-holder-copy">
      <div data-w-id="1a63b9a1-9e5c-2867-84e5-65c8dd04e3e8" class="bubble small"></div>
    </div>
  </div-->


  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://use.typekit.net/kde5sqc.js" type="text/javascript"></script>
  <script src="{{url('frontend/js/webflow.js')}}" type="text/javascript"></script>
    
  <script type="text/javascript">
    try {
      Typekit.load();
    } catch (e) {}
  </script>

  <script>
    WebFont.load({
      google: {
        families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]
      }
    });

  </script>

  <script type="text/javascript">
      ! function(o, c) {
        var n = c.documentElement,
          t = " w-mod-";
        n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
      }(window, document);
    </script>
    
  <script>

    let placeSearch, autocomplete;
    function initAutocomplete() {
      autocomplete = new google.maps.places.Autocomplete(
       document.getElementById('google_address_public'),
       { 
          componentRestrictions: {country: "uk"}
       }
      );

      autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();

        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();

        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;
      });

      autocomplete2 = new google.maps.places.Autocomplete(
        document.getElementById('google_address_inhouse'),{
          componentRestrictions: {country: "uk"}
        }
      );

      autocomplete2.addListener("place_changed", () => {
        const place1 = autocomplete2.getPlace();
        var lat1 = place1.geometry.location.lat();
        var long1 = place1.geometry.location.lng();
        document.getElementById("inhouse_lat").value = lat1;
        document.getElementById("inhouse_long").value = long1;
      });
    }

    function fillInAddress() {
     autocomplete.setFields(['geometry']);
     var location = autocomplete.getPlace().geometry.location;

    }

    function ConvertAddress(){
      var value =  document.getElementById("google_address").value;
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode( { 'address': value}, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {
          var latitude = results[0].geometry.location.lat();
          var longitude = results[0].geometry.location.lng();
          document.getElementById("latitude").value = latitude;
          document.getElementById("longitude").value = longitude;
        } 
      }); 
    }

    $(document).ready(function() {
      $(".w-webflow-badge").removeClass("w-webflow-badge").empty();
    });

    $(document).ready(function(){
      $("#public_checkout_form").on("submit", function(){
      loader();
      });//submit
    });//document ready
  
 
$("#left_2").hide();
$("#right").hide();
$("#secondstep1").hide();
$("#secondstep2").hide();
$("#secondstep_right2").hide();
$("#secondstep_right1").hide();
$("#right_2").hide();
$("#right1").hide();
$("#secondstep_right").hide();
$("#last_step_right2").hide();
$("#last_step_right1").hide();


$('#quiz1').click(function() {

  if($(this).is(":checked")){
    setTimeout(function() { 
      $("#left_2").show();
      $("#one").hide();
      $("#right").hide();
    },200);
  } 

  
});

$('#quiz2').click(function() {

   if($(this).is(":checked")){
    setTimeout(function() { 
      $("#right_2").show();
      $("#one").hide();
    },200);

   }
  
});

$('#quiz3').click(function() {
   
  if($(this).is(":checked")){
    setTimeout(function() { 
    $("#left_2").hide();
    $("#secondstep1").show();
    $("#right").hide();
    $("#secondstep2").hide();
  },200);   
   }
  
});

$('#quiz4').click(function() {
   
   if($(this).is(":checked")){
      setTimeout(function() { 
      $("#left_2").hide();
      
       $("#secondstep2").show();
      },200);
   }
  
});

$('#quiz5').click(function() {
   
   if($(this).is(":checked")){
      setTimeout(function() {
      $("#secondstep2").hide();
      
       $("#secondstep_right1").show();
       },200);
   }
  
});
$('#quiz6').click(function() {
   
   if($(this).is(":checked")){
    setTimeout(function() {
      $("#secondstep2").hide();
      
       $("#secondstep_right2").show();
       },200);
   }
  
});

$('#quiz7').click(function() {
   
   if($(this).is(":checked")){
     setTimeout(function() {
      $("#right_2").hide();
      
       $("#right1").show();
       },200);
   }
  
});
$('#quiz8').click(function() {
   
   if($(this).is(":checked")){
      setTimeout(function() {
      $("#right_2").hide();
      
       $("#secondstep_right").show();
       },200);
   }
  
});
$('#quiz9').click(function() {
   
   if($(this).is(":checked")){
      setTimeout(function() {
      $("#right1").hide();
      
       $("#last_step_right1").show();
      },200);
   }
  
});
$('#quiz10').click(function() {
   
   if($(this).is(":checked")){
      setTimeout(function() {
      $("#right1").hide();
      
       $("#last_step_right2").show();
      },200);
   }
  
});

$('#cpn-popup').hide();
$('#apply-cpn-code').on('click', function(e) {
  e.preventDefault();
  $('#cpn-popup').show();
  $('#discount_code').show();
  $('#apply_discount_button').show();
  
});


function applyDiscountCode(type) {

            $('#checkcoupon_public').val("no");
            $("#apply_discount_button").prop('disabled',true);
            let code = $('#discount_code').val();
            if(!code){
              $("#discount_code_message").html(`<span class="text-danger">(Please add a discount code.)</span>`);
              $("#apply_discount_button").prop('disabled',false);
              return;
            }else{
              $("#discount_code_message").html('');
            }
            date = $("#selected_course_date").val();
            let date_id   = null;
            if(type == "public")
            {
              
              date_id   = $("#public_date_id").val();
              
             
            }
              let course_id = $("#public_course").val();

              let vendor = $("#course_vendor").text();
              
              let price = $("#public_total_price").text();
              $("#sub_total").html(`<label> Sub Total : </label> <span>£`+price+`</span>`);
            $.ajax({
                url: "{{ route('discountCode') }}",
                method: 'POST',
                data:{
                  type: type,
                  course_id: course_id,
                  date_id: date_id,
                  date: date,
                  discount_code:code,
                  price:price,
                  vendor:vendor,
                  "_token": "{{ csrf_token() }}"
                },
                success: function(response) {

                  $('#discount_code').hide();
                  $('#apply_discount_button').hide();
                  $(".price_public").hide();
                  $('#u-total').removeClass("d-none");
                  $('.price-holder').addClass("d-none");
                  let vat = 0;
                  let discount = 0;
                  let discounted_price = 0;
                  let html = ``;

                  console.log('price',response.setting.value);
                  let vatamount = parseInt(response.setting.value);
                  if(response.event.vat == 1){
                    pricevat = parseInt(price)+(parseInt(price)*parseInt(response.setting.value)/100); 
                    $("#pricevat").html(`<label>VAT : </label><span>£`+response.setting.value+`%</span>`);
                   $('#pricevat').removeClass('d-none');
                  }else{
                        pricevat = price;
                    
                  }


                  if(response.data.discount_type == "amount"){
                    discount = response.data.amount;
                    let new_total = parseFloat(discounted_price).toFixed(2);
                 
                  }else{
                    
                    amount = response.data.amount;
                    discount = ((pricevat * amount)/100);

                  }
                  discounted_price = parseFloat(discount).toFixed(2);

                    console.log(pricevat);
                    console.log(discount);
                    let new_total = parseFloat(pricevat - discount).toFixed(2);
                    discount = new_total;
                 

                    $('#checkcoupon_public').val("yes");  

                    $("#grand_total").html(`<label>Total : </label><span>£`+discount+`</span>`);
                    $("#discount").html(`<label>Discount : </label><span>- £`+discounted_price+`</span>`);

                    $("#discount_code_applied").html(html);
                    $("#discount_code_message").html(`<span class="text-success">(Discount code applied.)</span>`);

                    $("#apply_discount_button").prop('disabled',false);
                     
                    // alert("Discount code is valid");
                },
                error:function (error) {
                	$('.price-holder').removeClass("d-none");
                	$(".price_public").show();
                  	$('#u-total').addClass("d-none");
                    $("#apply_discount_button").prop('disabled',false);
                    $("#discount_code_message").html(`<span class="text-danger">(Discount code is not valid.)</span>`);

                    // alert("Discount code is not valid")
                }
            });
        }
          $('#cpn-popup_inhouse').hide();
            $('#apply-cpn-code_inhouse').on('click', function(e) {
              e.preventDefault();
              $('#cpn-popup_inhouse').show();
              $('#discount_code_inhouse').show();
              $('#apply_discount_button_inhouse').show();
              
            });


          function applyDiscountCodeInhouse(type) {
            $('#checkcoupon').val("no");
            $("#apply_discount_button_inhouse").prop('disabled',true);
            let code = $('#discount_code_inhouse').val();
            if(!code){
                $("#discount_code_message_inhouse").html(`<span class="text-danger">(Please add a discount code.)</span>`);
                $("#apply_discount_button_inhouse").prop('disabled',false);
                return;
            }else{
                $("#discount_code_message_inhouse").html('');
            }

            let date_id   = null;
            if(type == "public")
            {
              date_id   = $("#public_date_id").val();
           
            }
              
              let course_id = $("#private-in-house-course").val();
              let vendor = $("#course_vendor").text();
              let price = $("#inhouse_sub_total").text();
              $("#sub_total_inhouse").html(`<label> Sub Total : </label> <span> £`+price+`</span>`);
            $.ajax({
                url: "{{ route('discountCode') }}",
                method: 'POST',
                data:{
                  type: type,
                  course_id: course_id,
                  date_id: date_id,
                  discount_code:code,
                  vendor:vendor,
                  price:price,
                  "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                	
        	$(".price_inhouse").hide();
					$('#discount_code_inhouse').hide();
					$('#apply_discount_button_inhouse').hide();
					$('#u-price').removeClass("d-none");

					$('#checkcoupon').val("yes");
                    
                   let vat = 0;
                    let discount = 0;
                    let discounted_price = 0;
                    let html = ``;
                  if(response.data.discount_type == "amount"){
                    
                    discount = response.data.amount;
                    
                  }else{
                      amount = response.data.amount;
                      discount = ((price * amount)/100);
                  }
                  discounted_price = parseFloat(discount).toFixed(2);
                  
                  let new_total = parseFloat(price - discount).toFixed(2);
                 
                  discount = new_total;
                  
                    $("#grand_total_inhouse").html(`<label> Total : </label> <span>£`+discount+`</span>` );
                    $("#discount_inhouse").html(`<label> Discount : </label><span>- £`+discounted_price+`</span>`);

                    $("#discount_code_applied_inhouse").html(html);
                    $("#discount_code_message_inhouse").html(`<span class="text-success">(Discount code applied.)</span>`);

                    $("#apply_discount_button_inhouse").prop('disabled',false);
                   
                   // alert("Discount code is valid");
                },
                error:function (error) {
                	$(".price_inhouse").show();
                	$('#u-price').addClass("d-none");
                    $("#apply_discount_button_inhouse").prop('disabled',false);
                    $("#discount_code_message_inhouse").html(`<span class="text-danger">(Discount code is not valid.)</span>`);

                    // alert("Discount code is not valid")
                }
            });
        }

  </script>
  <style type="text/css">
    .overlay {
  position: fixed; /* Positioning and size */
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(128,128,128,0.5); /* color */
  display: none; /* making it hidden by default */
}
  </style>      
</body>
</html>
