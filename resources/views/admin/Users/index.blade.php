@extends('layouts.admin')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>

<style>
.pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}
</style>
<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="row col-sm-12">
                        <div class="col-sm-6 pull-left">
                            <h4 class="pull-left" >Guru Panel</h4>
                        </div>
                   
                         <div class=" col-sm-2 pull-right">
                            <a class="btn btn-info pull-right" href="#" class="btn btn-primary" data-toggle="modal" data-target="#sliderModal">See guru Near </a>
                        </div>
                        <div class=" col-sm-4 pull-right">
                            <a class="btn btn-info pull-right" href="{{route('admin.guru.create')}}">Add guru</a>
                        </div>
                    </div>
                </div>

                <div class="data-tables datatable-primary">
                    <table id="dataTable2">
                        <thead class="text-capitalize">
                            <tr>
                                <th>Id#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Active/Inactive</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                      
                        @foreach($data as $item)

                            <tr>
                                <td> {{$item->id}} @if($item->notification_status == 1) 
                                      <span>new</span> @endif</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->address}}</td>
                                <td> <input id="dates_{{$item->id}}" type="checkbox" @if($item->status) checked @endif name="status" onchange="allowStatus({{$item->id}})"></td>
                                <td>
                                  <a href="{{route('admin.guru.edit',$item->id)}}" class="btn btn-outline-primary btn-xs">Edit</a>

                                <a href="{{route('admin.guru.view',$item->id)}}" class="btn btn-outline-primary btn-xs statusNotify" onclick="document.forms['form_id'].submit();" id="{{$item->id}}">View</a>
                                <a href="{{route('admin.guru.delete',$item->id)}}" onclick="return confirm('Are You Sure')" class="btn btn-outline-primary btn-xs">Delete</a>
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form class="hidden" action="{{url('/admin/guruPanel/notification_status')}}" method="post" id="form_id" >
          @csrf
          
        <input type="hidden" name="newStatus" value="0" id="newStatus">
        <!-- <button type="submit">sttsst</button> -->
       
      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="sliderModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enter Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body ml-4">
            <form action="{{ route('admin.nearUser')}}" method="post"  enctype="multipart/form-data" >
              @csrf
            <div class="form-group">
                <label for="example-text-input" class="col-form-label">Address</label>
                <input type="text" id='autocomplete' name="address" class="form-control" required>
            </div>
            <div class="range-field w-50 mt-4">
                <input id="range_slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1"  name="range" />
                <p id="range_value" class="text-center">0 mile </p>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" style="display: none;"  name="lat" placeholder="Latitude" id="lat">
                <input type="text" class="form-control" style="display: none;"  name="longitude" placeholder="longitude" id="long">
          </div>
      </div>
      
      <div class="modal-footer">
            <button type="submit" class="btn btn-primary mr-auto ml-2">Search</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"> X </button>
      </div>
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
var input = document.getElementById("autocomplete");
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
  
  $('#range_slider').slider({
      value: 0
    // formatter: function(value) {
    //     console.log("value", value);

    //   return 'Current value: ' + value;
    // }
  }).on('change', change);


  function change(e){
      $('#range_value').html($(this).val() + " mile");
  }


/*var view_id = '';
const myForm = $("#form-id");
$(".statusNotify").click(function(){
  view_id = this.id;
  $('#newStatus').val(this.id);
  
  
});
console.log('id befor ========',view_id);
$(view_id).click(function() {
  console.log('id ========',view_id);
  $('#form_id').submit();
  alert('form');
});*/

/*$('.statusNotify').on('click', function(e) {
  alert("Hiii");
    e.preventDefault();
    alert(this.id); // prevents a window.location change to the href
    $('#newStatus').val(this.id); 
    alert($('#newStatus').val()); // sets to 123 or abc, respectively
    $('#form_id').submit();
});
*/
function allowStatus(id) {

    $.ajax({
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id: id
        },
        url: "{{url('admin/guru_status')}}/"+id,
        success:function (response){
            console.log(response);
            alert(response.message);
        },
        error: function(error){
            
            console.log("error", error);
            alert("Event added to First Aid");
        }
    });
}

</script>
@endsection