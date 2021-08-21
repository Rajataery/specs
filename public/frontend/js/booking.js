$(function() {
 // Create a Stripe client
  var stripe = Stripe(stripe_key);

  // Create an instance of Elements
  var public_elements = stripe.elements();
  var inhouse_elements = stripe.elements();

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
 
  //Public form
  var publicCardNumber = public_elements.create('cardNumber', { style: style, showIcon: true, placeholder:'0000 0000 0000 0000' });
  var publicCardExpiry = public_elements.create('cardExpiry', { style: style, placeholder:'MM/YY' });
  var publicCardCVV    = public_elements.create('cardCvc', {style: style, placeholder:'CVV' });

  // Add an instance of the card Element into the `card-element` <div>
  publicCardNumber.mount('#public_card_number');
  publicCardExpiry.mount('#public_card_expiry');
  publicCardCVV.mount('#public_card_cvv');

  // Handle real-time validation errors from the card Element.
  publicCardNumber.addEventListener('change', function(event) {
    displayError(event, "public_card_errors");
  });

  publicCardExpiry.addEventListener('change', function(event) {
    displayError(event, "public_card_errors");
  });

  publicCardCVV.addEventListener('change', function(event) {
    displayError(event, "public_card_errors");
  });

  // Handle Public form submission
  var public_form = document.getElementById('public_checkout_form');
 
  public_form.addEventListener('submit', function(event) {
     loader(); 

    loading = true;
    event.preventDefault();
    let customer = document.getElementById('public_customer_name').value;
    var errorElement = document.getElementById('public_card_errors');
    if(typeof customer =='undefined' || customer ==''){
      errorElement.textContent = 'Please fill card holder name.';
      return false;
    }
    stripe.createToken(publicCardNumber, {name:customer}).then(function(result) {
      if (result.error) {
       $("#modal").fadeOut("slow");
        // Inform the user if there was an error
        errorElement.textContent = result.error.message;
        loading = false;
      } else {
        $("#public_stripe_token").val(result.token.id);
        public_form.submit();

      }
    });
  });

  //Inhouse Form
  var inhouseCardNumber = inhouse_elements.create('cardNumber', { style: style, showIcon: true, placeholder:'0000 0000 0000 0000' });
  var inhouseCardExpiry = inhouse_elements.create('cardExpiry', { style: style, placeholder:'MM/YY' });
  var inhouseCardCVV    = inhouse_elements.create('cardCvc', {style: style, placeholder:'CVV' });

  inhouseCardNumber.mount('#inhouse_card_number');
  inhouseCardExpiry.mount('#inhouse_card_expiry');
  inhouseCardCVV.mount('#inhouse_card_cvv');

  inhouseCardNumber.addEventListener('change', function(event) {
    displayError(event, "inhouse_card_errors");
  });

  inhouseCardExpiry.addEventListener('change', function(event) {
    displayError(event, "inhouse_card_errors");
  });

  inhouseCardCVV.addEventListener('change', function(event) {
    displayError(event, "inhouse_card_errors");
  });

  // Handle Inhouse form submission
  var inhouse_form = document.getElementById('inhouse_checkout_form');
    inhouse_form.addEventListener('submit', function(event) {
    loader_inhouse(); 
    /*if(loading){
        alert("Please wait...");
    }*/
    loading = true;
    event.preventDefault();
    let customer = document.getElementById('inhouse_customer_name').value;
    var errorElement = document.getElementById('inhouse_card_errors');
    if(typeof customer =='undefined' || customer ==''){
      errorElement.textContent = 'Please fill card holder name.';
      return false;
    }
    stripe.createToken(inhouseCardNumber, {name:customer}).then(function(result) {
      if (result.error) {
        // Inform the user if there was an error
        $("#modal_inhouse").fadeOut("slow");
        errorElement.textContent = result.error.message;
        loading = false;
      } else {
        $("#inhouse_stripe_token").val(result.token.id);
        inhouse_form.submit();
      }
    });
  });

    function loader()
  {
    $("#modal").fadeIn();
  }

  function loader_inhouse()
  {
    $("#modal_inhouse").fadeIn();
  }

  function displayError(event, error_id){
   // $("#modal").fadeOut("slow");
    
    var displayError = document.getElementById(error_id);
    if (event.error) {
      //$("#modal").fadeOut("slow");
            displayError.textContent = event.error.message;
    } else {

        displayError.textContent = '';
    }
  }

});



