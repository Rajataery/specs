@extends('layouts.frontend')
@section('content')

  <div class="section guru-booking-flow">
    <div class="container booking-flow @if(isset($course_type)) d-none @endif " id="booking_flow_step_1">
      <div class="booking-flow-half">
        <div class="gruru-info-holder">
          <div class="h1 guru-name">Public Booking flow</div>
          <div>Here&#x27;s the flow for if a user selects public course.<br><br>1. Select number of seats<br>2. Enter your address (google autofill)</div>
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

            <form id="public_booking_search" name="wf-form-in-house-course-form" data-name="in house course form" class="form course-page">
              @csrf
              <div class="select-box-holder">
                <select id="public_course" name="course" data-name="Public Course" required="" class="select-box w-select">
                  @foreach ($courses as $course)
                   <option value="{{ $course->id }}" {{ $course->id==@$course_id ? 'Selected' : ''}} >{{ $course->course_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="select-box-holder corporate-selection">
                <select id="participants" name="participants" data-name="Participants" required="" class="select-box w-select">
                  <option value="">Partcipants</option>
                  <option @if(isset($participants) &&  $participants == 1) selected @endif value="1">1</option>
                </select>
              </div>

              <input type="text" id='google_address' class="google-address-search w-input" maxlength="256" value="{{@$address}}" name="address"  placeholder="First line of your address or postcode" required>
              <input type="hidden" name="lat" value="{{@$lat}}" id="lat">
              <input type="hidden" name="lang" value="{{@$lang}}" id="long">

              <span class="text-danger" id="fields_required"></span>
              <button type="submit" data-wait="Searching courses..." class="find-course-submit course-page w-button">Find your Course</button>
              
            </form>
            <!-- <div class="w-form-done">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div> -->
          </div>
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div>
        </div>
      </div>
    </div>
    <div class="container booking-flow corporate d-none" id="booking_flow_step_2">
      <div class="booking-flow-half step-2">
        <div class="gruru-info-holder">
          <div class="h1 guru-name">Step 2</div>
          <div>1. Select a location<br>2. Proceed to select a location</div>
        </div>
      </div>
      <div class="guru-booking-step-2">
        <div class="h3 dark booking-flow">Your booking</div>
        <div class="booking-breadcrumb initial-show corporate">
          <div class="h5 breadcrumb course_name_show" ></div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page">1 Seat</div>
          </div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page course_location_show"></div>
          </div>
          <div data-w-id="056cde46-4f3a-a9b0-5145-df084fa8980b" class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
            <div data-w-id="056cde46-4f3a-a9b0-5145-df084fa8980d" class="h6 breadcrumb-info not-selected"><a href="#select-location" >Select a location</a></div>
          </div>
        </div>

        <div class="booking-breadcrumb step-2" id="select-location">
            <div class="h3 dark">Select a location</div>
            <div class="form-block-3 w-form">
              <form id="select_location_form" class="form course-page">
                <div class="location-cards-holder">
                </div>
                <span id="venue_error_message" class="text-danger"> </span>
                 <input type="submit" value="Select location" data-wait="Loading form" class="find-course-submit course-page w-button"></form>
                </form>
            </div>
          
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt="" class="image-5"><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt="" class="image-6"></div>
        </div>
      </div>
    </div>
    <div class="container booking-flow d-none" id="booking_flow_step_3">
      <div class="booking-flow-half step-3">
        <div class="gruru-info-holder">
          <div class="h1 guru-name">Step 3</div>
          <div>1. Complete the details<br>2. Check out<br>3. Takes you to the thank you page</div>
        </div>
      </div>
      <div class="guru-booking-step-2">
        <div class="h3 dark">Your booking</div>
        <div class="booking-breadcrumb initial-show">
          <div class="h5 breadcrumb course_name_show"></div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page">1 Seat</div>
          </div>
          <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page course_selected_location"></div>
          </div>
          <div class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
            <div class="h6 timer-info course-page course_location_date"></div>
          </div>
        </div>
        <div class="booking-breadcrumb step-2">
          <div class="h3 dark checkout">Secure checkout</div>
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/stripe2.svg')}}" loading="lazy" alt=""></div>
          <div class="checkout-form-block w-form">

            <form id="checkout_form" method="post" action="{{route('bookingPublic.checkout')}}" name="email-form" data-name="Email Form" class="secure-checkout require-validation"  data-cc-on-file="false" data-stripe-publishable-key="{{ config('services')['stripe']['key'] }}" id="payment-form">
              @csrf 
              <input type="text" class="name w-input" maxlength="256" name="name" data-name="Name" placeholder="Your name" id="Name" required="">

              <input type="text" class="name business w-input" maxlength="256" name="businessName" data-name="Business name" placeholder="Business name" id="Business-name" required="">

              <input type="email" class="email-address w-input" maxlength="256" name="email" data-name="Email address" placeholder="Your email address" id="Email-address" required="">

              <input type="text" class="name business w-input" maxlength="256" name="phone" data-name="phone" placeholder="Phone No" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">

              <input type="hidden" id="date_id" name="date_id" >

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
          <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div>
        </div>
      </div>
    </div>
  </div>

   @if(isset($course_type))
    <script>
      $(document).ready(function() {
          search_courses();
        });
    </script>
  @endif

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

    $(document).ready(function() {
      
      $('#public_booking_search').submit(function(e) {
        let lat = $("#lat").val();
        let course = $('#public_course').children("option:selected").text();
        let address = $('#google_address').val();
        if(!lat){
          $("#fields_required").html("Please add correct address");
          $("#booking_flow_step_1").removeClass('d-none');
          return false;
        }

        search_courses();
      });
    });

    //submit form 
    function search_courses() {
      let course = $('#public_course').children("option:selected").text();
      let address = $('#google_address').val();

      $('#public_booking_search').ajaxSubmit({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/public-course/search',
        success:function (response){
          if(response.data.length > 0)
          {
            let html = '';
            response.data.forEach(venue=>{
              html += `
                <div class="location-card">
                  <div class="location-select-holder">
                    <div data-w-id="29cdaed7-c619-026d-2ad9-6619eec345bf" class="selector">
                   <span class="select_venue_list" id="selected_venue_`+venue.id+`"> </span>
                    <input price="`+venue.price+`" onchange="selectCourseVenue(`+venue.id+`)" time="`+venue.time+`" type="radio" class="select_searched_location" seat="`+venue.seat+`" seat_booked="`+venue.seat_booked+`" id="venue_box_`+venue.id+`" required name="selected_venue" value="`+venue.id+`">
                    <input type="hidden" id="selected_venue_date_`+venue.id+`" name="selected_venue_date_" value="`+venue.Date+`">
                    </div>
                  </div>
                  <div class="location-information">
                    <div class="top-location-info">
                      <div class="h5 location-info">`+venue.location_name+`</div>
                      <div class="h6 how-far-away">`+venue.distance+`km away from your location</div>
                    </div>
                    <div class="addrss-info">
                      <div class="address-full" id="select_course_address_`+venue.id+`">`+venue.address+`</div>
                    </div>
                    <div class="addrss-info">
                      <div class="address-full">`+convert_date(venue.Date)+`</div>
                    </div>
                  </div>
              </div>`;
            });
            
            $('.location-cards-holder').html(html);

            $('.course_name_show').html(course);
            $('.course_location_show').html(address);
            $("#booking_flow_step_2").removeClass('d-none');
            $("#booking_flow_step_3").addClass('d-none');
            $("#booking_flow_step_1").addClass('d-none');
            return true;
          }else{
            alert("No course found");
            $("#fields_required").html("No course found.");
            $("#booking_flow_step_1").removeClass('d-none');
            return true;
          }
        },
        error: function(error){
          alert(error.responseJSON.message);
           $("#fields_required").html(error.responseJSON.message);
           $("#booking_flow_step_1").removeClass('d-none');
            console.log("error",error);
          return true;
        }
      });

      return true;
    }

    // Select Venue 
    function selectCourseVenue(id){
      $(".select_venue_list").html("");
      $("#selected_venue_"+id).html(`<img src="{{ url('frontend/images/Big-tick2x.png')}}" loading="lazy" height="28" width="40" data-w-id="db53c959-291f-c99e-9b47-5fe74cdb543d" alt="" class="selection">`);

    }

    //Select Location Form
    $('#select_location_form').submit(function(e) {

      e.preventDefault();
      let venue_id = $("input[name='selected_venue']:checked").val();
      let total_seat = $("#venue_box_"+venue_id).attr("seat");
      let booked_seat = $("#venue_box_"+venue_id).attr("seat_booked");
      let selected_location = $("#select_course_address_"+venue_id).html();
      let selected_date = $("#selected_venue_date_"+venue_id).val();
      let time = $("#venue_box_"+venue_id).attr("time");
      let price = $("#venue_box_"+venue_id).attr("price");

      if(booked_seat < total_seat){

        $(".course_selected_location").html(selected_location);
        $(".course_location_date").html(convert_date(selected_date)  +` | `+time);
        $('#selected_course_price').html(`£`+price);
        $('#date_id').val(venue_id);

        $('#venue_error_message').html("");
        $("#booking_flow_step_3").removeClass('d-none');
        $("#booking_flow_step_2").addClass('d-none');

      }else{
        $('#venue_error_message').html("No seat left in your selected location");
      }
      
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