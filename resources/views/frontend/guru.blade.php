 @extends('layouts.frontend')
@section('content')
  <div class="section hero-guru-page">
    <div class="container guru-page-hero-container">
      <div class="guru-left">
        <div class="guru-topline-holder">
          <div class="gruru-info-holder">
            <div class="h1 guru-name">{{$data->name}}</div>
            <div class="guru-info"><img src="{{ url('frontend/images/Medicaldoctor2x.png')}}" loading="lazy" width="19" alt="" class="image-3">
              <div class="h6 timer-info course-page">Over {{$data->experience}} years experience</div>
            </div>
          </div>
          <div class="guru-image-holder">
            <div class="guru-image" style="background-image: url({{asset('/frontend/images/'.$data["profile"])}})"  ></div>
          </div>
        </div>
        <div class="course-square-holder">
          <div class="white-course-name-square">
            <a href="#" class="course-name-basic-link w-inline-block">
              <div class="courses-covered">Emergency First Aid at Work</div>
            </a>
          </div>
          <div class="white-course-name-square">
            <a href="#" class="course-name-basic-link w-inline-block">
              <div class="courses-covered">First Aid at Work</div>
            </a>
          </div>
          <div class="white-course-name-square">
            <a href="#" class="course-name-basic-link w-inline-block">
              <div class="courses-covered">Paediatric First Aid</div>
            </a>
          </div>
        </div>
        <div class="guru-blurb-holder">
          <div class="body-text guru-hero">
             {{$data->about}}
          </div>
        </div>
      </div>
      <div class="guru-booking-step-1 guru-page">
        <div class="booking-breadcrumb step-1" id="guru_step_1">
          <div class="guru-form step-1 w-form">
            <div class="h3 orange">Book {{$data->name}}</div>
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

           <form id="checkout_form" method="post" action="{{route('bookingGuru.checkout')}}" name="email-form" data-name="Email Form" class="secure-checkout require-validation"  data-cc-on-file="false">
              @csrf 
              <meta name="csrf-token" content="{{ csrf_token() }}" />
              <div class="multi-select-row" id="guru_rows">
                <div class="select-box-holder guru-page">
                  <select id="select_course" required name="course_id" data-name="Select Course" class="select-box w-select">
                    <option value="">Select a first aid course</option>
                    @foreach ($courses as $course)
                      <option value="{{ $course->id }}" {{ $course->id==@$course_id ? 'Selected' : ''}} >{{ $course->course_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="select-box-holder guru-page participants">
                  <select id="participants" onchange="bookingParticipants(this)" name="participants" data-name="Participants" required="" class="select-box w-select">
                    <option value="">Participants</option>
                    <option value="1_12">1 - 12</option>
                    <option value="12+">12+</option>
                  </select>
                </div>
                <input type="hidden" name="guru_id" value="{{$data->id}}">
              </div>
              <input type="text" required class="google-address-search w-input" maxlength="256" name="address" data-name="Google Address Autofill" placeholder="Where would you like your course delivered" id="google_address" autocomplete="off">
              <input type="hidden" name="lat" value="" id="lat">
              <input type="hidden" name="lang" value="" id="long">

              <input type="button" id="available_date_button" value="Find available dates" data-wait="Finding Available dates" onclick="findDates()" class="find-course-submit course-page w-button">

              <a id="call_us_button" class="find-course-submit w-button d-none text-center text-white" href="tel:124522">Call Us</a>
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
            <div class="text-danger text-center" id="error_message"></div>
          </div>
          <!-- <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div> -->
          <div class="course-icon-holder">
          <div class="trustpilot-holder"><img src="{{url('frontend/images/trsutpilot.svg')}}" loading="lazy" alt=""></div>
          </div>
        </div>

        <div class="booking-breadcrumb d-none" id="guru_step_2">
          <div class="h3 dark booking-flow d-none">Your booking</div>
          <div class="booking-breadcrumb initial-show d-none">
            <div class="h5 breadcrumb"></div>
            <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Medicaldoctor-dark2x.png')}}" loading="lazy" width="15" alt="" class="breadcrumb-icon">
              <div class="h6 timer-info course-page">{{ ucfirst(@$data->name) }}</div>
            </div>
            <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
              <div class="h6 timer-info course-page">Course Participants</div>
            </div>
            <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
              <div class="h6 timer-info course-page">address</div>
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
            <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>
            <input type="button"  value="Back" data-wait="" onclick="Stepone_guru()" >
          </a>
              <div class="calendar-holder">
                <div class="date-holder">
                  <input type="text" name="date" id="course_date" class="d-none" required>
                    <div id="datepicker"></div>
                </div>
              </div>
              <div data-w-id="3d324d2f-3bde-c201-f860-e018f86ce0ad" class="date-selection-mobile">
              </div>
            <div class="btn_div">
              <div class="price-holder">
                <div class="h2 total-price selected_course_price"></div>
                <div class="h6">Inc. VAT</div>
              </div>
            <input type="button" id="selected_date_button" onClick="GetCourseDate()" value="Secure Checkout" data-wait="Loading form" class="find-course-submit course-page w-button">
            </div>
              <p class="text-danger text-center" id="date_required"></p>
            </div>
            <!-- <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt="" class="image-5"><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt="" class="image-6"> </div> -->
            <div class="course-icon-holder">
          <div class="trustpilot-holder"><img src="{{url('frontend/images/trsutpilot.svg')}}" loading="lazy" alt=""></div>
          </div>
          </div>
        </div>

        <div class="booking-breadcrumb d-none" id="guru_step_3">
        <a class="goBack">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100pt" viewBox="0 0 489.000000 347.000000" preserveAspectRatio="xMidYMid meet">
                  <g transform="translate(0.000000,347.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1645 3439 c-11 -6 -386 -376 -832 -823 l-813 -811 0 -70 0 -70 823 -823 822 -822 50 0 c59 1 89 15 116 56 21 32 25 93 8 127 -6 12 -320 331 -698 710 l-686 687 2165 0 c2041 0 2167 1 2199 18 51 25 74 63 73 117 0 51 -19 86 -59 112 -26 17 -144 18 -2202 21 l-2176 2 694 694 694 694 5 55 c4 51 2 57 -30 92 -29 32 -42 38 -84 42 -27 2 -58 -2 -69 -8z"/>
                  </g>
                </svg>
          <input type="button"  value="Back" data-wait="" onclick="Steptwo_guru()" >
        </a>
          <div class="h3 dark">Your booking</div>
          <div class="booking-breadcrumb initial-show">
            <div class="h5 breadcrumb" id="guru_booking_course">{{ @$selected_course->course_name}}</div>
            <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Medicaldoctor-dark2x.png')}}" loading="lazy" width="15" alt="" class="breadcrumb-icon">
              <div class="h6 timer-info course-page">{{ ucfirst($data->name)}}</div>
            </div>
            <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
              <div class="h6 timer-info course-page" id="guru_booking_participants"></div>
            </div>
            <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
              <div class="h6 timer-info course-page" id="guru_booking_address"></div>
            </div>
            <div class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
              <div data-w-id="87e98ebd-ba1e-f828-9e8d-e838406fe07c" class="h6 breadcrumb-info not-selected" id="selected_date_show"></div>
              <div class="h6 timer-info course-page"> </div>
            </div>
          </div>
          <div class="modal" id="modal" style="margin-left: 45%;"> <img data-src="http://itsolutionstuff.com/upload/PHP-Angular-JS.png" src="{{ url('frontend/images/Rolling.gif')}}" class="img-1"> </div> 
          <div class="booking-breadcrumb step-2">
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
              <input type="text" class="name business w-input" maxlength="256" name="phone" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" data-name="phone" placeholder="Phone No" required="">
              <input type="hidden" id="selected_course_date" name="date">
            </div>
              <div class="secure-checkout-holder-copy">
                <input type="text" class="payment-info w-input" maxlength="256" name="card_name" data-name="Card Name" placeholder="Card Holder Name" id="customer-name" autocomplete="off" required="">
                <div class="mt-3 customer-card-number" id="customer-card-number"></div>
                <div class="cvv-and-exp-holder">
                  <div class="card-number-holder cvv customer-card-expiry" id="customer-card-expiry"></div>
                  <div class="card-number-holder cvv customer-card-cvv" id="customer-card-cvv">
                  </div>
                  <div class="powered-by-holder">
                    <img src="{{ url('frontend/images//stripe1.svg')}}" loading="lazy" height="25" alt="" class="image-7">
                  </div>
                </div>
                <div id="card-errors" class="text-danger text-center" role="alert"></div>
              </div>
            </div>
            
            <div class="coupon-code">
                    <div class="apply-code"><a class="u-price" id="apply-cpn-code">Apply coupon code</a>
                    <div class="d-applied" id="discount_code_message_guru"> </div>
                  </div>
                  <div class="coupon-popup" id="cpn-popup">
                    <input type="text" name="coupon" placeholder="Discount Coupon" id="discount_code_guru" class="w-input coupon">
                    <div id="discount_code_action_guru">
                    <input type="button" name="Apply" value="Apply" id="apply_discount_button_guru" onclick="applyDiscountCodeGuru('guru')" class="w-button">
                  </div>
                </div>
                      <input type="hidden" class="name" id="code_guru" value="" name="code">                     
                      <p id="discount_code_applied_guru"> </p>
                    <input type="hidden" name="check_coupon" value="no" id="checkcoupon">  
                    </div>
                    <div class="d-none" id="u-price">
                    <p class="u-price"><span class="value" id="sub_total_guru"><span></p>
                    <p class="u-price"> <span class="value" id="discount_guru"><span></p>
                    <p class="u-price"> <span class="value" id="grand_total_guru"><span></p>
                    </div>
                        <input type='hidden' name='stripeToken' id="stripe_token" />
                        <label class="w-checkbox terms-and-conditions mt-4 ml-5">
                          <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox">
                          </div>
                          <input type="checkbox" name="terms_and_conditions" data-name="Terms and conditions" required="" style="opacity:0;position:absolute;z-index:-1">
                            <span for="Terms and conditions" class="checkbox-label w-form-label"><a href="/terms-conditions" target="_blank">I agree with the terms and conditions</a></span>
                        </label>
            </div>
            <div class="payment-submit">
              <div class="price-holder">
                <div class="h2 total-price selected_course_price guru_price"></div>
                <div class="h6">Inc. VAT</div>
              </div>
              <div class="secure-button"><input type="submit" value="Checkout" data-wait="Loading checkout" class="guru-flow secure-checkout-button w-button"><img src="{{ url('frontend/images/Lock2x.png')}}" loading="lazy" width="16" alt="" class="image-4"></div>
            </div>
            </form>
            <!-- <div class="trust-holders-booking"><img src="{{ url('frontend/images/Mcafee.svg')}}" loading="lazy" alt=""><img src="{{ url('frontend/images/Trusted-site.svg')}}" loading="lazy" alt=""></div> -->
            <div class="course-icon-holder">
          <div class="trustpilot-holder"><img src="{{url('frontend/images/trsutpilot.svg')}}" loading="lazy" alt=""></div>
          </div>
          </div>
        </div>

        </div> 
      </div>
    </div>
  </div>
  <div class="section orange-guru-page">
    <div class="container orange-container guru-page">
      <div class="benefits-holder guru-page">
        <div class="benefit"><img src="{{ url('frontend/images/Star2x.png')}}" loading="lazy" width="90" alt="" class="top-icons">
          <div class="h3">Here’s our first value proposition</div>
          <div class="body-text white top-benefit">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.</div>
        </div>
        <div class="benefit"><img src="{{ url('frontend/images/Medical2x.png')}}" loading="lazy" width="71" alt="" class="top-icons">
          <div class="h3">Here’s something else that’s really great</div>
          <div class="body-text white top-benefit">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.</div>
        </div>
        <div class="benefit"><img src="{{ url('frontend/images/Date-check2x.png')}}" loading="lazy" width="71" alt="" class="top-icons">
          <div class="h3">We’re different because we do things differently</div>
          <div class="body-text white top-benefit">Fusce at nisi eget dolor rhoncus facilisis. Mauris ante nisl, consectetur et luctus et, porta ut dolor. Curabitur ultricies ultrices nulla. Morbi blandit nec est vitae dictum.</div>
        </div>
      </div>
    </div>
  </div>
  <div class="section white-section-guru-page">
    <div class="container overlap-container-course-page">
      <div class="good-company-holder course-page">
        <div class="good-company-title">
          <div class="h2 heavy-centered">You’re In good company</div>
          <div class="h4 centered good-company">We’ve helped over 30,000 people get training</div>
        </div>
        <div class="good-company-logo"><img src="{{ url('frontend/images/Underground.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{ url('frontend/images/G4S.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{ url('frontend/images/NHS-Logo.svg')}}" loading="lazy" alt="" class="trust-logo"><img src="{{ url('frontend/images/Mitie.svg')}}" loading="lazy" alt="" class="trust-logo"></div>
      </div>
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



  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://js.stripe.com/v3/"></script>

  <script>
    // Create a Stripe client
    var stripe = Stripe(stripe_key);

    // Create an instance of Elements
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '24px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };

    var loading = false;

    var cardNumber = elements.create('cardNumber', { style: style, showIcon: true, placeholder:'0000 0000 0000 0000' });
    var cardExpiry = elements.create('cardExpiry', { style: style, placeholder:'MM/YY' });
    var cardCVV    = elements.create('cardCvc', {style: style, placeholder:'CVV' });

    // Add an instance of the card Element into the `card-element` <div>
    cardNumber.mount('#customer-card-number');
    cardExpiry.mount('#customer-card-expiry');
    cardCVV.mount('#customer-card-cvv');

    // Handle real-time validation errors from the card Element.
    cardNumber.addEventListener('change', function(event) {
      displayError(event);
    });

    cardExpiry.addEventListener('change', function(event) {
      displayError(event);
    });

    cardCVV.addEventListener('change', function(event) {
      displayError(event);
    });

    // Handle form submission
    var form = document.getElementById('checkout_form');

    form.addEventListener('submit', function(event) {
      loader();     
      /*if(loading){
          alert("Please wait...");
      }*/
      loading = true;
      event.preventDefault();
      let customer = document.getElementById('customer-name').value;
      var errorElement = document.getElementById('card-errors');
      if(typeof customer =='undefined' || customer ==''){
        errorElement.textContent = 'Please fill card holder name.';
        return false;
      }
      stripe.createToken(cardNumber, {name:customer}).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error
          $("#modal").fadeOut("slow");
          errorElement.textContent = result.error.message;
          loading = false;
        } else {
          $("#stripe_token").val(result.token.id);
          form.submit();
        }
      });

    });

    function displayError(event){
      var displayError = document.getElementById('card-errors');
      if (event.error) {
          displayError.textContent = event.error.message;
      } else {
          displayError.textContent = '';
      }
    }

    let placeSearch, autocomplete;
    function initAutocomplete() {
      autocomplete = new google.maps.places.Autocomplete(
       document.getElementById('google_address'),
       {
        // types: ['geocode'],
        types: ['(cities)'],
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

    var booked_dates = '';

    function findDates(e){
      let course_id = $('#select_course').children("option:selected").val();
      let total_participants = $('#participants').children("option:selected").val();
      let course = $('#select_course').children("option:selected").text();
      let participants = $('#participants').children("option:selected").text();

      let address = $("#google_address").val(); 
      let lat = $("#lat").val();
      let long = $("#long").val();
      var guru_id = '{{$data->id}}';
      let error = 0;
     
      if (!address) {
        $("#error_message").text("Please add a address");
        error = 1;
      }
      if(!lat || !long){
        $("#error_message").text("Please add a valid address");
        error = 1;
      }
      if (!total_participants) {
        $("#error_message").text("Please select participants");
        error = 1;
      }
      if (!course_id) {
        $("#error_message").text("Please Select a course");
        error = 1;
      }

      if( error == 1){
        return false;
      }else{
        $("#error_message").html("");
        $("#available_date_button").attr('disabled', true);

        $.ajax({
          type: "POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            course_id: course_id,
            participants: total_participants,
            guru_id: guru_id,
            address: address,
            lat: lat,
            lang: long,
          },
          url: "{{ route('bookingFlowGuru') }}",
          success:function (response){
            booked_dates = response.data.bookings;
            $("#guru_step_1").addClass('d-none');
            $("#guru_step_2").removeClass('d-none');
            $(".selected_course_price").html(response.data.price);

            $("#guru_booking_course").html(course);
            $("#guru_booking_address").html(address);
            $("#guru_booking_participants").html( participants +` Course Participants`);
            addDatepicker();
          },
          error: function(error){
            console.log("error", error);
            $("#available_date_button").attr('disabled', false);
            $("#error_message").html(error.responseJSON.message); 
          }
       });
      }
    }
    $(function() {
    $("#datepicker_public").datepicker();
    $("#datepicker_public").on("select",function(){
        var selected = $(this).val();
        console.log("selected",selected);
        alert(selected);
    });
});

    function GetCourseDate()
    {
      var date = $("#course_date").val();
      if(!date){
        $("#date_required").html("Please select a date");
        return false;
      }else{
        
        $("#date_required").html("");
        $("#selected_course_date").val(date);
        $("#selected_date_show").html(convert_date(date));
        $("#guru_step_2").addClass('d-none');
        $("#guru_step_3").removeClass('d-none');
      }
    }

    function DisableDates(date) {
      var dates = booked_dates.split(',');
      var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

      if(dates.indexOf(string) == -1){
        return [dates.indexOf(string) == -1,' ' ];
      }else{
        return [false, 'guru-booked-date'];
      }
    }
       
    function addDatepicker() {
        $('#datepicker').datepicker({
          minDate: 1,
          dateFormat: 'yy-mm-dd',
          inline: true,
          altField: '#course_date',
          beforeShowDay: DisableDates
      });
        $('#course_date').change(function(){
        $('#datepicker').datepicker('setDate', $(this).val());
      });
    }

    function convert_date(date) {
      var d = new Date( date );
      year  = d.getFullYear();
      month = d.toLocaleString('default', { month: 'long' });
      day   = d.getDate();
      return day+"th "+month+" "+year;
    }

  function Stepone_guru(){
    $("#available_date_button").attr('disabled', false);
    $("#guru_step_1").removeClass('d-none');
    $("#guru_step_2").addClass('d-none'); 
  }

  function Steptwo_guru(){
    
    $("#guru_step_2").removeClass('d-none'); 
    $("#guru_step_3").addClass('d-none'); 
  }


  function loader()
  {
    $("#modal").fadeIn();
  }

  $('#cpn-popup').hide();
            $('#apply-cpn-code').on('click', function(e) {
              e.preventDefault();
              $('#cpn-popup').show();
              $('#discount_code_guru').show();
              $('#apply_discount_button_guru').show();
              
            });

  function applyDiscountCodeGuru(type) {
    $('#checkcoupon').val("no");
    $("#apply_discount_button_guru").prop('disabled',true);
    let code = $('#discount_code_guru').val();
    if(!code){
        $("#discount_code_message_guru").html(`<span class="text-danger">(Please add a discount code.)</span>`);
        $("#apply_discount_button_guru").prop('disabled',false);
        return;
    }else{
        $("#discount_code_message_guru").html('');
    }

      let course_id = $("#select_course").val();
      let vendor = $("#course_vendor").text();
      let price = $(".guru_price").text();
      $("#sub_total_guru").html(`<label>Sub Total :</label><span>£`+price+`.00</span>`);
    $.ajax({
        url: "{{ route('discountCode') }}",
        method: 'POST',
        data:{
          type: type,
          course_id: course_id,
          discount_code:code,
          vendor:vendor,
          price:price,
          "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
          $('#u-price').removeClass("d-none");
          $('#checkcoupon').val("yes");
          $(".price-holder").hide();
          $("#cpn-popup").hide();
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
           $("#grand_total_guru").html(`<label> Total : </label> <span>£`+discount+`</span>` );
           if(response.data.discount_type == "amount"){
            $("#discount_guru").html(`<label> Discount : </label><span>- £`+discounted_price+`</span>`);
          }else{

          }

            $("#discount_code_applied_guru").html(html);
            $("#discount_code_message_guru").html(`<span class="text-success">(Discount code applied.)</span>`);

            $("#apply_discount_button_guru").prop('disabled',false);
           
           alert("Discount code is valid");
        },
        error:function (error) {
          
          $(".price-holder").show();
          $('#u-price').addClass("d-none");
            $("#apply_discount_button_guru").prop('disabled',false);
            $("#discount_code_message_guru").html(`<span class="text-danger">(Discount code is not valid.)</span>`);

            alert("Discount code is not valid")
        }
    });
}

  
  </script>
@endsection
 