function bookingParticipants(data){
  $("#inhouse_submit").attr('disabled', true);
  let selected = $('#inhouse_participants').children("option:selected").val();

  if(selected == "36+"){
    $(".inhouse_course_price").html("");
    $(".inhouse_price").addClass('d-none');
    $("#inhouse_call_us").removeClass('d-none');
    $("#inhouse_submit").addClass('d-none');
    $("#inhouse_call_us").attr('disabled', false);
  }else{
    getInhousePrice();
    $("#inhouse_call_us").addClass('d-none');
    $("#inhouse_submit").removeClass('d-none');
    $("#inhouse_submit").attr('disabled', false);
    $("#inhouse_call_us").attr('disabled', true);
  }
}

//Inhouse Course Booking 

function showAddressField(){
  let course = $('#private-in-house-course').children("option:selected").text();
  let course_id = $('#private-in-house-course').children("option:selected").val();
  let participants = $('#inhouse_participants').children("option:selected").text();
  let total_participants = $('#inhouse_participants').children("option:selected").val();
  let error = 0;

  if (!total_participants) {
    $("#inhouse_fields_required").text("Please select participants");
    error = 1;
  }
  if (!course_id) {
    $("#inhouse_fields_required").text("Please Select a course");
    error = 1;
  }

  if( error == 1){

    return false;
  }else{
    getInhousePrice();
    $("#inhouse_course_text").html("");
    $("#inhouse_fields_required").text("");
    $("#inhouse_booking_data").html(`<div class="course-booker" style="background-image: url({{asset('/frontend/images/medical_image2x.jpg')}})"></div>
      <div class="h3 dark">Find an available course in your location</div>`);
    $("#inhouse_form_buttons").html(`<input type="button"  data-wait="Booking Course..." id="inhouse_submit" class="find-course-submit course-page w-button" value=" Book your Course" onClick="GetCourseDate()">`);
    $("#google_address_inhouse").removeClass('d-none');
  }
}

function GetCourseDate()
{
  let course = $('#private-in-house-course').children("option:selected").text();
  let course_id = $('#private-in-house-course').children("option:selected").val();
  let participants = $('#inhouse_participants').children("option:selected").text();
  let total_participants = $('#inhouse_participants').children("option:selected").val();
  let address = $("#google_address_inhouse").val(); 
  let lat = $("#inhouse_lat").val();
  let long = $("#inhouse_long").val();
  let error = 0;

  if (!total_participants) {
    $("#inhouse_fields_required").text("Please select participants");
    error = 1;
  }
  if (!address) {
    $("#inhouse_fields_required").text("Please add a address");
    error = 1;
  }
  if(!lat || !long){
    $("#inhouse_fields_required").text("Please add a valid address");
    error = 1;
  }
  if (!course_id) {
    $("#inhouse_fields_required").text("Please Select a course");
    error = 1;
  }

  if( error == 1){
    return false;
  }else{
    getInhousePrice();
    hideCoursePageElement();
    $("#inhouse_selected_course").html(course);
    $("#inhouse_selected_participants").html(participants);
    $("#inhouse_booking_address").html(address);

    $("#inhouse_fields_required").text("");
    $("#inhouse_step1").addClass('d-none');
    $("#inhouse_course_text").html("");
    $("#inhouse_booking_data").addClass('d-none');

    $("#inhouse_booking_data").html(`
      <div class="h3 dark booking-flow" >Your booking</div>
      <div class="booking-breadcrumb initial-show corporate">
        <div class="h5 breadcrumb booking_course">`+course+` </div>
        <div class="booking-breadcrumb-info"><img src="{{ url('frontend/images/group-icon2x.png')}}" loading="lazy" height="" width="15" alt="" class="breadcrumb-icon">
          <div class="h6 timer-info course-page"> `+participants+` Course Participants
          </div>
        </div>
        <div class=" booking-breadcrumb-info"><img src="{{ url('frontend/images/Location-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
          <div class="h6 timer-info booking_address course-page" > `+address+` </div>
        </div>
        <div data-w-id="056cde46-4f3a-a9b0-5145-df084fa8980b" class="booking-breadcrumb-info not-selected"><img src="{{ url('frontend/images/Calendar-icon2x.png')}}" loading="lazy" width="12" alt="" class="breadcrumb-icon">
          <div data-w-id="056cde46-4f3a-a9b0-5145-df084fa8980d" class="h6 breadcrumb-info not-selected inhouse_selected_date"><a href="#choose-date">Select a date</a></div>
        </div>
      </div>
    `);

    $("#inhouse_step2").removeClass("d-none");
  }
}

