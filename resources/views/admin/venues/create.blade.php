@extends('layouts.admin')
@section('content')
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Create New Location</h4>
            <form autocomplete="off" method="post" action="{{url('/admin/venue/store')}}"    enctype="multipart/form-data">
                @csrf
                <div class="form-group {{ $errors->has('location_name') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Location Name</label>
                    <input class="form-control" value="{{ old('location_name') }}" type="text" name="location_name" id="example-text-input" required>
                </div>
                @if ($errors->has('location_name'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('location_name') }}</strong>
                </span>
                @endif

            
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Address</label>
                    <input type="text" id='autocomplete' name="address" class="form-control" id="inputAddress" required>
                </div>
                  <div class="form-group">
                    <input type="text" class="form-control" style="display: none;"  name="lat" placeholder="Latitude" id="lat">
                     <input type="text" class="form-control" style="display: none;"  name="longitude" placeholder="longitude" id="long">
                  </div>
              
                <div class="input-group mb-3 {{ $errors->has('form') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Form</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="form[]" id="actual-btn" class="custom-file-input" multiple>
                        <label class="custom-file-label" id="file-chosen" for="file-chosen">Upload Form</label>
                    </div>
                </div>
                <div class="input-group mb-3 {{ $errors->has('floorPlan') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Floor Plan</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="floorPlan[]"  class="custom-file-input" id="actual-btn1" multiple>
                        <label class="custom-file-label" id="file-chosen1" for="inputGroupFile01">Upload Form</label>
                    </div>
                </div>
                <div class="input-group mb-3 {{ $errors->has('images') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Images</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" id="actual-btn2" name="images[]" class="custom-file-input" multiple >
                        <label class="custom-file-label" id="file-chosen2" for="inputGroupFile01">Upload Form</label>
                    </div>
                </div>
        
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    const actualBtn = document.getElementById('actual-btn');
    const fileChosen = document.getElementById('file-chosen');
    actualBtn.addEventListener('change', function(){
       
    fileChosen.textContent = this.files.length + " files uploaded"
    })
</script>
    <script>
        const actualBtn1 = document.getElementById('actual-btn1');

        const fileChosen1 = document.getElementById('file-chosen1');
        
        actualBtn1.addEventListener('change', function(){
            
          fileChosen1.textContent = this.files.length + " files uploaded"
          
        })
  </script>
    <script>
        const actualBtn2 = document.getElementById('actual-btn2');

        const fileChosen2= document.getElementById('file-chosen2');
        
        actualBtn2.addEventListener('change', function(){
            
          fileChosen2.textContent = this.files.length + " files uploaded"
          
        })
  </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi50HL9BDpUeex4rEWooDZ9EF34my_J7o&libraries=places&callback=initAutocomplete" async defer></script>

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

  if (status == google.maps.GeocoderStatus.OK) {
    document.getElementById('lat').value  = results[0].geometry.location.lat();
    document.getElementById('long').value  =  results[0].geometry.location.lng();
  }
});
  }
});

      </script>
@endsection
