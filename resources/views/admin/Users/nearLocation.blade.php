@extends('layouts.admin')
@section('content')
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
                            <h4 class="pull-left" >Nearest Under {{ $range }} Mile ( {{ $address }} )</h4>
                        </div>
                    </div>
                </div>
                <div class="data-tables datatable-primary">
                    <table id="dataTable2">
                        <thead class="text-capitalize">
                            <tr>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->address}}</td>
                                <td>
                                <a href="{{route('admin.guru.edit',$item->id)}}" class="btn btn-outline-primary btn-xs">Edit</a>
                                <a href="{{route('admin.guru.view',$item->id)}}" class="btn btn-outline-primary btn-xs">View</a>
                                <a href="{{route('admin.guru.delete',$item->id)}}" class="btn btn-outline-primary btn-xs">Delete</a>
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

</script>
@endsection