function selectDate(){
  var date = $("#inhouse_course_date").val();
  let course_id = $('#private-in-house-course').children("option:selected").val();

  if(!date){
    $("#date_required").html("Please select a date");
    return false;
  }else{
    var d = new Date( date );
    year  = d.getFullYear();
    month = d.toLocaleString('default', { month: 'long' });
    day   = d.getDate();

    $("#date_required").html("");
    $(".inhouse_selected_date").html(day+"th "+month+" "+year);
    $("#inhouse_step2").addClass('d-none');
    $("#inhouse_step3").removeClass('d-none');
  }
}

function getInhousePrice(){

  let participants = $('#inhouse_participants').children("option:selected").val();
  let course_id = $('#private-in-house-course').children("option:selected").val();
  $("#inhouse_fields_required").text("");

  if (!participants || !course_id ) {
    $(".inhouse_course_price").html("");
    $(".inhouse_price").addClass('d-none');
    return false;
  }else{
    $.ajax({
      type: "get",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        seats: participants,
        course_id: course_id
      },
      url: '/inhouse-course/price/',
      success:function (response){
        $(".inhouse_course_price").html('<span>£</span><span id="inhouse_sub_total">'+response.data.price+`</span>`);
        $(".inhouse_price").removeClass('d-none');
        return true;
      },
      error: function(error){
        $("#inhouse_fields_required").text(error.responseJSON.message);
        $(".inhouse_course_price").html("");
        $(".inhouse_price").addClass('d-none');
        return false;
      }
    });
  }
}

$( function() {

  $('#datepicker').datepicker({
    minDate: 1,
    dateFormat: 'yy-mm-dd',
    inline: true,
    altField: '#inhouse_course_date'
  });

  $('#inhouse_course_date').change(function(){
    $('#datepicker').datepicker('setDate', $(this).val());
  });
});


// Public Booking
$(document).ready(function() {
  
  $('#public_booking_search').submit(function(e) {
    let lat = $("#latitude").val();
    let long = $("#longitude").val(); 
    let course = $('#public_course').children("option:selected").val();
    let address = $('#google_address_public').val();
    let course_id = $("#public_course").val();
    // let loadOption = $('#countload').val();
    // let countloadOption = $('#contLoad').val(loadOption);

    if( !lat || !long ){
      $("#public_fields_required").html("Please add correct address");
      return false;
    }
    search_courses();
  });
});


// function applyDiscountCode(type) {

//             $("#apply_discount_button").prop('disabled',true);
//             let code = $('#discount_code').val();
//             if(!code){
//                 $("#discount_code_message").html(`<span class="text-danger">Please add a discount code.</span>`);
//                 $("#apply_discount_button").prop('disabled',false);
//                 return;
//             }else{
//                 $("#discount_code_message").html('');
//             }

//             let date_id   = $("#public_date_id").val();
//             let course_id = $("#public_course").val();
//             let vendor = $("#course_vendor").text();
  
//             $.ajax({
//                 url:"{{route('discountCode')}}",
//                 method: 'POST',
//                 data:{
//                 vendor : vendor,
//                 type: type,
//                 course_id: course_id,
//                 date_id: date_id,
//                 discount_code:code,
//                 "_token": "{{ csrf_token() }}"
//                 },
//                 success: function(response) {
                


//                     let discount = 0;
//                     let discounted_price = 0;
//                     let html = ``;
//                     //discount = response.data.amount;
                    
