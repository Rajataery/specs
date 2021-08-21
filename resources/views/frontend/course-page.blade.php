@extends('layouts.frontend')
@section('content')
<div class="coursePage">
  <div class="section hero-section-course-page">
    <div class="container hero-container-course-page">
      <div class="hero-left course-page">
        <div class="course-length-holder course-page">
          <div class="body-text white course-length">{{$data->course_time}} day course</div>
        </div>
        <div class="h1 course-title">{{$data->course_name}}</div>

        <div class="body-text course-hero top">{{$data->short_discription}}</div>
      </div>
      <div class="course-hero-right">
        <!-- <div class="course-booker" style="background-image: url({{asset('/frontend/images/'.$data['course_image'])}});"  ></div> -->
        <div class="course-form">
        <div class="course-right-image corporate" id="corporate">
          <div class="form-block course-page w-form">
            <div class="h3 dark course-page-booking-step1" id="course_text">Find an available course in your location</div>
            <div class="select-box-holder course-page-booking-step1" id="course" >
              <select id="selected_booking_type" name="course_type"  data-name="Course" onchange="changeBookingType(this)" required="" class="select-box w-select">
                <option value="public" selected>Public course (for individuals and small groups)</option>
                <option value="private">Private in house course</option>
              </select>
            </div>

            <!-- Public Booking-->
            <div class=" public_booking_steps" id="public_booking_steps">
              <div class="form-block w-form" id="public_step1">
                <form id="public_booking_search" name="" data-name="in house course form" class="form">
                  @csrf
                  <div class="select-box-holder d-none">
                    <select id="public_course" name="course" data-name="Select course" required="" class="select-box w-select">
                       <option value="{{ $data->id }}">{{$data->course_name}}</option>
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
                    @endif
                    @if(Session::has('inhouse_error'))
                      <div class="mt-2 alert alert-danger alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          {{ Session::get('inhouse_error') }}
                      </div>
                    @endif
                    @if ($errors->any())
                      <div class="mt-2 alert alert-danger alert-dismissible custom-message">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          @foreach ($errors->all() as $error)
                          {{ $error }}<br>
                          @endforeach
                      </div>
                    @endif

                  <input type="submit" value="Find" data-wait="Searching Course..." class="find-course-submit course-page w-button">
                </form>
              </div>
               <div class="modal" id="modal_loadmore" > <img data-src="http://itsolutionstuff.com/upload/PHP-Angular-JS.png" src="{{ url('frontend/images/Eclipse-1s-147px.gif')}}" class="img-1"> </div>
              <div class="booking-breadcrumb d-none" id="public_step2">
              <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>
                    <input type="button"  value="Back" data-wait=""   onclick="publicStepOne()" >
                  </a>
                <div class="h3 dark">Select a location</div>
                <div class="form-block-3 w-form">

                  <form id="select_location_form" class="form course-page">
                    <div class="location-cards-holder">
                    </div>
                    <div id="load_more">
                     <input type="hidden" name="number_val" id="number" value="1" />
                     <!-- <button class="loadMore"  type="button" onclick="search_courses()" value ="2" id="load_more" name="loadmore">Load More <span>&#187;</span></button> -->
                </div>
                

                <div class="calendar-holder">
                    <div class="date-holder">
                      <div id="seatdata"></div>
                      <div id="error" class="text-center text-danger">  </div>
                      <div class="h3 dark calendar-title d-none" id="calendar-title">Please choose your start date</div>
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
                      <!-- <label for="public_participants m-0">Select no. of seats </label> -->
                      <div class="h3 dark persons-title" id="persons-title">How many participants?</div>
                      <div class="row select_seat">
                        <button class="col-1 btn dec" type="button" onclick="decreasePublicParticipants()" name="public_participants"> - </button>

                        <input class="col-2 form-control" value="1" required="" readonly="" id="public_participants" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="public_participants">
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
                   <input type="submit" value="Book Now" data-wait="Loading form" class="find-course-submit course-page w-button d-none bookEvent" id="find-course-submit">
                  </form>
                </div>
              </div>
              <div class="booking-breadcrumb d-none" id="public_step3">
              <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>
                <input type="button"  value="Back" data-wait=""  onclick="publicSteptwo()" >
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
                    <div class="modal overlay" id="modal" > <img data-src="http://itsolutionstuff.com/upload/PHP-Angular-JS.png" src="{{ url('frontend/images/Rolling.gif')}}" class="img-1"> </div>
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
                    <input  name="date" id="public_course_date" type="hidden">

                    <input type="hidden" id="public_date" name="date">
                    
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
                            <input type="text" name="coupon" placeholder="Discount Coupon" id="discount_code" class="w-input coupon">
                            <div id="discount_code_action">
                              <input type="button" name="Apply" value="Apply" id="apply_discount_button"
                                onclick="applyDiscountCode('public')" class="w-button">
                                </div>
                            </div>
                            
                            <input type="hidden" class="name" id="code" value="" name="code">
                            <p id="discount_code_applied"></p>
                            <input type="hidden" name="check_coupon" value="no" id="checkcoupon_public">                        
                            </div>
                          <div class="d-none" id="u-price">
                            <p class="u-price"><span class="value" id="sub_total"><span></p>
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
                      <div class="price-holder price_holder_public">
                        <div class="h2 total-price public_course_price price_coupon"></div>
                        <div class="h6">Inc. VAT</div>
                      </div>
                      <div class="secure-button"><input type="submit" value="Checkout" data-wait="Loading checkout"
                          class="guru-flow secure-checkout-button w-button"><img src="{{ url('frontend/images/Lock2x.png')}}"
                          loading="lazy" width="16" alt="" class="image-4"></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Public Booking End -->

            <!-- Inhouse Booking-->
            <div class="inhouse_booking_steps d-none" id="inhouse_booking_steps">
              <form id="inhouse_checkout_form" action="{{ route('bookInhouseCourse') }}" name="wf-form-in-house-course-form" data-name="in house course form" method="post" class="stripe-require-validation">
              @csrf
              <div id="inhouse_step1" class="">
                <div class="select-box-holder d-none">
                  <select id="private-in-house-course" name="course" data-name="Select course" required="" class="select-box w-select">
                    <option value="{{ $data->id }}">{{$data->course_name}}</option>
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
                <div id="inhouse_form_buttons">
                  <input type="button" id="inhouse_submit" onClick="showAddressField()" value="Book Course" data-wait="Booking course..." class="find-course-submit w-button">
                </div>
                <a id="inhouse_call_us" class="find-course-submit w-button d-none text-center text-white" href="tel:124522">Call Us</a>
              </div>
              <div id="inhouse_step2" class="d-none">
                <div class="booking-breadcrumb" id="choose-date" >
                  <div class="h3 dark">Select a course date</div>

                   <div class="w-form">
                   <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>
                  <input type="button"  value="Back" data-wait="" onclick="inhouseStepone()" >
                </a>
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
                <div class="booking-breadcrumb">
                <div class="flex_head">
                  <div class="h3 dark checkout">Secure checkout</div>
                  <div class="trust-holders-booking"><img src="{{ url('frontend/images/stripe2.svg')}}" loading="lazy" alt=""></div>
                </div>

                  <div class="modal overlay" id="modal_inhouse" style="margin-left: 45%;"> <img data-src="http://itsolutionstuff.com/upload/PHP-Angular-JS.png" src="{{ url('frontend/images/Rolling.gif')}}" class="img-1"> </div>

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
                    <div id="u-price_inhouse" class="d-none">
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
                    <div class="price-holder price_holder_inhouse">
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
                </div>
              </div>
              </div>
            </div>
            <!-- Inhouse Booking End-->
          </div>  
          <!-- <div class="trust-holders-booking"><img src="{{url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div> -->
          <div class="course-icon-holder">
          <div class="trustpilot-holder"><img src="{{url('frontend/images/trsutpilot.svg')}}" loading="lazy" alt=""></div>
          </div>
        </div>
        </div> 
        </div>
      </div>
    </div>
  </div>
  <div class="section orange-section-course-page">
    <div class="container benefits-holder-course-page">
      <div class="benefits-holder-orange course-page">
        <div class="benefits-holder course-page">
          <div class="benefit course-page"><img src="{{url('frontend/images/Star2x.png')}}" loading="lazy" height="40" alt="" class="top-icons course-page">
            <div class="h3 course-page">Here’s our first value proposition</div>
          </div>
          <div class="benefit course-page"><img src="{{url('frontend/images/Medical2x.png')}}" loading="lazy" height="40" alt="" class="top-icons course-page">
            <div class="h3 course-page">Here’s something else that’s really great</div>
          </div>
          <div class="benefit course-page"><img src="{{url('frontend/images/Date-check2x.png')}}" loading="lazy" height="40" alt="" class="top-icons course-page">
            <div class="h3 course-page">We’re different because we do things differently</div>
          </div>
        </div>
      </div>
      <div class="space-holder"></div>
    </div>
  </div>
  <div class="section about-course">
    <div class="container about-course">
      <div class="about-the-course-holder">
        <div class="h1 about-course">{{ $data->course_title }}</div>
        <div class="body-text course-hero">{{$data->course_discription}}</div>
        <div class="button-holder course-page">
          <a href="#corporate" class="large-button course-page w-button">Book your course</a>
          <a href="{{asset('storage/files/' . $data->course_file)}}" class="large-button course-page download w-button" target="blank">Download the factsheet</a>
        </div>
       
      </div>
      <div class="about-image-holder"></div>
    </div>
    <div class="container organisation-section">
      <div class="individual-info-holder">
      {!! $data->about_individuals_description !!}
      </div>
      <div class="individual-info-holder">
       {!! $data->about_organisations_description !!}
      </div>
    </div>
  </div>
  <div class="section white-section-course-page">
    <div class="container overlap-container-course-page">
      <div class="good-company-holder course-page">
        <div class="good-company-title">
          <div class="h2 heavy-centered">You’re In good company</div>
          <div class="h4 centered good-company">We’ve helped over 30,000 people get training</div>
        </div>
        <div class="good-company-logo"><img src="{{url('frontend/images/Underground.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{url('frontend/images/G4S.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{url('frontend/images/NHS-Logo.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{url('frontend/images/Mitie.svg')}}" loading="lazy" alt="" class="trust-logo"></div>
      </div>
    </div>
  </div>
  <div class="section course-finder" id="quiz">
    <div class="container course-finder-container w-container">
        <div class="course-finder-title-holder">
            <div class="h1 course-finder-header">Not sure which course you need?</div>
            <div class="body-text private-courses heading">Answer a few simple questions in our short course finder quiz and quickly find the first aid course you need.</div>
        </div>
        <div class="course-finder-quiz-holder-copy  quizContent">
            <div id="container" class="course-quiz-box" data-w-id="e7be8015-82c4-e840-3890-db10c901b920">
                <div class="h2 heavy-centered course-finder-text">Course finder quiz</div>
                <div class="body-text course-finder-text">Use our course quiz to help you decide which course is
                    suitable for you.</div>
                <a data-w-id="6d2f0887-f7bd-1467-228b-05be6818c90e" href="#" class="large-button start-quiz w-button"
                    id="start">Start quiz</a>
                <div class="course-info"><img src="{{url('frontend/images/clock2x.png')}}" loading="lazy" width="20"
                        alt="" class="image-3">
                    <div class="h6 timer-info">Less than 5 minutes</div>
                </div>
            </div>

            <div id="responsible" data-w-id="b70affba-213f-cc56-1ecd-65b3811f7f28" style="display:none;opacity:1"
                class="course-quiz-box step-2">
                <div class="h2 heavy-centered course-finder-text">Your responsibilities</div>
                <div class="form-block w-form">
                    <form id="" name="" data-name="in house course form" method="post" class="form">
                        <p>What Course You I Need? Use our questionnaire below to help you decide which course Is
                            suitable for you.
                          </p>
                        <div class="select-box-holder" id="one">
                            <label class="quizInput-box"> Are you responsible for mainly the care for Infants or
                                children i.e. nursery, school or work as a babysitter
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
                                    <label class="quizInput-box"> Do you work in a low risk environment ie office.
                                        Retails store (Not involving handling dangerous or sharp objects).
                                        <input type="checkbox" class="form-check-input" id="quiz7" name="three">
                                        <span class="checkmark"></span>
                                    </label>

                                    <label class="quizInput-box"> Do you work in an high risk environment i.e building
                                        site, kitchen or Retails store ( handling Dangerous, sharp objects or heavy
                                        loads).
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
                            </div>

                            <div class="secondstep_right2 select-box-holder" id="secondstep_right">
                                <p class="quizCheckbox"><a href="/course_detail/7" target="_blank">First aid at work For
                                        managers, supervisor or anyone working in high
                                        risk environments</a>
                                    </p>
                            </div>
                        </div>                

                <div class="">
                    <div class="end_right">
                        <div class="last_step_right1 select-box-holder" id="last_step_right1">
                             <p class="quizCheckbox"><a href="/course_detail/7" target="_blank">First aid at Work For or
                                    supervisors and managers</a>
                             </p>
                      </div>

                        <div class="last_step_right2 select-box-holder" id="last_step_right2">
                            <p class="quizCheckbox"><a href="/course_detail/6" target="_blank">Emergency First aid at
                                    Work For Employees working in a low risk
                                    environment ie office. Retails store (Not involving handling dangerous or sharp
                                    objects)</a>
                                </p>
                        </div>
                    </div>
                </div>

                <div style="">
                    <div class="third_step_val" id="third_step_val">

                        <div class="secondstep1" id="secondstep1">
                            <div class="select-box-holder" id="secondstep1">
                                <p class="quizCheckbox"><a href="/course_detail/8" target="_blank">Paediatric first Aid
                                        (6hr) course “ au-pairs babysitters. However this course is not OFSTED APPROVED.
                                        For OFSTED APPROVED course opt for Paediatrics First Aid (OFSTED Approved)</a>
                                </p>
                            </div>
                        </div>


                        <div class="secondstep2 select-box-holder" id="secondstep2">


                            <b>Are you a supervisor or manager </b>

                            <label class="quizInput-box"> Yes
                                <input type="checkbox" class="form-check-input" id="quiz5" name="five">
                                <span class="checkmark"></span>
                            </label>

                            <label class="quizInput-box"> No
                                <input type="checkbox" class="form-check-input" id="quiz6" name="six">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="left_last" id="left_last">
                        <div class="secondstep_right1 select-box-holder" id="secondstep_right1">
                            <p class="quizCheckbox"><a href="/course_detail/7" target="_blank">First aid at work
                                    supervisors and managers. As the field
                                    you are in involved mainly infants and children Paediatric first aid ( OFSTED
                                    APPROVED) Is recommended as it specialises for this age group </a></p>
                        </div>

                        <div class="secondstep_right2 select-box-holder" id="secondstep_right2">
                            <p class="quizCheckbox"><a href="/course_detail/8" target="_blank">Paediatric First Aid
                                    (OFSTED APPROVED) is suitable for you nursery or
                                    school etc.</a></p>
                        </div>
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


  <div class="section-2 s2-content"></div>
  <div class="section trustpilot-review-section t-pilot"><img src="{{url('frontend/images/trustpilot_circle.svg')}}" loading="lazy" alt="" class="trustpilot-logo">
    <!--div class="container trustpilot-review-container">
      <div class="insert-review-widget">
        <div class="white-text">Review widget</div>
      </div>
    </div>
    <a href="#" class="large-button white-button w-button">See more</a-->
  </div>
  <!--div class="section brand-promise">
    <div class="container brand-promise course-page">
      <div class="brand-promise-holder">
        <div class="hero-logo-holder brand-promise"><img src="{{url('frontend/images/First-aid-Guru-dark-logo.svg')}}" loading="lazy" alt="" class="image hero-logo brand-promise"></div>
        <div class="h1">The brand promise we make to you</div>
        <div class="body-text brand-promise">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.  Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.</div>
      </div>
      <div class="brand-promise-images"><img src="{{url('frontend/images/hero-top-image2x.jpg')}}" loading="lazy" width="628" sizes="(max-width: 479px) 100vw, (max-width: 767px) 61vw, (max-width: 991px) 31vw, 41vw" srcset="{{url('frontend/images/hero-top-image2x-p-1080.jpeg')}} 1080w, {{url('frontend/images/hero-top-image2x.jpg')}} 1256w" alt="" class="image brand-promise"><img src="{{url('frontend/images/hero_lower_image2x.jpg')}}" loading="lazy" width="434" sizes="(max-width: 479px) 100vw, (max-width: 767px) 67vw, (max-width: 991px) 37vw, 434px" srcset="{{url('frontend/images/hero_lower_image2x-p-800.jpeg')}} 800w, {{url('frontend/images/hero_lower_image2x.jpg')}} 868w" alt="" class="image brand-promise-upper"><img src="{{url('frontend/images/trustpilot_circle.svg')}}" loading="lazy" alt="" class="trustpilot-logo brand-promise">
        <div class="hero-image-holder lower-image"></div>
      </div>
    </div>
  </div-->
  <section class="section contact" >
    <div  class="container contact">
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
        </div>
      </div>
    </div>
  </section>
