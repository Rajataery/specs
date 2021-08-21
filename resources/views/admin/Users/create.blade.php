@extends('layouts.admin')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Create New Guru</h4>
            <form autocomplete="off" method="post" action="{{url('/admin/guruPanel/store')}}"    enctype="multipart/form-data">
                @csrf
                
                <div class="form-group {{ $errors->has('seo_title') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Seo Title</label>
                    <input class="form-control" value="{{ old('seo_title') }}" type="text" name="seo_title" required >
                </div>
                @if ($errors->has('seo_title'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('seo_title') }}</strong>
                </span>
                @endif
                
                <div class="form-group {{ $errors->has('seo_keyword') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Seo Key-Word</label>
                    <input class="form-control" value="{{ old('seo_keyword') }}" type="text" name="seo_keyword" required>
                </div>
                @if ($errors->has('seo_keyword'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('seo_keyword') }}</strong>
                </span>
                @endif

                <div class="form-group {{ $errors->has('seo_discription') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Seo  Discription</label>
                    <input class="form-control" value="{{ old('seo_discription') }}" type="text" name="seo_discription" required >
                </div>
                @if ($errors->has('seo_discription'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('seo_discription') }}</strong>
                </span>
                @endif

                <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Name</label>
                    <input class="form-control" value="{{ old('name') }}" type="text" name="name" required>
                </div>
                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif

                <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Email</label>
                    <input class="form-control" value="{{ old('email') }}" type="email" name="email" required>
                </div>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Select Course</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" name="course[]" required>
                    @foreach($course as $item)
                      <option value="{{$item->id}}">{{$item->course_name}}</option>
                    @endforeach
                    </select>
                </div>
                @if ($errors->has('course'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('course') }}</strong>
                </span>
                @endif

                <div class="form-group ">
                    <label for="example-text-input" class="col-form-label">Guru Profile Picture</label>
                    <input class="form-control" type="file" accept="image/x-png,image/gif,image/jpeg"  name="profile"  required>
                </div>
                @if ($errors->has('profile'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('profile') }}</strong>
                </span>
                @endif

                <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Phone</label>
                    <input class="form-control" value="{{ old('phone') }}" type="text" name="phone" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                </div>
                @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif

                <div class="form-group {{ $errors->has('rate') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Guru Day Rate </label>
                    <input class="form-control" value="{{ old('rate') }}" type="number" name="rate" min="0" required >
                </div>
                @if ($errors->has('rate'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('rate') }}</strong>
                </span>
                @endif
                
                <div class="form-group {{ $errors->has('course_time') ? ' has-danger' : '' }}">
                    <label for="example-text-input" class="col-form-label">Status</label>
                    <select class="form-control" name="status" required>
                        <option value="1">Activate</option>
                        <option selected value="0">Deactivate</option>
                    </select>
                </div>
                @if ($errors->has('status'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
                @endif

                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Address</label>
                    <input type="text" id='autocomplete'value="{{ old('address') }}" name="address" class="form-control" id="inputAddress" required>
                </div>
                   <div class="form-group">
                    <input type="text" class="form-control d-none" value="{{ old('lat') }}" name="lat" placeholder="Latitude" id="lat" >
                    <input type="text" class="form-control d-none" value="{{ old('longitude') }}"  name="longitude" placeholder="longitude" id="long">
                </div>
                @if ($errors->has('address') || $errors->has('lat') || $errors->has('longitude'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>Please add a valid address.</strong>
                </span>
                @endif

                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Title</label>
                    <textarea name="title" class="form-control" value="{{ old('title') }}" cols="10" rows="5" required></textarea>
                </div>
                @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif

                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">About</label>
                    <textarea name="about" class="form-control" value="{{ old('about') }}" cols="30" rows="10" required></textarea>
                </div>
                @if ($errors->has('about'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('about') }}</strong>
                </span>
                @endif

                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Experience <small>(In years)</small></label>
                    <input type="number" class="form-control" min="0" value="{{ old('experience') }}" name="experience" required>
                </div>
                @if ($errors->has('experience'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('experience') }}</strong>
                </span>
                @endif

                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Do Guru hold a valid First Aid teaching qualification?</label>
                    <select class="form-control" name="qualification" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                @if ($errors->has('qualification'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('qualification') }}</strong>
                </span>
                @endif


                <div class="form-group">
                    <label for="certificates" class="col-form-label">Add Certificates</label>
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="input-group control-group img_div fl-box form-group w-50">
                                    <input type="file" class="form-control" name="certificates[0][file]" id="upload_certificates_0" onchange="uploadFile(0)">
                                    <div class="file_lable mt-2" id="thumb-output_0">
                                    </div>
                                </div>

                                <div class="clone mt-3 fl-box" id="clone_new"> 
                                </div>

                                <div class="input-group-btn add_more-btn"> 
                                    <button class="btn btn-success btn-add-more" id="add_more_file" type="button"><i class="glyphicon glyphicon-plus"></i> Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                   <!--  <button type="button" class="btn btn-danger m-3" onclick="clearCertificates()"> Clear Files </button> -->
                     
                </div>
                @if ($errors->has('certificates'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('certificates') }}</strong>
                </span>
                @endif

                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">First Aid Certificate Expiry Date</label>
                    <input type="date" class="form-control" id="certificate_expiry" value="{{ old('expiry') }}" name="expiry">
                </div>
                @if ($errors->has('expiry'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('expiry') }}</strong>
                </span>
                @endif

                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Password</label>
                    <input type="password" class="form-control" name="password"  required/>
                </div>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert" class="alert alert-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

                <button type="submit" class="col-12 btn btn-primary mt-4 pr-4 pl-4">Submit</button>
            </form>
        </div>
    </div>
</div>

<style type="text/css">
    .invalid-feedback{
        display: block;
    }
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi50HL9BDpUeex4rEWooDZ9EF34my_J7o&libraries=places&callback=initAutocomplete" async defer></script>

<script>
    var countAdd = 1
        
    // $('#upload_certificates_'+countAdd).on('change', function(){//on file input change

    function uploadFile(id) {
        console.log("id", id);
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            //$('#thumb-output').html(''); //clear html of output element
            var data = $("#upload_certificates_"+id)[0].files; //this file data
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ 
                        return function(e) {
                            $('#thumb-output_'+id).html(`<div class="file-box">
                                <img src="`+e.target.result+`" alt="" style="width: 10%;">
                                <div class="form-group col-12">
                                    <label for="file_type" class="col-form-label">Add Certificate Type for "`+ file.name +`"</label>
                                    <input type="text" class="form-control" name="certificates[`+id+`][name]" required>
                                    <input type="hidden" class="form-control" name="certificates[`+id+`][type]" value="image">
                                </div>
                            </div>`);
                        };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }else{
                    var fRead = new FileReader(); //new filereader

                    fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            $('#thumb-output_'+id).html(`<div class="file-box">
                                <a href="`+e.target.result+`" target="_blank" >`+ file.name +`</a>
                                <div class="form-group">
                                    <label for="file_type" class="col-form-label">Add Certificate type  for "`+ file.name +`"</label>
                                    <input type="text" class="form-control" name="certificates[`+id+`][name]" required>
                                    <input type="hidden" class="form-control" name="certificates[`+id+`][type]" value="file">
                                </div>
                            </div>`);
                        };
                    })(file);
                    fRead.readAsDataURL(file);
                }
                
                $("#thumb-output_"+id).removeClass("d-none");
                $("#certificate_expiry").attr('required', true);
            });
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    }//);

    
    //Clear Certificates
    // function clearCertificates() {
    //     $("#upload_certificates_"+countAdd).val("");
    //     $("#thumb-output").html("").addClass('d-none');
    //     $("#certificate_expiry").attr('required', false);
    // }

    $('select').selectpicker();

    let placeSearch, autocomplete;
    function initAutocomplete() {

        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'),
            {
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

    $(document).ready(function() {
        var count = 1;
        $("#add_more_file").click(function(){ 

            let html_data = `
                <div class="my_files mt-2 py-3 w-50">
                    <div class="control-group input-group form-group">
                        <input type="file" class="form-control" name="certificates[`+count+`][file]" onchange="uploadFile(`+count+`)" id="upload_certificates_`+count+`">
                        <div class="input-group-btn">
                            <button class="btn btn-danger btn-remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                    </div>
                    <div class="file_lable mt-2" id="thumb-output_`+count+`"></div>
                </div>`;

            $("#clone_new").append(html_data);
            count++ ;
        });
 
        $("body").on("click",".btn-remove",function(){ 
          $(this).parents(".my_files").remove();
        });

        $("body").on("click",".clear",function(){ 
          $('.form-control').val('');
        });
 
    });

</script>

@endsection