//                   discounted_price = (parseFloat(sub_total - discount)).toFixed(2);
//                   let new_total = parseFloat(discounted_price).toFixed(2);
                 
//                   $("#grand_total").html(`$`+new_total);

//                   $("#discount_code_applied").html(html);
//                   $("#discount_code_message").html(`<span class="text-success">Discount code applied.</span>`);

//                   $("#apply_discount_button").prop('disabled',false);
//                   // $('#discount_code_action').html(`<button class="mt-2 custom-btn" id="remove_discount_button" type="button" onclick="removeDiscountCode()">Remove</button>`);
                 
//               },
//                   error:function (error) {
//                     console.log(error);
//                   $("#apply_discount_button").prop('disabled',false);
//                   $("#discount_code_message").html(`<span class="text-danger">Discount code is not valid.</span>`);

//                   alert("Discount code is not valid")
//                 }
//             });
//         }

function publicStepOne(){

 $("#public_course_text").html('<div class="h2 private-course-header">Public courses</div><div class="h5">For individuals and small groups</div><div class="body-text private-courses inhouse">Evening and weekend public courses are available with qualified, accredited trainers teaching vital first aid skills in a relaxed and friendly environment.</div><div class="course-search-holder"></div>');
 
 $("#public_course_text").removeClass('d-none');

 $("#course_text").removeClass('d-none');
 $(".price-holder").removeClass('d-none');

 $("#course").removeClass('d-none');

 $("#public_step1").removeClass('d-none');

 $("#public_step2").addClass('d-none');
 
} 

function publicSteptwo(){

 //$("#public_course_text").html('<div class="h2 private-course-header">Public courses</div><div class="h5">For individuals and small groups</div><div class="body-text private-courses inhouse">Evening and weekend public courses are available with qualified, accredited trainers teaching vital first aid skills in a relaxed and friendly environment.</div><div class="course-search-holder"></div>');
 
 $(".price-holder").removeClass('d-none');

 $("#public_step2").removeClass('d-none');

 $("#public_step3").addClass('d-none');
 
} 


function inhouseStepone(){

  $("#course_text").removeClass('d-none');

  $("#course").removeClass('d-none');

 $("#inhouse_course_text").html('<div class="h2 private-course-header">In-house courses</div><div class="h5">For groups over 8 people and corporate</div><div class="body-text private-courses inhouse">Book in-house first aid courses for large groups to ensure your business meets HSE compliance requirements, covering Emergency First Aid at Work, First Aid at Work and Paediatric First Aid.</div><div class="course-search-holder"></div>');
  
 $("#inhouse_course_text").removeClass('d-none');

 $("#google_address_inhouse").removeClass('d-none');

 $("#inhouse_step1").removeClass('d-none');

 $("#inhouse_step2").addClass('d-none');

}

function inhouseSteptwo(){


 $("#inhouse_step2").removeClass('d-none');

 $("#inhouse_step3").addClass('d-none');

}



function incrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}
//submit form 
/*function search_coursesnext() {
  let course = $('#public_course').children("option:selected").text();
  let address = $('#google_address').val();

  $('#public_booking_search').ajaxSubmit({
    type: "POST",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/public-course/search_next',
    success:function (response){

      if(response.data.length > 0)
      {
        let html = '';
        var today = new Date();
        console.log(today);
        response.data.forEach(venue=>{
          var vanue = venue.Date;
          console.log(vanue);
          let seats_left = venue.seat - venue.seat_booked;
          html += `
            <div class="location-card">
              <div class="location-select-holder">
                <div data-w-id="29cdaed7-c619-026d-2ad9-6619eec345bf" class="selector">
               <span class="select_venue_list" id="selected_venue_`+venue.id+`"> </span>
                <input price="`+venue.price+`" onchange="selectCourseVenue(`+venue.id+`)" time="`+venue.time+`" type="radio" class="select_searched_location" seat="`+venue.seat+`" seat_booked="`+venue.seat_booked+`" seat_left="`+seats_left+`" id="venue_box_`+venue.id+`" required name="selected_venue" value="`+venue.id+`">
                <input type="hidden" id="selected_venue_date_`+venue.id+`" name="selected_venue_date_" value="`+venue.Date+`">
                </div>
              </div>
              <div class="location-information">
                <div class="top-location-info">
                  <div class="h5 location-info">`+venue.location_name+`</div>
                  <div class="h6 how-far-away">`+venue.distance+` miles away from your location</div>
                </div>
                <div class="address-info">
                  <div class="address-full" id="select_course_address_`+venue.id+`">`+venue.address+`</div>
                </div>
                <div class="date-info">
                  <div class="date-full">`+convert_date(venue.Date)+` <small class="h6 how-far-away seats-left ml-4"> Seats left - `+seats_left+` </small>
                  </div>
                </div>
                  <div class="course_vendor">
                  <b>Course Vendor:</b>  `+venue.vendor+`
                  </div>
                </div>
              </div>
          </div>`;
        } );
        
        $('.location-cards-holder').html(html);
        $("#public_course_text").html("");
        $('.course_name_show').html(course);
        $('.course_location_show').html(address);
        $("#public_step2").removeClass('d-none');
        
        $("#public_step1").addClass('d-none');
        $("#public_course_text").addClass('d-none');
        hideCoursePageElement();
        return true;
      }else{
        $("#public_fields_required").html("No course found.");
        $("#public_step1").removeClass('d-none');
        return true;
      }
    },
    error: function(error){

      $("#public_fields_required").html(error.responseJSON.message);
      $("#public_step1").removeClass('d-none');
      return true;
    }
  });
}*/

//var next_month = 1;
$(function() {

  $('#load_more').click(function(){
    $('#modal_loadmore').fadeIn();
  });

});

var counter = 2;
let venue_id = "";
let seats_Left = "";
let seat_Price = 0;
function search_courses() {

  let course = $('#public_course').children("option:selected").text();
  let address = $('#google_address').val();
  var today = new Date();
  //var next_month =  document.getElementById('number').value;
  var count  =   counter++;
  let course_id = $("#public_course").val(); 
 
  $('#public_booking_search').ajaxSubmit({
    type: "POST",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/public-course/search',
    
    success:function (response){
      
      //let days = response.course_data.course_time;
      if(response.data.length > 0)
      { 
      
        $("#modal_loadmore").delay(100).fadeOut();
        let html = '';
        response.data.forEach(venue=>{
           dateTo = moment(venue.Date).format('Do');
            date = venue.Date;
            venue_id = venue.id;
            // var newDate = moment(date).add(days, 'day').format('Do MMM yy');
            let seats_left = venue.seat - venue.seat_booked;
         
          html += `
           <input type="hidden" value="`+count+`" name="loadcount" id="countload">
            <div class="location-card">
              <div class="location-select-holder">
                <div data-w-id="29cdaed7-c619-026d-2ad9-6619eec345bf" class="selector">
               <span class="select_venue_list"  id="selected_venue_`+venue.id+`"> </span>
               <input price="`+venue.price+`"  onchange="selectCourseVenue(`+venue.id+`)" time="`+venue.time+`" type="radio" class="select_searched_location" seat="`+venue.seat+`" seat_booked="`+venue.seat_booked+`" seat_left="`+seats_left+`" id="venue_box_`+venue.id+`" required name="selected_venue" value="`+venue.id+`">
                <input type="hidden" id="selected_venue_date_`+venue.id+`" name="selected_venue_date_" value="`+venue.Date+`">
                </div>
              </div>

              <div class="location-information">
                <div class="top-location-info">
                  <div class="h5 location-info">`+venue.location_name+`</div>
                  <div class="h6 how-far-away">`+(venue.distance.toFixed(2))+` km from your location </div>
                </div>
              
                <div class="date-info">
                  <div class="date-full" id="select_course_address_`+venue.id+`">`+venue.address+`</div>
                </div>
                  <div class="course_vendor d-none" >
                   <b>Course Vendor:</b> <span id="course_vendor"> `+venue.vendor+`
                  </span>
                  </div>
                </div>
              </div>
          </div>`;
        } );
       //loaderLoadmore();

        $('#contLoad').val(count);
        $('.location-cards-holder').html(html);
        $("#public_course_text").html("");
        $('.course_name_show').html(course);
        $('.course_location_show').html(address);
        $("#public_step2").removeClass('d-none');
        $("#public_step1").addClass('d-none');
        $("#public_course_text").addClass('d-none');
        hideCoursePageElement();
        return true;
      }else{
        $("#public_fields_required").html("No course found.");
        $("#public_step1").removeClass('d-none');
        return true;
      }
    },
    error: function(error){

      $("#public_fields_required").html(error.responseJSON.message);
      $("#public_step1").removeClass('d-none');
      return true;
    }
  });
}


