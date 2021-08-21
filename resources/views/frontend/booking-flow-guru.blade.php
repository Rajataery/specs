@extends('layouts.frontend')
@section('content')
  <div class="section guru-booking-flow">
    <div class="container booking-flow d-none" id="step_1">
      <div class="booking-flow-half">
        <div class="gruru-info-holder">
          <div class="h1 guru-name">Guru Booking flow</div>
          <div>Here&#x27;s the flow for if a user has a Guru&#x27;s personal link.<br><br>1. Select a course Thomas can deliver<br>2. Enter your address (google autofill)</div>
        </div>
      </div>
      <div class="guru-booking-step-1">
        <div class="booking-breadcrumb step-1">
          <div class="guru-form step-1 w-form">
            <div class="h3 orange"></div>
            <div class="big-tick-holder guru-page">
              <div class="big-tick-item"><img src="{{ url('frontend/images/Big-tick2x.png')}}" loading="lazy" width="40" alt="" class="big-tick">
                <div class="big-tick-wording">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl.</div>
              </div>
              <div class="big-tick-item"><img src="{{ url('frontend/images/Big-tick2x.png')}}" loading="lazy" width="40" alt="" class="big-tick">
                <div class="big-tick-wording">Curabitur ultricies ultrices nulla</div>
              </div>
              <div class="big-tick-item"><img src="{{ url('frontend/images/Big-tick2x.png')}}" loading="lazy" width="40" alt="" class="big-tick">
                <div class="big-tick-wording">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl.</div>
              </div>
            </div>
            <form id="wf-form-in-house-course-form" action="#" name="wf-form-in-house-course-form" data-name="in house course form" method="post" class="form step-1">
              @csrf
              <div class="multi-select-row">
                <div class="select-box-holder guru-page">
                  <select id="public_course" name="course" data-name="Select Course 2" required="" class="select-box w-select">
                    <option value="">Select a first aid course</option>
                    @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="select-box-holder guru-page participants">
                  <select id="participants" name="participants" onchange="bookingParticipants(this)" data-name="Participants" required="" class="select-box w-select">
                    <option value="">Participants</option>
                    <option value="1_12">1 - 12</option>
                    <option value="12+">12+</option>
                  </select>
                </div>
              </div>
              <input type="text" class="google-address-search w-input" maxlength="256" value="" name="address" data-name="Google Address Autofill" placeholder="Where would you like your course delivered" id='google_address' required="">
              <input type="hidden" name="lat" id="lat">
              <input type="hidden" name="lang" id="long">

              <input type="submit" value="Find available dates" id="available_date_button" data-wait="Finding Available dates" class="find-course-submit course-page w-button">
              <a id="call_us_button" class="find-course-submit w-button d-none text-center text-white" href="tel:124522">Call Us</a>

            </form>
            <div class="w-form-done">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt="">
            <img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="container booking-flow" id="step_2">
      <div class="booking-flow-half stp-2">
        <div class="gruru-info-holder">
          <div class="h1 guru-name">Step 2</div>
          <div>1. Select 25th December<br>2. Proceed to checkout</div>
        </div>
      </div>
      <div class="guru-booking-step-2">
        <div class="h3 dark booking-flow">Your booking</div>
        <div class="booking-breadcrumb initial-show">
          <div class="h5 breadcrumb">{{ @$selected_course->course_name}}</div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Medicaldoctor-dark2x.png')}}" loading="lazy" width="15" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page">{{ ucfirst(@$guru->name) }}</div>
          </div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page">{{ str_replace('_',' - ', $participants) }} Course Participants</div>
          </div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page">{{ @$address['address'] }}</div>
          </div>
          <div data-w-id="056cde46-4f3a-a9b0-5145-df084fa8980b" class="booking-breadcrumb-info not-selected">
            <img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
            <div data-w-id="056cde46-4f3a-a9b0-5145-df084fa8980d" class="h6 breadcrumb-info not-selected"></div>
            <div data-w-id="5b9831b7-5f30-9fcc-44ba-353ce65221ea" class="h6 timer-info course-page"><a href="#choose-date" class="">Select a date</a></div>
          </div>
        </div>
        <div class="booking-breadcrumb step-2" id="choose-date">
          <div class="h3 dark">Select a course date</div>
          <div class="w-form calendar-selector">
              <div class="calendar-holder">
                <div class="date-holder">
                  <input type="text" name="date" id="course_date" class="d-none" required>
                    <div id="datepicker"></div>
                </div>
              </div>
              <div data-w-id="3d324d2f-3bde-c201-f860-e018f86ce0ad" class="date-selection-mobile">
                <!-- <div class="date-selcted-holder">
                  <div class="date-selection on-mobile">25</div>
                  <div class="date-selection month">dec</div>
                </div>
                <div class="price-holder initial-selection">
                  <div class="h2 total-price">£1300</div>
                  <div class="h6 left">Inc. VAT</div>
                </div> -->
              </div>
              <input type="hidden" name="course_days" value="{{ $selected_course->course_time}}" id="course_days">
              <input type="hidden" name="guru_day_price" value="{{ $guru->rate}}" id="guru_day_price">
              @if ($errors->any())
                <div class="mt-2 alert alert-danger alert-dismissible custom-message">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                </div>
              @endif

              @if(Session::has('error_message'))
                  <div class="mt-2 alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      {{ Session::get('error_message') }}
                  </div>
              @endif
              <p class="text-danger text-center" id="date_required"></p>
              <input type="button" id="selected_date_button" onClick="GetCourseDate()" value="Secure Checkout" data-wait="Loading form" class="find-course-submit course-page w-button">
            <!-- </form> -->
            <div class="w-form-done">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt="" class="image-5">
            <img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt="" class="image-6">
          </div>
        </div>
      </div>
    </div>
    <div class="container booking-flow d-none" id="step_3">
      <div class="booking-flow-half step-3">
        <div class="gruru-info-holder">
          <div class="h1 guru-name">Step 3</div>
          <div>1. Complete the details<br>2. Check out<br>3. Takes you to the thank you page</div>
        </div>
      </div>
      <div class="guru-booking-step-2">
        <div class="h3 dark">Your booking</div>
        <div class="booking-breadcrumb initial-show">
          <div class="h5 breadcrumb">{{ @$selected_course->course_name}}</div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Medicaldoctor-dark2x.png')}}" loading="lazy" width="15" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page">{{ ucfirst($guru->name)}}</div>
          </div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page">{{ str_replace('_',' - ', $participants) }} Course Participants</div>
          </div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page">{{ $address['address'] }}</div>
          </div>
          <div class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
            <div data-w-id="87e98ebd-ba1e-f828-9e8d-e838406fe07c" class="h6 breadcrumb-info not-selected" id="selected_date_show"></div>
            <div class="h6 timer-info course-page"> </div>
          </div>
        </div>
        <div class="booking-breadcrumb step-2">
          <div class="h3 dark checkout">Secure checkout</div>
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/stripe2.svg')}}" loading="lazy" alt=""></div>
          <div class="checkout-form-block w-form">
            <form id="checkout_form" method="post" action="{{route('bookingGuru.checkout')}}" name="email-form" data-name="Email Form" class="secure-checkout require-validation"  data-cc-on-file="false" data-stripe-publishable-key="{{ config('services')['stripe']['key'] }}" id="payment-form">
              @csrf 
              <input type="text" class="name w-input" maxlength="256" name="name" data-name="Name" placeholder="Your name" id="Name" required="">

              <input type="text" class="name business w-input" maxlength="256" name="businessName" data-name="Business name" placeholder="Business name" id="Business-name" required="">

              <input type="email" class="email-address w-input" maxlength="256" name="email" data-name="Email address" placeholder="Your email address" id="Email-address" required="">

              <input type="text" class="name business w-input" maxlength="256" name="phone" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" data-name="phone" placeholder="Phone No" required="">
              <input type="hidden" name="course_id" value="{{$selected_course->id}}">
              <input type="hidden" name="guru_id" value="{{$guru->id}}">
              <input type="hidden" name="address" value="{{$address['address']}}">
              <input type="hidden" name="lat" value="{{$address['lat']}}">
              <input type="hidden" name="lang" value="{{$address['lang']}}">
              <input type="hidden" id="selected_course_date" name="date" value="">
              <input type="hidden" name="participants" value="{{$participants}}">
              <label class="w-checkbox terms-and-conditions">
                <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox">
                </div>
                <input type="checkbox" id="Terms and conditions" name="Terms-and-conditions" data-name="Terms and conditions" required="" style="opacity:0;position:absolute;z-index:-1">
                  <span for="Terms and conditions" class="checkbox-label w-form-label">I agree with the terms and conditions</span>
              </label>
              <div class="secure-checkout-holder-copy">

                <input type="text" class="payment-info w-input" maxlength="256" name="card_name" data-name="Card Name" placeholder="Name" id="Card-address" required="">

                <input type="text" class="payment-info card-number w-input" maxlength="256" name="card_number" data-name="Card number" placeholder="0000 / 0000 / 0000 / 0000" id="Card-number" required="">

                <div class="cvv-and-exp-holder">

                 <div class='col-xs-12 col-md-4 form-group expiration required'>
                    <input class='form-control card-expiry-month' required placeholder='MM' size='2' type='text' name="expire_month">
                  </div>
                  <div class='col-xs-12 col-md-4 form-group expiration required'>
                       <input class='form-control card-expiry-year' required placeholder='YYYY' size='4' type='text' name="expire_year">
                  </div>
                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                       <input autocomplete='off' class='form-control card-cvc payment-info card-number card-cvc cvv w-input' placeholder='ex. 311' size='4' type='text' name="cvv" data-name="CVV" id="CVV-2" required="">
                  </div>
                  <div class="powered-by-holder">
                    <img src="{{ url('frontend/images/stripe1.svg')}}" loading="lazy" height="25" alt="" class="image-7"></div>
                </div>
                  <div class='col-xs-12 error form-group d-none'>
                      <div class='alert-danger alert'> </div>
                  </div>

              </div>
              <div class="price-holder">
                <div class="h2 total-price" id="selected_course_price"></div>
                <div class="h6">Inc. VAT</div>
              </div>
              <div class="secure-button"><input type="submit" value="Checkout" data-wait="Loading checkout" class="guru-flow secure-checkout-button w-button"><img src="{{ url('frontend/images/Lock2x.png')}}" loading="lazy" width="16" alt="" class="image-4"></div>
            </form>
            <div class="w-form-done">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt="">
            <img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  
    let placeSearch, autocomplete;
    function initAutocomplete() {

      autocomplete = new google.maps.places.Autocomplete(

       document.getElementById('google_address'),
       {
        // types: ['geocode'],
        // types: ['(cities)'],
          componentRestrictions: {country: "uk"}
       }
      );

       autocomplete.addListener("place_changed", () => {

       const place = autocomplete.getPlace();

       var lat = place.geometry.location.lat();
       var lng = place.geometry.location.lng();

       document.getElementById("lat").value = lat;
       document.getElementById("long").value = lng;

      });
    }

    function fillInAddress() {
     autocomplete.setFields(['geometry']);
     var location = autocomplete.getPlace().geometry.location;

    }

    var input = document.getElementById("google_address");
    input.addEventListener("keyup", function(event) {

      if (event.keyCode === 13) {
        event.preventDefault();
          let address = event.target.value;
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode( { 'address': address}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
              document.getElementById('lat').value  = results[0].geometry.location.lat();
              document.getElementById('long').value  =  results[0].geometry.location.lng();
            }
          });
        }
    });

    function bookingParticipants(data){
      $("#available_date_button").attr('disabled', true);
      let selected = $('#participants').children("option:selected").val();
      if(selected == "12+"){
        $("#call_us_button").removeClass('d-none');
        $("#available_date_button").addClass('d-none');
        $("#call_us_button").attr('disabled', false);
      }else{
        $("#call_us_button").addClass('d-none');
        $("#available_date_button").removeClass('d-none');
        $("#available_date_button").attr('disabled', false);
        $("#call_us_button").attr('disabled', true);
      }
    }
    
    function GetCourseDate()
    {
      var date = $("#course_date").val();

      if(!date){
        $("#date_required").html("Please select a date");
        return false;
      }else{
        let course_days = $("#course_days").val();
        let guru_day_price = $("#guru_day_price").val();
        let total_price = course_days * guru_day_price;
        $("#selected_course_price").html(`£`+total_price);
        $("#date_required").html("");
        $("#selected_course_date").val(date);
        $("#selected_date_show").html(convert_date(date));
        $("#step_2").addClass('d-none');
        $("#step_3").removeClass('d-none');
      }
    }

    var booked_dates = '{{ $bookings }}';
    var dates = booked_dates.split(',');

    function DisableDates(date) {
      var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

      if(dates.indexOf(string) == -1){
        return [dates.indexOf(string) == -1,' ' ];
      }else{
        return [false, 'guru-booked-date' ];
      }

      
    }
       
    $( function() {
      $('#datepicker').datepicker({
        minDate: new Date(),
        dateFormat: 'yy-mm-dd',
        inline: true,
        altField: '#course_date',
        beforeShowDay: DisableDates
      });

      $('#course_date').change(function(){
        $('#datepicker').datepicker('setDate', $(this).val());
      });

    });

    function convert_date(date) {
      var d = new Date( date );
      year  = d.getFullYear();
      month = d.toLocaleString('default', { month: 'long' });
      day   = d.getDate();
      return day+"th "+month+" "+year;
    }

  </script>

@endsection