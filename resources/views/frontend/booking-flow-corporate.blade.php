@extends('layouts/frontend')
@section('content')

  <div class="section guru-booking-flow">
    <div class="container booking-flow @if(isset($course_type)) d-none @endif" id="step1">
      <div class="booking-flow-half">
        <div class="gruru-info-holder">
          <div class="h1 guru-name">In house Booking flow</div>
          <div>Here&#x27;s the flow for if a user selects private in house course.<br><br>1. Select number of participants<br>2. Enter your address (google autofill)</div>
        </div>
      </div>
      <div class="booking-flow-corporate-start">
        <div class="course-booker" style="background-image: url({{asset('/frontend/images/medical_image2x.jpg')}})"></div>
        <div class="course-right-image corporate">
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

          <div class="form-block course-page w-form">
            <div class="h3 dark">Find an available course in your location</div>
           
            <form id="checkout_form" action="{{ route('bookInhouseCourse') }}" name="wf-form-in-house-course-form" data-name="in house course form" method="post" data-stripe-publishable-key="{{ config('services')['stripe']['key'] }}" class="form course-page require-validation">
              @csrf
              <div class="select-box-holder">
                <select id="private-in-house-course" name="course" data-name="Private in-house course" required="" class="select-box w-select">
                  @foreach ($courses as $course)
                   <option value="{{ $course->id }}" {{ $course->id==@$course_id ? 'Selected' : ''}} >{{ $course->course_name }}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="select-box-holder corporate-selection">
                <select id="participants" onchange="bookingParticipants(this)" name="participants" data-name="Participants" required="" class="select-box w-select">
                    <option value="">Participants</option>
                    <option {{ @$participants == "1_12" ? 'Selected' : ''}} value="1_12">1 - 12</option>
                    <option {{ @$participants == "12_24" ? 'Selected' : ''}} value="12_24">12 - 24</option>
                    <option {{ @$participants == "24_36" ? 'Selected' : ''}} value="24_36">24 - 36</option>
                    <option value="36+">36+</option>
                  </select>
              </div>
              <input type="hidden" name="lat" value="{{@$lat}}" id="lat">
              <input type="hidden" name="lang" value="{{@$lang}}" id="long">
              <input type="text" id='google_address' class="google-address-search w-input" maxlength="256" value="{{@$address}}" name="address"  placeholder="First line of your address or postcode" required>
              <span class="text-danger" id="fields_required"></span>

              <span data-wait="Booking Course..." id="inhouse_submit" class="find-course-submit course-page w-button" onClick="GetCourseDate()"> Book your Course </span> 
              <a id="inhouse_call_us" class="find-course-submit w-button d-none text-center text-white" href="tel:124522">Call Us</a>
          </div>
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div>
        </div>
      </div>
    </div>
      <div class="collapse @if(isset($course_type)) show @else d-none @endif" id="step2">
        <div class="container booking-flow corporate">
          <div class="booking-flow-half  stp-2">
            <div class="gruru-info-holder">
              <div class="h1 guru-name">Step 2</div>
              <div>1. Select Date<br>2. Proceed to checkout</div>
            </div>
          </div>
          <div class="guru-booking-step-2">
            <div class="h3 dark booking-flow" >Your booking</div>
            <div class="booking-breadcrumb initial-show corporate">
              <div class="h5 breadcrumb booking_course" id="course">@if(isset($course_name)) {{ @$course_name }} @endif </div>
              <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
                <div class="h6 timer-info course-page">
                <span class="booking_participants"> @if(isset($participants)) {{ str_replace('_',' - ', @$participants) }} @endif </span>  Course Participants
                </div>
              </div>
              <div class=" booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                <div class="h6 timer-info booking_address course-page" > @if(isset($address)) {{ @$address }} @endif </div>
              </div>
              <div data-w-id="056cde46-4f3a-a9b0-5145-df084fa8980b" class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                <div data-w-id="056cde46-4f3a-a9b0-5145-df084fa8980d" class="h6 breadcrumb-info not-selected"><a href="#choose-date">Select a date</a></div>
                <!--<div data-w-id="5b9831b7-5f30-9fcc-44ba-353ce65221ea"  id="course" class="h6 timer-info course-page">25th December | 9am - 5pm</div>-->
              </div>
            </div>
            <div class="booking-breadcrumb step-2" id="choose-date">
              <div class="h3 dark">Select a course date</div>
               <div class="w-form">
                  <!-- <div class="calendar-holder">
                    <div class="month-mover-holder">
                      <div class="month"></div>
                      <div class="arrow-holders">
                        <img src="{{ url('frontend/images/Arrow-right.svg')}}" loading="lazy" alt="" class="arrow-left"><img src="{{ url('frontend/images/Arrow-left.svg')}}" loading="lazy" alt="" class="arrow-left">
                      </div>
                    </div> -->

                    <input type="text" name="date" id="course_date" class="d-none" required>
                    <div id="datepicker"></div>

                  </div>
                  <div data-w-id="3d324d2f-3bde-c201-f860-e018f86ce0ad" class="date-selection-mobile">
                    <div class="date-selcted-holder">
                      <div class="date-selection on-mobile"></div>
                      <div class="date-selection month"></div>
                    </div>
                    <div class="price-holder initial-selection">
                      <!-- <div class="h2 total-price">£1300</div>
                      <div class="h6 left">Inc. VAT</div> -->
                    </div>
                  </div>
                  <p class="text-danger text-center" id="date_required"></p>
                <!-- <a href="#step3">  <p data-toggle="collapse" href="#step3"> -->
                  <span  data-wait="Loading form" class="find-course-submit course-page w-button" onClick="selectDate()">Secure Checkout</span> 
                <!-- </p></a> -->
                <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt="" class="image-5"><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt="" class="image-6"></div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="collapse d-none" id="step3">
        <div class="container booking-flow">
          <div class="booking-flow-half step-3">
            <div class="gruru-info-holder">
              <div class="h1 guru-name">Step 3</div>
              <div>1. Complete the details<br>2. Check out<br>3. Takes you to the thank you page</div>
            </div>
          </div>
          <div class="guru-booking-step-2">
            <div class="h3 dark">Your booking</div>
            <div class="booking-breadcrumb initial-show">
              <div class="booking_course h5 breadcrumb" >@if(isset($course_name)) {{ @$course_name }} @endif</div>
              <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
                <div id="part1" class="h6 timer-info course-page" >
                 <span class="booking_participants"> @if(isset($participants)) {{ str_replace('_',' - ', @$participants) }} @endif</span>  Course Participants
                </div>
              </div>
              <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                <div id="address1" class="booking_address h6 timer-info course-page" > @if(isset($address)) {{ @$address }} @endif</div>
              </div>
              <div class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
                <div class="h6 timer-info course-page" id="selected_date"></div>
              </div>
            </div>
           
            <div class="booking-breadcrumb step-2">
              <div class="h3 dark checkout">Secure checkout</div>
              <div class="trust-holders-booking"><img src="{{ url('frontend/images/stripe2.svg')}}" loading="lazy" alt=""></div>
              <div class="checkout-form-block w-form secure-checkout">
                
                <input type="text" class="name w-input" maxlength="256" name="name" data-name="Name" placeholder="Your name" id="Name" required="">
                <input type="text" class="name business w-input" maxlength="256" name="businessName" data-name="Business name" placeholder="Business name" id="Business-name" required="">
                <input type="email" class="email-address w-input" maxlength="256" name="email" data-name="Email address" placeholder="Your email address" id="Email-address" required="">
                <input type="text" class="name phone w-input" maxlength="256" name="phone" data-name="Phone Number" placeholder="Phone No" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">
                
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
              <!-- <div class="secure-button"><input type="submit" value="Checkout" data-wait="Loading checkout" class="guru-flow secure-checkout-button w-button"><img src="images/Lock2x.png" loading="lazy" width="16" alt="" class="image-4"></div> -->

                <div class="secure-button">
                  <input type="submit" value="Checkout" data-wait="Loading checkout" class="guru-flow secure-checkout-button w-button">
                    <img src="{{ url('frontend/images/Lock2x.png')}}" loading="lazy" width="16" alt="" class="image-4">
                </div>
               </form>
              </div>
              <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div>
            </div>
          </div>
        </div>
      </div>
   
  </div>

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="https://use.typekit.net/kde5sqc.js" type="text/javascript"></script>

  <script>
    
    WebFont.load({
      google: {
        families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]
      }
    });

    try {
      Typekit.load();
    } catch (e) {}

    ! function(o, c) {
      var n = c.documentElement,
        t = " w-mod-";
      n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
    }(window, document);

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
      // autocomplete.addListener('place_changed', fillInAddress);
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

    //Get Selected
    function GetCourseDate()
    {
      let course = $('#private-in-house-course').children("option:selected").text();
      let participants = $('#participants').children("option:selected").text();
      let address = $("#google_address").val(); 
      let lat = $("#lat").val();
      let long = $("#long").val();
      let error = 0;

      if (!course) {
        $("#fields_required").text("Please Select a course");
        error = 1;
      }
      if (!participants || participants == "Participants") {
        $("#fields_required").text("Please select participants");
        error = 1;
      }
      if (!address) {
        $("#fields_required").text("Please add a address");
        error = 1;
      }
      if(!lat || !long){
        $("#fields_required").text("Please add a valid address");
        error = 1;
      }
      if( error == 1){
        return false;
      }else{
        $("#fields_required").text("");
        $("#step1").addClass('d-none');
        $("#step2").removeClass('d-none');
        $("#step2").addClass('show');
      }

      $(".booking_participants").html(participants);
      $(".booking_address").html(address);
      $(".booking_course").html(course);
    }

    function selectDate(){
      var date = $("#course_date").val();
      let course_id = $('#private-in-house-course').children("option:selected").val();

      console.log("course_id##", course_id);
      if(!date){
        $("#date_required").html("Please select a date");
        return false;
      }else{
        var d = new Date( date );
        year  = d.getFullYear();
        month = d.toLocaleString('default', { month: 'long' });
        day   = d.getDate();

        let participants = $('#participants').children("option:selected").val();

        $.ajax({
        type: "get",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            seats: participants,
            course_id: course_id
          },
          url: '/inhouse-course/price',
          success:function (response){
            $("#selected_course_price").html(`£`+response.data.price);

            $("#date_required").html("");
            $("#selected_date").html(day+"th "+month+" "+year);
            $("#step2").addClass('d-none');
            $("#step2").removeClass('show');
            $("#step3").removeClass('d-none');
            $("#step3").addClass('show');

          },
          error: function(error){
            alert(error.responseJSON.message);
            console.log("error",error);
            return false;
          }
        });
        
      }
    }

    function bookingParticipants(data){
      $("#inhouse_submit").attr('disabled', true);
      let selected = $('#participants').children("option:selected").val();
      if(selected == "36+"){
        $("#inhouse_call_us").removeClass('d-none');
        $("#inhouse_submit").addClass('d-none');
        $("#inhouse_call_us").attr('disabled', false);
      }else{
        $("#inhouse_call_us").addClass('d-none');
        $("#inhouse_submit").removeClass('d-none');
        $("#inhouse_submit").attr('disabled', false);
        $("#inhouse_call_us").attr('disabled', true);
      }
    }
    
   $( function() {
    $('#datepicker').datepicker({
      minDate: new Date(),
      dateFormat: 'yy-mm-dd',
      inline: true,
      altField: '#course_date'
    });

    $('#course_date').change(function(){
        $('#datepicker').datepicker('setDate', $(this).val());
    });

  } );

  </script>
  
@endsection