// Select Venue 
var events_dates = [];

function selectCourseVenue(id){
  event.preventDefault();
  venue_id = id;

  let price = $("#venue_box_"+id).attr("price");
  $("#public_date").val('');
  $("#public_participants").val('0');
  $("#public_price").removeClass('d-none');
  
  $(".select_venue_list").html("");
  $("#selected_venue_"+id).html(`<img src="/frontend/images/Big-tick2x.png" loading="lazy" height="28" width="40" data-w-id="db53c959-291f-c99e-9b47-5fe74cdb543d" alt="" class="selection">`);
  let course_id =  $("#public_course").val();
  
    events_dates = [];
     seatsPublic = [];
  html ="";
  $("#venue_box_"+id).ajaxSubmit({

    url:"/selectDate",
    method: 'GET',
    data:{
    venue_id:venue_id,
    course_id:course_id,
   
    },

    success: function(response) {
      
      if (response.data.length > 0) {
      response.data.forEach(date=>{
        events_dates.push(date.Date);
        console.log(date.seat);
          //$(".public_course_price").html(`<span>£</span><span id="price_public">`+date.price+`</span>`);
        html += `<input type="hidden" seat="`+date.seat+`" name="seats_public" id="seatsPublic">`;  

        $('#seats_public').html(html);
      });

     
      $("#datepicker_public").removeClass("d-none");
      $("#calendar-title").removeClass("d-none");
      $(".date-availability").removeClass("d-none");
     $("#persons-title").addClass("d-none");
      $(".select_seat").addClass("d-none");
      $("#error").addClass("d-none");
      $("#public_price").addClass("d-none");
      addDatepicker();
      document.getElementById('calendar-title').scrollIntoView(true);
    }else{
     $('#error').text("No Event Available");   
      // GetCourseDatePublic();
      $("#datepicker_public").addClass("d-none");
      $("#error").removeClass("d-none");
      $("#calendar-title").addClass("d-none");
      $(".date-availability").addClass("d-none");
      $("#persons-title").addClass("d-none");
      $(".select_seat").addClass("d-none");
      $("#public_price").addClass("d-none");
      $(".submit_course").addClass("d-none");
      $("#public_price").addClass("d-none");
    }
    // 

    }

});

}

function ShowDates(date) {
  
  var dates = events_dates;
  
  var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
  
  if(dates.indexOf(string) != -1){
    return [dates.indexOf(string) != -1,'' ];
  }else{
    return [false, 'booked-date'];
  }
  
}


function GetCourseDatePublic()
{
  event.preventDefault();

  var date = $("#public_course_date").val();
  
  if(!date){
      console.log('Please select a date');
      $("#date_required_public").html("Please select a date");
      return false;
  }else{
      var date = $("#public_course_date").val();
      $("#selected_course_date").val(date);
      $("#selected_date_show").html(convert_date(date));
      //calculatePublicPrice();
      let date_id = $("input[name='selected_venue']:checked").val();
      let datePublic = $("#selected_date_show").text();
      let course_id = $("#public_course").val();
      let venue_address = $("#venueAddress").text();
      $("#datepicker_public").ajaxSubmit({
        url:"/selectseats",
        method: 'GET',
        data:{
          date:datePublic,
          venue_id:date_id,
          course_id:course_id,
          venue_address,venue_address,
        },
        success: function(response) {
          
          let seat = seats_Left =response.data.seat;
          let seatPrice = seat_Price =response.data.price;
          let participants = $("#public_participants").val();
          var value = parseInt($("#public_participants").val(), 10);
          value = isNaN(value) ? 0 : value;
          value++;
          $("#selected_date_show").text();
          $("#public_date").val(date);
          
          if (participants == 0) {
            $('.public_course_price').html('<span>£</span><span id="public_total_price">'+seatPrice+`</span>`);
            }
          
        } 
      });

  }
}

