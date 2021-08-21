@extends('layouts/frontend')
@section('content')
<style>
label {
  background-color: indigo;
  color: white;
  padding: 0.5rem;
  font-family: sans-serif;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 1rem;
}

#file-chosen{
  margin-left: 0.3rem;
  font-family: sans-serif;
}
</style>

  <div class="section guru-signup-page">
    <div class="container thankyou-hero-container">
      <div class="hero-left thankyou-page">
        <!-- <div class="hero-logo-holder thank-you-page"><img src="{{ url('frontend/images/First-aid-Guru-dark-logo.svg')}}" loading="lazy" alt="" class="image hero-logo"></div> -->
        <div class="course-length-holder course-page">
          <div class="body-text white course-length">Join the crew</div>
        </div>
        <div class="h1 guru-signup-title">So, you want to become a guru?</div>
        <div class="body-text course-hero top">First Aid Guru opens doors for qualified first aid instructors, helping you create new opportunities that can transform your business. We provide an easy-to-use booking management system and comprehensive customer service, giving you the platform to enjoy even greater success. Working together we’ll keep you one step ahead of the competition.</div>
        <div class="benefits-holder-orange guru-signup">
          <div class="benefits-holder guru-sign-up guru-page">
            <div class="benefit guru-sign-up"><img src="{{ url('frontend/images/Card-icon2x.png')}}" loading="lazy" height="40" width="79" alt="" class="top-icons guru-sign-up">
              <div class="h3 guru-sign-up">We create your digital business card</div>
            </div>
            <div class="benefit guru-sign-up"><img src="{{ url('frontend/images/Tasks-icon2x.png')}}" loading="lazy" width="72" height="40" alt="" class="top-icons course-page">
              <div class="h3 guru-sign-up">We take care of taking your bookings</div>
            </div>
            <div class="benefit guru-sign-up"><img src="{{ url('frontend/images/Guru-icon.svg')}}" loading="lazy" height="40" alt="" class="top-icons course-page">
              <div class="h3 guru-sign-up">Gain reputation through using the Guru brand</div>
            </div>
          </div>
        </div>
      </div>
      <div class="thankyou-right-section guru-signup"><img src="{{ url('frontend/images/Guru_mockup_v12x.png')}}" loading="lazy" width="476" sizes="(max-width: 767px) 92vw, (max-width: 991px) 476px, 38vw" srcset="{{ url('frontend/images/Guru_mockup_v12x-p-500.png')}} 500w, {{ url('frontend/images/Guru_mockup_v12x-p-800.png')}} 800w, {{ url('frontend/images/Guru_mockup_v12x.png')}} 952w" alt=""></div>
    </div>
    <div class="container guru-signup">
      <div class="container application">
        <div id="contact" class="contact-form-holder-copy become-guru">
          <div class="h2 contact-form">Apply to become a Guru</div>
          <div class="form-block-2 w-form">
            <form id="email-form" name="email-form" data-name="Email Form" action="{{ route('becomeAGuru') }}" method="post" class="form-2" enctype="multipart/form-data">
              @csrf
              <input type="text" class="name-box w-input" value="{{ old('name') }}" maxlength="256" name="name" data-name="Your Name 2" placeholder="Your Full Name" id="Your-name-2" required="">
              <input type="email" class="email-box w-input" maxlength="256" name="email" data-name="Your Email 2" placeholder="Your email address" id="Your-email-2" value="{{ old('email') }}" required="">
              <input type="text" class="name-box w-input" maxlength="256" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="phone" data-name="Your Phone 2" value="{{ old('phone') }}" placeholder="Your Phone Number" id="Your-phone-2" required="">
              <input type="text" id='autocomplete' name="address" value="{{ old('address') }}"  class=" name-box w-input" id="inputAddress" 
              required>
              <input type="text" class="form-control" style="display: none;" value="{{ old('lat') }}"  name="lat" placeholder="Latitude" id="lat">
              <input type="text" class="form-control" style="display: none;" value="{{ old('longitude') }}"  name="longitude" placeholder="longitude" id="long">
              <lable>Do you hold a valid First Aid teaching qualification? </lable>
              <select name="qualification" id="" class="email-box w-input">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
             <!--  <input type="hidden" name="notification_status" value="1"> -->
              <input type="file"  class="email-box w-input w-input" multiple name="certificates[]" id="actual-btn" hidden/>
              
              <!-- custom upload button -->
              <label for="actual-btn">Upload Certificates</label>
              
              <span class="" id="file-chosen">No file chosen</span>
              <!-- <textarea placeholder="Tell us about yourself" maxlength="5000" id="relevent-info-2" name="about" data-name="Relevent Info 2" required="" class="text-area message-box w-input"></textarea> -->

              @if(Session::has('error_message'))
                <div class="mt-2 alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('error_message') }}
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

              <input type="submit" value="CTA - Apply" data-wait="Please wait..." class="find-course-submit w-button">
            </form>
           
          </div>
        </div>
      </div>
    </div>

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
  <script>
      const actualBtn = document.getElementById('actual-btn');

const fileChosen = document.getElementById('file-chosen');

actualBtn.addEventListener('change', function(){
    
  fileChosen.textContent = this.files.length + " files uploaded"
  
})
  </script>

<script>

let placeSearch, autocomplete;
function initAutocomplete() {

autocomplete = new google.maps.places.Autocomplete(

 document.getElementById('autocomplete'),
 {
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
  // Get the place details from the autocomplete object.
  autocomplete.setFields(['geometry']);
  var location = autocomplete.getPlace().geometry.location;
}
  var input = document.getElementById("autocomplete");

  // Execute a function when the user releases a key on the keyboard
  input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    let address = event.target.value;
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK) 
    {
      document.getElementById('lat').value  = results[0].geometry.location.lat();
      document.getElementById('long').value  =  results[0].geometry.location.lng();
    }
  });
    }
  });


  

      </script>

 @endsection