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
            <form autocomplete="off" id="dateform" method="post" action="{{url('/admin/dates/store')}}"    enctype="multipart/form-data">
                @csrf
            
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Date</label>
                <input type="date" class="form-control" required="required" name="date" />
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Time</label>
                <input type="time" class="form-control" required="required" name="time" />
              </div>
            
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Loction</label>
                <select class="selectpicker form-control" data-live-search="true"  required="required" name="venue_id">
                <option> Select Location </option>
                @foreach($venue as $item)
                  <option value="{{$item->id}}">{{$item->location_name}}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Select Course</label>
                <!-- <option > Select Course </option> -->
                  <select class="selectpicker form-control" required="required" data-live-search="true" name="course_id">
                  @foreach($course as $item)
                    <option value="{{$item->id}}">{{$item->course_name}}</option>
                  @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Price</label>
                 <input type="number" name="price" required="required" class="form-control" placeholder="Enter Price" />
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Seats</label>
                 <input type="number" name="seat" required="required" class="form-control" placeholder="Enter Number Of Seat" />
              </div>
              <div class="form-group form-content">
                <label for="example-text-input" class="col-form-label">Select Guru </label>
                <select class="selectpicker form-control" required="required" data-live-search="true" name="guru_id[]" multiple>
                <option disabled=""> Select Guru </option>
                @foreach($guru as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="example-text-input" class="col-form-label">Price paid to Guru</label>
                 <input type="number" name="price_paid" required="required" class="form-control" placeholder="Enter Price Paid To Guru" />
              </div>
              
          </div>
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
  $('#dateform').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
    e.preventDefault();
    return false;
    }
  });


</script>
@endsection