$(document).ready(function() {
  $("#datepicker_public").change(function(){ 
    $("#select_public_seats").removeClass("d-none");
    $('.datepicker_public').datepicker('remove');
    $('.datepicker_public').datepicker('update');
    $(".submit_course").removeClass("d-none");
    $(".b-cost").removeClass("d-none");
    $(".public_course_price").removeClass("d-none");
    $("#persons-title").removeClass("d-none");
    $(".select_seat").removeClass("d-none");
    $("#public_price").removeClass("d-none");
    $(".bookEvent").removeClass('d-none');

    
  });
});

function addDatepicker() {
  $('#datepicker_public').datepicker("destroy"); 

  $('#datepicker_public').datepicker({
     minDate: 1,
    dateFormat: 'yy-mm-dd',
    inline: true,
    altField: '#public_course_date',
    beforeShowDay:ShowDates,
     
  });

  $('#public_course_date').change(function(){
   
    $('#datepicker_public').datepicker('setDate', $(this).val());
   
  });

  
}


//Add Public Participants

function increasePublicParticipants() {

  let date_id = $("input[name='selected_venue']:checked").val();
  let date = $("#selected_date_show").text();
  let course_id = $("#public_course").val();

  let venue_address = $("#venueAddress").text();
  $("#publicParticipant").ajaxSubmit({

    url:"/selectseats",
    method: 'GET',
    data:{
    date:date,
    venue_id:date_id,
    course_id:course_id,
    venue_address,venue_address,
  },
    success: function(response) {
      
      let seats_left = seats_Left = response.data.seat;
      let seat_price = seat_Price = response.data.price;
      let participants = $("#public_participants").val();
      var value = parseInt($("#public_participants").val(), 10);
      value = isNaN(value) ? 0 : value;
      value++;

      if (seats_left >= value) {
        $('#public_participants').val(value);
        $("#venue_error_message").html("");
        var participantsget = $("#public_participants").val(); 

        if(participantsget == 0){


          let total_price = seat_price;
          
          $('.public_course_price').html('<span>£</span><span id="public_total_price">'+total_price+`</span>`);
          $('#sub_total').html('£'+total_price);
        }else{
          let total_price = seat_price * participantsget;
          $('.public_course_price').html('<span>£</span><span id="public_total_price">'+total_price+`</span>`);
          $('#sub_total').html('£'+total_price);
       
        }
      }else{
        $("#venue_error_message").html("You have already selected maximum seats.");
      }
    } 
  });


}

function decreasePublicParticipants() {


  let date_id = $("input[name='selected_venue']:checked").val();
  let date = $("#selected_date_show").text();
  let course_id = $("#public_course").val();

  let venue_address = $("#venueAddress").text();
  $("#publicParticipant").ajaxSubmit({

    url:"/selectseats",
    method: 'GET',
    data:{
    date:date,
    venue_id:date_id,
    course_id:course_id,
    venue_address,venue_address,
  },
    success: function(response) {

      let seats_left = response.data.seat;
      let seat_price = response.data.price;
      let date_id = $("input[name='selected_venue']:checked").val();
      let participants = $("#public_participants").val();
      var value = parseInt($("#public_participants").val(), 10);
      value = isNaN(value) ? 0 : value;
      value < 1 ? value = 1 : '';
      value--;
      if( value > 0 ){
        if (seats_left >= value) {
          $('#public_participants').val(value);
          $("#venue_error_message").html("");
           var participantsget = $("#public_participants").val(); 
          if(participantsget == 0){
              let total_price = seat_price;
              $('.public_course_price').html('<span>£</span><span id="public_total_price">'+total_price+`</span>`);
              $('#sub_total').html('£'+total_price);
            }else{
              let total_price = seat_price * participantsget;
              $('.public_course_price').html('<span>£</span><span id="public_total_price">'+total_price+`</span>`);
              $('#sub_total').html('£'+total_price);
           
            }
        }else{
          $("#venue_error_message").html("You have already selected maximum seats.");
        }
        $('#public_participants').val(value);
      }else{
    value = 0;
    $('#public_participants').val(value);
  }

  // calculatePublicPrice();
}
});
}

