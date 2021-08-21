@extends('layouts.admin')
@section('content')
<script>
$('select').selectpicker();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Create New Event</h4>
            <form autocomplete="off" method="post" action="{{url('/admin/dates/store')}}"    enctype="multipart/form-data">
                @csrf
            
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Date</label>
                <input type="date" class="form-control" name="date" />
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Time</label>
                <input type="time" class="form-control" name="time" />
              </div>
            
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Venue</label>
                <select class="selectpicker form-control" data-live-search="true" name="venue_id">
                <option> Select Venue </option>
                @foreach($venue as $item)
                  <option value="{{$item->id}}">{{$item->location_name}}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Guru</label>
                <select class="selectpicker form-control" data-live-search="true" name="guru_id">
                <option > Select Guru </option>
                @foreach($guru as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Course</label>
                <option > Select Course </option>
                  <select class="selectpicker form-control" data-live-search="true" name="course_id">
                  @foreach($course as $item)
                    <option value="{{$item->id}}">{{$item->course_name}}</option>
                  @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Price</label>
                 <input type="number" name="price" class="form-control" placeholder="Enter Price" />
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Seats</label>
                 <input type="number" name="seat" class="form-control" placeholder="Enter Number Of Seat" />
              </div>
              
          </div>
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi50HL9BDpUeex4rEWooDZ9EF34my_J7o&libraries=places&callback=initAutocomplete" async defer></script>

<script>

let placeSearch, autocomplete;
function initAutocomplete() {

autocomplete = new google.maps.places.Autocomplete(

 document.getElementById('autocomplete'),
 {
 types: ['geocode'],
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

  if (status == google.maps.GeocoderStatus.OK) {
    document.getElementById('lat').value  = results[0].geometry.location.lat();
    document.getElementById('long').value  =  results[0].geometry.location.lng();
  }
});
  }
});

      </script>
@endsection