</div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://use.typekit.net/kde5sqc.js" type="text/javascript"></script>
<script src="{{ url('frontend/js/booking.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>

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

  function changeBookingType(data) {

    let booking_type = $('#selected_booking_type').children("option:selected").val();

    if(booking_type == "public"){
      $("#public_booking_steps").removeClass("d-none");
      $("#inhouse_booking_steps").addClass("d-none");
    } else{
      $("#public_booking_steps").addClass("d-none");
      $("#inhouse_booking_steps").removeClass("d-none");
     // $(".select-box-holder").removeClass("d-none");
    }
  }
$(document).ready(function(){
      $("#public_checkout_form").on("submit", function(){
      loader();
      });//submit
    });



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

$('#start').click(function() {
   
      $("#container").hide();
      
      $("#responsible").show();
 
  
});

$('#quiz1').click(function() {

   if($(this).is(":checked")){
      $("#left_2").show();
      $("#one").hide();
      $("#right").hide();

   }
  
});

$('#quiz2').click(function() {

   if($(this).is(":checked")){
      $("#right_2").show();
      $("#one").hide();
     

   }
  
});

$('#quiz3').click(function() {
   
   if($(this).is(":checked")){
   
      $("#left_2").hide();
      
       $("#secondstep1").show();
      $("#right").hide();
      $("#secondstep2").hide();
   }
  
});