function calculatePublicPrice() {
  let participants = $("#public_participants").val();
  let date_id = $("input[name='selected_venue']:checked").val();
  let seats_left = seats_Left;
  let seat_price = seat_Price;
 
  if(participants == 0){

    let total_price = seat_price;
    $('.public_course_price').html('<span>£</span><span id="public_total_price">'+total_price+`</span>`);
    $('#sub_total').html('£'+total_price);
  }else{
    let total_price = (seat_price *  participants);
    $('.public_course_price').html('<span>£</span><span id="public_total_price">'+total_price+`</span>`);
  $('#sub_total').html('£'+total_price);
  }
  

}

//Select Location Form
$(document).ready(function() {
  $('#select_location_form').submit(function(e) {
    e.preventDefault();
    let selected_date = $("#public_date").val();

    if(!selected_date){
      $('#venue_error_message').html("Please Select a Date");
      $(".b-cost").addClass("d-none");
      $(".public_course_price").addClass("d-none");
      
      return false;
    }
    $('#venue_error_message').html("");
    let participants = $("#public_participants").val();
    let course_id = $("#public_course").val();
    let date_id = $("input[name='selected_venue']:checked").val();
    let total_seat = $("#venue_box_"+date_id).attr("seat");
    let booked_seat = $("#venue_box_"+date_id).attr("seat_booked");
    let selected_location = $("#select_course_address_"+date_id).html();
    let time = $("#venue_box_"+date_id).attr("time");
    let price = $("#venue_box_"+date_id).attr("price");
    let seats_left = seats_Left;

    if(seats_left > 0 ){
      calculatePublicPrice(participants);
      let participants_html = "";

      for (i = 0; i < participants; i++) {
      let person = i +1;
      if(participants == 1){
       person ="";
      }
        participants_html += `<div class="col-12 border pt-2 mb-2">
          <b> Candidate `+person+` </b>
          <input type="text" class="name w-input" maxlength="256" name="participant_detail[`+(i+1)+`][name]" placeholder="Name" required="">
          <input type="email" class="name w-input" maxlength="256" name="participant_detail[`+(i+1)+`][email]" data-name="Email address" placeholder="Email address" required="">
          <input type="text" class="name w-input phone_number" onkeyup="validateNumber(this)" maxlength="15" name="participant_detail[`+(i+1)+`][phone]" data-name="phone" placeholder="Phone No" required="">
        </div>`;
      }

      let public_course_name = $('#public_course').children("option:selected").text();

      $("#public_participants_list").html(participants_html);
      $("#public_course_name").html(public_course_name);
      $("#public_course_location").html(selected_location);
      $("#public_course_seats").html(participants + ` seat`);
      $("#public_course_date1").html(convert_date(selected_date) );
      $("#public_course_date").val(convert_date(selected_date) );

      $('#public_date_id').val(date_id);
      $('#public_selected_participants').val(participants);
      $('#courses_id').val(course_id);
      $('#venue_error_message').html("");
      $("#public_step3").removeClass('d-none');
      $("#public_step2").addClass('d-none');
      document.getElementById('bookingPublic').scrollIntoView(true);
    }else{
      
      $('#venue_error_message').html("Please Select Event");
    }
  });
});   



$('#apply-cpn-code').on('click', function(e) {
  e.preventDefault();
  $('#cpn-popup').toggleClass('is-visible');
});
 

function validateNumber(e){
  if (/\D/g.test(e.value))
  {
    // Filter non-digits from input value.
    e.value = e.value.replace(/\D/g, '');
  }
}

function convert_date(date) {
  var d = new Date( date );
  year  = d.getFullYear();
  month = d.toLocaleString('default', { month: 'long' });
  day   = d.getDate();
  return day+"th "+month+" "+year;
}

function hideCoursePageElement(){
  $(".course-page-booking-step1").addClass('d-none');
}

function locationID() {
public_date_id
    $('#checkcoupon_public').val("no");
    $("#apply_discount_button").prop('disabled',true);
    let code = $('#discount_code').val();
     

}