$('#quiz4').click(function() {
   
   if($(this).is(":checked")){
   
      $("#left_2").hide();
      
       $("#secondstep2").show();
      
   }
  
});

$('#quiz5').click(function() {
   
   if($(this).is(":checked")){
   
      $("#secondstep2").hide();
      
       $("#secondstep_right1").show();
      
   }
  
});
$('#quiz6').click(function() {
   
   if($(this).is(":checked")){
   
      $("#secondstep2").hide();
      
       $("#secondstep_right2").show();
      
   }
  
});

$('#quiz7').click(function() {
   
   if($(this).is(":checked")){
   
      $("#right_2").hide();
      
       $("#right1").show();
      
   }
  
});
$('#quiz8').click(function() {
   
   if($(this).is(":checked")){
   
      $("#right_2").hide();
      
       $("#secondstep_right").show();
      
   }
  
});
$('#quiz9').click(function() {
   
   if($(this).is(":checked")){
   
      $("#right1").hide();
      
       $("#last_step_right1").show();
      
   }
  
});
$('#quiz10').click(function() {
   
   if($(this).is(":checked")){
   
      $("#right1").hide();
      
       $("#last_step_right2").show();
      
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
              //console.log('test');
              date_id   = $("#public_date_id").val();
              console.log(date_id);
            }
              let course_id = $("#public_course").val();
              //let vendor = $("#course_vendor").text();
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
                  "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
console.log("price",price);
                  $('#discount_code').hide();
                  $('#apply_discount_button').hide();
                  $('#u-price').removeClass("d-none");
                  $('.price_holder_public').hide();
//console.log('price',price);
                  let vat = 0;
                  let discount = 0;
                  let discounted_price = 0;
                  let html = ``;
                  if(response.data.discount_type == "amount"){
                  discount = response.data.amount;
                 
                  let new_total = parseFloat(discounted_price).toFixed(2);
                 
                  }else{

                    amount = response.data.amount;
                    discount = ((price * amount)/100);

                  }
                    discounted_price = parseFloat(discount).toFixed(2);

                    let new_total = parseFloat(price - discount).toFixed(2);
                    discount = new_total;
                    console.log(discount);

                    $('#checkcoupon_public').val("yes");  

                    $("#grand_total").html(`<label>Total : </label><span>£`+discount+`</span>`);
                    $("#discount").html(`<label>Discount : </label><span>- £`+discounted_price+`</span>`);

                    $("#discount_code_applied").html(html);
                    $("#discount_code_message").html(`<span class="text-success">(Discount code applied.)</span>`);

                    $("#apply_discount_button").prop('disabled',false);
                     
                    // alert("Discount code is valid");
                },
                error:function (error) {

                    $('.price_holder_public').show();
                    $('#u-price').addClass("d-none");
                    $("#apply_discount_button").prop('disabled',false);
                    $("#discount_code_message").html(`<span class="text-danger">(Discount code is not valid.)</span>`);
                    $('.price_coupon').show();
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
              //console.log('test');
              date_id   = $("#public_date_id").val();
              console.log(date_id);
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
console.log("price",price);
                  $('#discount_code_inhouse').hide();
                  $('#apply_discount_button_inhouse').hide();
                  $('#u-price_inhouse').removeClass("d-none");
                  $('.price_holder_inhouse').hide();
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
                  console.log(discount);
                   $("#grand_total_inhouse").html(`<label> Total : </label> <span>£`+discount+`</span>` );
                    $("#discount_inhouse").html(`<label> Discount : </label><span>- £`+discounted_price+`</span>`);

                    $("#discount_code_applied_inhouse").html(html);
                    $("#discount_code_message_inhouse").html(`<span class="text-success">(Discount code applied.)</span>`);

                    $("#apply_discount_button_inhouse").prop('disabled',false);
                   
                   // alert("Discount code is valid");
                },
                error:function (error) {
                  $('.price_holder_inhouse').show();
                  $('#u-price_inhouse').addClass("d-none");
                    $("#apply_discount_button_inhouse").prop('disabled',false);
                    $("#discount_code_message_inhouse").html(`<span class="text-danger">(Discount code is not valid.)</span>`);

                    // alert("Discount code is not valid")
                }
            });
        }



  </script>




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
@endsection 